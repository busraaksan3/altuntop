<?php 
ob_start();
session_start();
include 'baglan.php';
if (!empty($_FILES)) {
	if(isset($_FILES["urunfoto_resimyol"]) && $_FILES["urunfoto_resimyol"]["size"] > 0){
		$izinli_uzantilar=array('jpg','gif','png','pdf');
		$ext=strtolower(substr($_FILES['urunfoto_resimyol']["name"],strpos($_FILES['urunfoto_resimyol']["name"],'.')+1));
		if(in_array($ext, $izinli_uzantilar)===false){
			echo "Uzantı kabul edilmiyor";		
			exit;
		}
	}
	$urun_id=$_POST['urun_id'];
	$uploads_dir = '../../assets/resim/upload';

	@$tmp_name = $_FILES['file']["tmp_name"];

	@$name = $_FILES['file']["name"];

	$benzersizsayi1=rand(20000,32000);

	$benzersizsayi2=rand(20000,32000);

	$benzersizsayi3=rand(20000,32000);

	$benzersizsayi4=rand(20000,32000);

	$benzersizad=$benzersizsayi1.$benzersizsayi2.$benzersizsayi3.$benzersizsayi4;

	$refimgyol=substr($uploads_dir, 6)."/".$benzersizad.$name;

	@move_uploaded_file($tmp_name, "$uploads_dir/$benzersizad$name");
	$urun_id=$_POST['urun_id'];

	$kaydet=$db->prepare("INSERT INTO urunfoto SET
		urunfoto_resimyol=:resimyol,
		urun_id=:urun_id");
	$insert=$kaydet->execute(array(
		'resimyol' => $refimgyol,
		'urun_id' => $urun_id
		));


}

?>