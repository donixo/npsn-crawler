<?php 
/** 
	Parsing npsn dapodik
	donixo@2011.	
*/

include("Bot.php");
include("./entity/Db.php");
include("./entity/GetAllers.php");
include("./entity/Provinsi.php");
include("./entity/Kabupaten.php");
include("./entity/Sekolah.php");

//database connection.
$conn = mysql_connect('your-mysql-host', 'your-mysql-username', 'your-mysql-pwd');
mysql_select_db("dapodik");

echo "NPSN Parser - C[http://twitter.com/!donixo]@2011\n\n";

$b = new Bot();
$ga = new GetAllers($conn);

echo "mengosongkan tabel...\n";
$ga->reset();

if(TRUE) { //start the process
	$str_provs = $b->hunt("http://npsn.dapodik.org/rekap.php", "provinsi");
	
	foreach($str_provs as $pr) {
		$prov = new Provinsi($pr, $conn);
		echo "Menyimpan [".$prov->getUrl()."]...\n";
		echo ";;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;\n";
		echo "\n";
		$prov->simpan();
		
		$str_kabs = $b->hunt($prov->getUrl(), "kabupaten");
		foreach($str_kabs as $kab) {
			if($prov->getKode() != "") {
				$kabupa = new Kabupaten($kab, $conn, $prov->getId());
				echo $kabupa->getUrl()."\n";
				$kabupa->simpan();
				
				// buat kombinasi sekolah berdasarkan get url 
				$tipe = array('tk_ra', 'sd_mi', 'smp_mts', 'sma_ma', 
					'smk', 'pt', 'lainnya');
				$status = array('negeri'=>'2', 'swasta'=>'3');
				
				for($ctipe = 0; $ctipe < count($tipe); $ctipe++) { // tipe sekolah
					if($ctipe == 6)
						$url = $kabupa->getUrl()."&data=&tipe=9";
					else
						$url = $kabupa->getUrl()."&data=&tipe=".$ctipe;
					
					//hunt ulang. untuk melihat halamannya.
					
					foreach($status as $stat) { // status sekolah negeri/swasta
						$stat_url = $url."&status=".$stat;
						$sekolah_param = $b->hunt($stat_url, "sekolah");
						for($hal = 1; $hal <= $sekolah_param['total']; $hal++ ) {
							$hal_url = $stat_url."&hal=".$hal."&limit=".$sekolah_param['limit'];
							$tabel_sekolah = $b->hunt($hal_url, "sekolah_tabel");
							echo $hal_url."\n";
							echo "-----------------------------------------\n";
							foreach($tabel_sekolah as $sch) { //sekolah
								$sekolah = new Sekolah($sch, $conn, 
										$kabupa->getId(), $ctipe);
								$sekolah->simpan();
								echo "===> ".$sekolah->getInfo()."\n";
							}
							echo "-----------------------------------------\n";
						}
					}
				}
			}
		}
	}
}

?>