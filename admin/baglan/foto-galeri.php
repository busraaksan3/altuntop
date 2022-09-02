<?php 
ob_start();
session_start();
include 'baglan.php';
if (!empty($_FILES)) {
	if(isset($_FILES["foto"]) && $_FILES["foto"]["size"] > 0){
		$izinli_uzantilar=array('jpg','gif','png','pdf');
		$ext=strtolower(substr($_FILES['foto']["name"],strpos($_FILES['foto']["name"],'.')+1));
		if(in_array($ext, $izinli_uzantilar)===false){
			echo "Uzantı kabul edilmiyor";		
			exit;
		}
	}
	$kategori_idd=$_POST['kategori_idd'];
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
	$kategori_idd=$_POST['kategori_idd'];

	$kaydet=$db->prepare("INSERT INTO foto_galeri SET

		kategori_idd=:kategori_idd,
		foto=:resimyol
		

		");

	$insert=$kaydet->execute(array(
		
		'resimyol' => $refimgyol,
		'kategori_idd'=> $kategori_idd
		));	

}

if (isset($_POST['fotogalerisil'])) {
	$kategori_idd = $_POST['kategori_idd'];
	echo $checklist = $_POST['urunfotosec'];
	foreach ($checklist as $list) {
		$sil = $db->prepare("DELETE from foto_galeri where foto_id=:foto_id");
		$kontrol = $sil->execute(array(
			'foto_id' => $list
		));
	}
	if ($kontrol) {
		Header("Location:../production/foto-galeri.php?kategori_idd=$kategori_idd&durum=ok");
	} else {
		Header("Location:../production/foto-galeri.php?kategori_idd=$kategori_idd&durum=no");
	}
}

?>