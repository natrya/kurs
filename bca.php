<?php
require 'vendor/autoload.php';

$dom = new IvoPetkov\HTML5DOMDocument();

$hasil=getHTML("https://www.klikbca.com");

$lines = explode(PHP_EOL,$hasil);
$isi = "";
for ($i=0;$i<count($lines);$i++){
	if (($i >=131) && ($i < 154)){
		$isi = $isi.PHP_EOL.$lines[$i]; 
	}
}
$dom->loadHTML($isi);
$items = $dom->getElementsByTagName('td');
$bca_beli=$items->item(2)->textContent;
$bca_jual=$items->item(3)->textContent;
$sgd_beli=$items->item(5)->textContent;
$sgd_jual=$items->item(6)->textContent;
$eur_beli=$items->item(8)->textContent;
$eur_jual=$items->item(9)->textContent;
$aud_beli=$items->item(11)->textContent;
$aud_jual=$items->item(12)->textContent;
echo $bca_beli. " ".$bca_jual.PHP_EOL;
echo $sgd_beli. " ".$sgd_jual.PHP_EOL;
echo $eur_beli. " ".$eur_jual.PHP_EOL;
echo $aud_beli. " ".$aud_jual.PHP_EOL;

function getHTML($url){
	// inisialisasi CURL
	$data = curl_init();
	// setting CURL
	curl_setopt($data, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($data, CURLOPT_URL, $url);
	curl_setopt($data, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($data, CURLOPT_HTTPHEADER, array("User-Agent: Mozilla/5.0 (iPhone; CPU iPhone OS 5_0 like Mac OS X) AppleWebKit/534.46 (KHTML, like Gecko) Version/5.1 Mobile/9A334 Safari/7534.48.3"));

	// menjalankan CURL untuk membaca isi file 
	$hasil = curl_exec($data);
	curl_close($data);
     return $hasil;
}

