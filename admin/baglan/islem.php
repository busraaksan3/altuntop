<?php
ob_start();
session_start();
include 'baglan.php';
include '../production/fonksiyon.php';

if (isset($_POST['userlogin'])) {
	$userad = $_POST['admin_ad'];
	$userpassword = md5($_POST['admin_password']);
	if ($userad && $userpassword) {
		$usersor = $db->prepare("SELECT * from kullanici where kullanici_ad=:ad and kullanici_password=:password");

		$usersor->execute(array(
			'ad' => $userad,
			'password' => $userpassword
		));
		$say = $usersor->rowCount();
		if ($say > 0) {
			$user = $usersor->fetch(PDO::FETCH_ASSOC);
			if ($user["is_admin"] == 1) {
				$_SESSION['user_ad'] = $user["kullanici_ad"];
				$_SESSION['kullanici_id'] = $user["kullanici_id"];
				$_SESSION['hizmet'] = $user["hizmet"];
				header('Location:../production/index.php');
			} else if ($user["is_admin"] == 0) {
				$_SESSION['user_ad'] = $user["kullanici_ad"];
				$_SESSION['kullanici_id'] = $user["kullanici_id"];
				$_SESSION['hizmet'] = $user["hizmet"];
				header('Location:../production/index.php');
			} else {
				session_destroy();
				header("Location:../../index.php");
			}
		} else {
			print_r($_POST);
		}
	}
}

if ($_GET['ulke_to_user_sil'] == "ok") {

	$sil = $db->prepare("DELETE from ulke_to_user where id=:id");
	$kontrol = $sil->execute(array(
		'id' => $_GET['delete_id']
	));
	$control = $db->prepare("SELECT * FROM logs");
	$control->execute();
	$count = $control->rowCount();
	if ($count >= $logDeleteLimit) {
		$query = $db->prepare("DELETE FROM logs ORDER BY created_at ASC LIMIT 1");
		$delete = $query->execute(array());
	}
	$ulkesor = $db->prepare("SELECT * FROM ulkeler");
	$ulkesor->execute();
	$ulkecek = $ulkesor->fetch(PDO::FETCH_ASSOC);

	$kullanicigetir = $db->prepare("SELECT * FROM kullanici");
	$kullanicigetir->execute();
	$us = $kullanicigetir->fetch(PDO::FETCH_ASSOC);

	$newLog = $db->prepare("INSERT INTO logs SET kullanici_id = :kullanici_id, transaction = :transaction, detail = :detail, ip_address = :ip");
	$logControl = $newLog->execute(array(
		"kullanici_id" => intval($_SESSION["kullanici_id"]),
		"transaction" => "Ülke Bazlı Kullanıcı Ataması Silindi",
		"detail" => $ulkecek['name'] . " ülkesinden " . $us['kullanici_ad'] . " Adlı Kullanıcı Ataması Silindi",
		"ip" => $_SERVER["REMOTE_ADDR"]
	));
	if ($kontrol) {
		$msg = "Kullanıcı başarıyla kaldırıldı !";
		header("location:../production/ulke_to_user.php?ulke_id={$_GET['ulke_id']}&type=1&message={$msg}");
	} else {
		header("location:../production/ulke_to_user.php?ulke_id={$_GET['ulke_id']}");
	}
}

if (isset($_POST['ulke_to_user_add'])) {

	$ulke_id = $_POST['ulke_id'];
	$kullanici_id = $_POST['kullanici_id'];

	$checkuser = $db->query("SELECT * FROM ulke_to_user WHERE ulke_id = '{$ulke_id}' AND kullanici_id ='{$kullanici_id}'")->fetch(PDO::FETCH_ASSOC);

	if (!$checkuser) {
		$ulke_to_user_add = $db->prepare("INSERT INTO ulke_to_user set 
				 	ulke_id=:ulke_id,	
					kullanici_id=:kullanici_id
					");
		$insert = $ulke_to_user_add->execute(array(
			'ulke_id' => $ulke_id,
			'kullanici_id' => $kullanici_id
		));
		$control = $db->prepare("SELECT * FROM logs");
		$control->execute();
		$count = $control->rowCount();
		if ($count >= $logDeleteLimit) {
			$query = $db->prepare("DELETE FROM logs ORDER BY created_at ASC LIMIT 1");
			$delete = $query->execute(array());
		}
		$ulkesor = $db->prepare("SELECT * FROM ulkeler");
		$ulkesor->execute();
		$ulkecek = $ulkesor->fetch(PDO::FETCH_ASSOC);

		$kullanicigetir = $db->prepare("SELECT * FROM kullanici");
		$kullanicigetir->execute();
		$us = $kullanicigetir->fetch(PDO::FETCH_ASSOC);

		$newLog = $db->prepare("INSERT INTO logs SET kullanici_id = :kullanici_id, transaction = :transaction, detail = :detail, ip_address = :ip");
		$logControl = $newLog->execute(array(
			"kullanici_id" => intval($_SESSION["kullanici_id"]),
			"transaction" => "Ülke Bazlı Kullanıcı Ataması Yapıldı",
			"detail" => $ulkecek['name'] . " ülkesine " . $us['kullanici_ad'] . " Adlı Kullanıcı Atandı",
			"ip" => $_SERVER["REMOTE_ADDR"]
		));
		if ($insert) {
			$msg = "Kullanıcı başarıyla eklendi !";
			Header("Location:../production/ulke_to_user.php?ulke_id=$ulke_id&type=1&message=$msg");
		} else {
			$msg = "Kullanıcı eklenemedi bir sorun oluştu !";
			Header("Location:../production/ulke_to_user.php?ulke_id=$ulke_id&type=0&message=$msg");
		}
	} else {
		$msg = "Bu kullanıcı zaten bu ülkede mevcut!";
		Header("Location:../production/ulke_to_user.php?ulke_id=$ulke_id&type=0&message=$msg");
	}
}

if (isset($_POST['kullaniciekle'])) {
	$userpassword = md5($_POST['kullanici_password']);

	$usersor = $db->prepare("INSERT INTO kullanici set 
				 	kullanici_ad=:kullanici_ad,	
					kullanici_isim=:kullanici_isim,
					kullanici_soyisim=:kullanici_soyisim, 	
					kullanici_password=:kullanici_password,
					kullanici_mail=:kullanici_mail,							
					kullanici_gsm=:kullanici_gsm,				
					hizmet=:hizmet,					
					auth_level=:auth_level
					");
	$insert = $usersor->execute(array(
		'kullanici_ad' => $_POST['kullanici_ad'],
		'kullanici_isim' => $_POST['kullanici_isim'],
		'kullanici_soyisim' => $_POST['kullanici_soyisim'],
		'kullanici_password' => $userpassword,
		'kullanici_mail' => $_POST['kullanici_mail'],
		'kullanici_gsm' => $_POST['kullanici_gsm'],
		'hizmet' => json_encode($_POST['hizmet']),
		'auth_level' => 0
	));
	$control = $db->prepare("SELECT * FROM logs");
	$control->execute();
	$count = $control->rowCount();
	if ($count >= $logDeleteLimit) {
		$query = $db->prepare("DELETE FROM logs ORDER BY created_at ASC LIMIT 1");
		$delete = $query->execute(array());
	}
	$newLog = $db->prepare("INSERT INTO logs SET kullanici_id = :kullanici_id, transaction = :transaction, detail = :detail, ip_address = :ip");
	$logControl = $newLog->execute(array(
		"kullanici_id" => intval($_SESSION["kullanici_id"]),
		"transaction" => "Yeni Kullanıcı kaydı alındı",
		"detail" => $_POST['kullanici_ad'] . " Adlı Kullanıcı Eklendi",
		"ip" => $_SERVER["REMOTE_ADDR"]
	));
	if ($insert) {
		Header("Location:../production/kullanicilar.php?durum=ok");
	} else {
		Header("Location:../production/kullanicilar.php?durum=no");
	}
}

if (isset($_POST['kullaniciduzenle'])) {
	$userpassword = md5($_POST['kullanici_password']);
	$kullanici_id = $_POST['kullanici_id'];
	if (!empty($_POST['kullanici_password'])) {
		$ayarkaydet = $db->prepare("UPDATE kullanici SET
	kullanici_ad=:kullanici_ad,
	kullanici_isim=:kullanici_isim,
	kullanici_soyisim=:kullanici_soyisim,		
	kullanici_password=:kullanici_password,
	kullanici_mail	=:kullanici_mail,			
	kullanici_gsm=:kullanici_gsm,
	hizmet=:hizmet,	
	auth_level	=:auth_level	
	WHERE kullanici_id={$_POST['kullanici_id']}");
		$update = $ayarkaydet->execute(array(
			'kullanici_ad' => $_POST['kullanici_ad'],
			'kullanici_isim' => $_POST['kullanici_isim'],
			'kullanici_soyisim' => $_POST['kullanici_soyisim'],
			'kullanici_password' => $userpassword,
			'kullanici_mail' => $_POST['kullanici_mail'],
			'kullanici_gsm' => $_POST['kullanici_gsm'],
			'hizmet' => json_encode($_POST['hizmet']),
			'auth_level' => 0
		));
		if ($update) {
			Header("Location:../production/kullanicilar.php?durum=ok");
		} else {
			Header("Location:../production/kullanicilar.php?durum=no");
		}
	} else {
		$ayarkaydet = $db->prepare("UPDATE kullanici SET
	kullanici_ad=:kullanici_ad,
	kullanici_isim=:kullanici_isim,
	kullanici_soyisim=:kullanici_soyisim,		
	
	kullanici_mail	=:kullanici_mail,			
	kullanici_gsm=:kullanici_gsm,
	hizmet=:hizmet,	
	auth_level	=:auth_level	
	WHERE kullanici_id={$_POST['kullanici_id']}");
		$update = $ayarkaydet->execute(array(
			'kullanici_ad' => $_POST['kullanici_ad'],
			'kullanici_isim' => $_POST['kullanici_isim'],
			'kullanici_soyisim' => $_POST['kullanici_soyisim'],

			'kullanici_mail' => $_POST['kullanici_mail'],
			'kullanici_gsm' => $_POST['kullanici_gsm'],
			'hizmet' => json_encode($_POST['hizmet']),
			'auth_level' => 0
		));
		if ($update) {
			Header("Location:../production/kullanicilar.php?durum=ok");
		} else {
			Header("Location:../production/kullanicilar.php?durum=no");
		}
	}
}

if ($_GET['kullanicisil'] == "ok") {

	$sil = $db->prepare("DELETE from kullanici where kullanici_id=:id");
	$kontrol = $sil->execute(array(
		'id' => $_GET['kullanici_id']
	));
	$control = $db->prepare("SELECT * FROM logs");
	$control->execute();
	$count = $control->rowCount();
	if ($count >= $logDeleteLimit) {
		$query = $db->prepare("DELETE FROM logs ORDER BY created_at ASC LIMIT 1");
		$delete = $query->execute(array());
	}
	$newLog = $db->prepare("INSERT INTO logs SET kullanici_id = :kullanici_id, transaction = :transaction, detail = :detail");
	$logControl = $newLog->execute(array(
		"kullanici_id" => intval($_SESSION["kullanici_id"]),
		"transaction" => "kullanici Silindi",
		"detail" => $_GET['kullanici_id'] . " ID Değerindeki kullanici Silindi"
	));
	if ($kontrol) {
		header("location:../production/kullanicilar.php?sil=ok");
	} else {
		header("location:../production/kullanicilar.php?sil=no");
	}
}

if (isset($_POST['menukaydet'])) {
	if (isset($_FILES["menu_resim"]) && $_FILES["menu_resim"]["size"] > 0) {
		$izinli_uzantilar = array('jpg', 'gif', 'png', 'pdf');
		$ext = strtolower(substr($_FILES['menu_resim']["name"], strpos($_FILES['menu_resim']["name"], '.') + 1));
		if (in_array($ext, $izinli_uzantilar) === false) {
			echo "Uzantı kabul edilmiyor";
			header("Location:../menu.php?durum=formathatali");
			exit;
		}
	}
	$menu_seourl = seo($_POST['menu_ad']);
	$uploads_dir = '../../assets/resim/upload/';
	@$tmp_name = $_FILES['menu_resim']["tmp_name"];
	@$name = $_FILES['menu_resim']["name"];
	$benzersizad = strtotime(date("YmdHis"));
	$refimgyol = substr($uploads_dir, 6) . "/" . $benzersizad . $name;
	@move_uploaded_file($tmp_name, "$uploads_dir/$benzersizad$name");
	$icerikkaydet = $db->prepare("INSERT INTO menu SET
		menu_ad=:menu_ad,
		menu_url=:menu_url,
        menu_sira=:menu_sira,
		menu_icerik=:menu_icerik,
		menu_resim=:menu_resim");
	$update = $icerikkaydet->execute(array(
		'menu_ad' => $_POST['menu_ad'],
		'menu_url' => $menu_seourl,
		'menu_sira' => $_POST['menu_sira'],
		'menu_icerik' => $_POST['menu_icerik'],
		'menu_resim' => $refimgyol
	));
	$control = $db->prepare("SELECT * FROM logs");
	$control->execute();
	$count = $control->rowCount();
	if ($count >= $logDeleteLimit) {
		$query = $db->prepare("DELETE FROM logs ORDER BY created_at ASC LIMIT 1");
		$delete = $query->execute(array());
	}
	$newLog = $db->prepare("INSERT INTO logs SET kullanici_id = :kullanici_id, transaction = :transaction, detail = :detail");
	$logControl = $newLog->execute(array(
		"kullanici_id" => intval($_SESSION["kullanici_id"]),
		"transaction" => "Menü Ekleme",
		"detail" => $_POST['menu_ad'] . " Başlığında Yeni Menü Eklendi"
	));
	if ($update) {
		header("Location:../production/menu.php?durum=ok");
	} else {
		header("Location:../production/menu.php?durum=no");
	}
}

if ($_GET['menusil'] == "ok") {

	$sil = $db->prepare("DELETE from menu where menu_id=:id");
	$kontrol = $sil->execute(array(
		'id' => $_GET['menu_id']
	));
	$control = $db->prepare("SELECT * FROM logs");
	$control->execute();
	$count = $control->rowCount();
	if ($count >= $logDeleteLimit) {
		$query = $db->prepare("DELETE FROM logs ORDER BY created_at ASC LIMIT 1");
		$delete = $query->execute(array());
	}
	$newLog = $db->prepare("INSERT INTO logs SET kullanici_id = :kullanici_id, transaction = :transaction, detail = :detail");
	$logControl = $newLog->execute(array(
		"kullanici_id" => intval($_SESSION["kullanici_id"]),
		"transaction" => "Menü Silindi",
		"detail" => $_POST['menu_id'] . "ID değerindeki Menü Silindi"
	));
	if ($kontrol) {
		header("location:../production/menu.php?sil=ok");
	} else {
		header("location:../production/menu.php?sil=no");
	}
}

if (isset($_POST['menuduzenle'])) {
	if (isset($_FILES["menu_resim"]) && $_FILES["menu_resim"]["size"] > 0) {
		$izinli_uzantilar = array('jpg', 'gif', 'png', 'pdf');
		$ext = strtolower(substr($_FILES['menu_resim']["name"], strpos($_FILES['menu_resim']["name"], '.') + 1));
		if (in_array($ext, $izinli_uzantilar) === false) {
			echo "Uzantı kabul edilmiyor";
			header("Location:../menu.php?durum=formathatali");
			exit;
		}

		$uploads_dir = '../../assets/resim/upload/';
		@$tmp_name = $_FILES['menu_resim']["tmp_name"];
		@$name = $_FILES['menu_resim']["name"];
		$benzersizad = strtotime(date("YmdHis"));
		$refimgyol = substr($uploads_dir, 6) . "/" . $benzersizad . $name;
		@move_uploaded_file($tmp_name, "$uploads_dir/$benzersizad$name");
	} else {
		$refimgyol = $_POST["old_img_url"];
	}
	$menu_id = $_POST['menu_id'];
	$menu_seourl = seo($_POST['menu_ad']);
	$ayarkaydet = $db->prepare("UPDATE menu SET
		menu_ad=:menu_ad,		
		menu_url=:menu_url,
		menu_sira=:menu_sira,
		menu_icerik=:menu_icerik,
		menu_resim=:menu_resim	
		WHERE menu_id={$_POST['menu_id']}");
	$update = $ayarkaydet->execute(array(
		'menu_ad' => $_POST['menu_ad'],
		'menu_url' => $menu_seourl,
		'menu_sira' => $_POST['menu_sira'],
		'menu_icerik' => $_POST['menu_icerik'],
		'menu_resim' => $refimgyol

	));
	$control = $db->prepare("SELECT * FROM logs");
	$control->execute();
	$count = $control->rowCount();
	if ($count >= $logDeleteLimit) {
		$query = $db->prepare("DELETE FROM logs ORDER BY created_at ASC LIMIT 1");
		$delete = $query->execute(array());
	}
	$newLog = $db->prepare("INSERT INTO logs SET kullanici_id = :kullanici_id, transaction = :transaction, detail = :detail");
	$logControl = $newLog->execute(array(
		"kullanici_id" => intval($_SESSION["kullanici_id"]),
		"transaction" => "Menü Güncellendi",
		"detail" => $_POST['menu_ad'] . " Adlı Menü Düzenlendi"
	));
	if ($update) {
		Header("Location:../production/menu-duzenle.php?menu_id=$menu_id&durum=ok");
	} else {
		Header("Location:../production/menu-duzenle.php?menu_id=$menu_id&durum=no");
	}
}

if (isset($_POST['altmenukaydet'])) {
	if (isset($_FILES["altmenu_foto"]) && $_FILES["altmenu_foto"]["size"] > 0) {
		$izinli_uzantilar = array('jpg', 'gif', 'png', 'pdf');
		$ext = strtolower(substr($_FILES['altmenu_foto']["name"], strpos($_FILES['altmenu_foto']["name"], '.') + 1));
		if (in_array($ext, $izinli_uzantilar) === false) {
			echo "Uzantı kabul edilmiyor";
			header("Location:../menu.php?durum=formathatali");
			exit;
		}
	}
	$menu_seourl = seo($_POST['altmenu_ad']);
	$uploads_dir = '../../assets/resim/upload/';
	@$tmp_name = $_FILES['altmenu_foto']["tmp_name"];
	@$name = $_FILES['altmenu_foto']["name"];
	$benzersizad = strtotime(date("YmdHis"));
	$refimgyol = substr($uploads_dir, 6) . "/" . $benzersizad . $name;
	@move_uploaded_file($tmp_name, "$uploads_dir/$benzersizad$name");
	$icerikkaydet = $db->prepare("INSERT INTO altmenu SET
		altmenu_ad=:altmenu_ad,
		altmenu_url=:altmenu_url,
		menu_id=:menu_id,       
		altmenu_icerik=:altmenu_icerik,
		altmenu_foto=:altmenu_foto");
	$update = $icerikkaydet->execute(array(
		'altmenu_ad' => $_POST['altmenu_ad'],
		'altmenu_url' => $menu_seourl,
		'menu_id' => $_POST['menu_id'],
		'altmenu_icerik' => $_POST['altmenu_icerik'],
		'altmenu_foto' => $refimgyol
	));
	$control = $db->prepare("SELECT * FROM logs");
	$control->execute();
	$count = $control->rowCount();
	if ($count >= $logDeleteLimit) {
		$query = $db->prepare("DELETE FROM logs ORDER BY created_at ASC LIMIT 1");
		$delete = $query->execute(array());
	}
	$newLog = $db->prepare("INSERT INTO logs SET kullanici_id = :kullanici_id, transaction = :transaction, detail = :detail");
	$logControl = $newLog->execute(array(
		"kullanici_id" => intval($_SESSION["kullanici_id"]),
		"transaction" => "Alt Menü Ekleme",
		"detail" => $_POST['menu_ad'] . " Başlığında Yeni Alt Menü Eklendi"
	));
	if ($update) {
		header("Location:../production/altmenu.php?durum=ok");
	} else {
		header("Location:../production/altmenu.php?durum=no");
	}
}

if (isset($_POST['altmenuduzenle'])) {
	if (isset($_FILES["altmenu_foto"]) && $_FILES["altmenu_foto"]["size"] > 0) {
		$izinli_uzantilar = array('jpg', 'gif', 'png', 'pdf');
		$ext = strtolower(substr($_FILES['altmenu_foto']["name"], strpos($_FILES['altmenu_foto']["name"], '.') + 1));
		if (in_array($ext, $izinli_uzantilar) === false) {
			echo "Uzantı kabul edilmiyor";
			header("Location:../altmenu.php?durum=formathatali");
			exit;
		}

		$uploads_dir = '../../assets/resim/upload/';
		@$tmp_name = $_FILES['altmenu_foto']["tmp_name"];
		@$name = $_FILES['altmenu_foto']["name"];
		$benzersizad = strtotime(date("YmdHis"));
		$refimgyol = substr($uploads_dir, 6) . "/" . $benzersizad . $name;
		@move_uploaded_file($tmp_name, "$uploads_dir/$benzersizad$name");
	} else {
		$refimgyol = $_POST["old_img_url"];
	}
	$menu_id = $_POST['altmenu_id'];
	$menu_seourl = seo($_POST['altmenu_ad']);
	$ayarkaydet = $db->prepare("UPDATE altmenu SET
		altmenu_ad=:altmenu_ad,		
		altmenu_url=:altmenu_url,
		menu_id=:menu_id,
		altmenu_icerik=:altmenu_icerik,
		altmenu_foto=:altmenu_foto	
		WHERE altmenu_id={$_POST['altmenu_id']}");
	$update = $ayarkaydet->execute(array(
		'altmenu_ad' => $_POST['altmenu_ad'],
		'altmenu_url' => $menu_seourl,
		'menu_id' => $_POST['menu_id'],
		'altmenu_icerik' => $_POST['altmenu_icerik'],
		'altmenu_foto' => $refimgyol

	));
	$control = $db->prepare("SELECT * FROM logs");
	$control->execute();
	$count = $control->rowCount();
	if ($count >= $logDeleteLimit) {
		$query = $db->prepare("DELETE FROM logs ORDER BY created_at ASC LIMIT 1");
		$delete = $query->execute(array());
	}
	$newLog = $db->prepare("INSERT INTO logs SET kullanici_id = :kullanici_id, transaction = :transaction, detail = :detail");
	$logControl = $newLog->execute(array(
		"kullanici_id" => intval($_SESSION["kullanici_id"]),
		"transaction" => "Menü Güncellendi",
		"detail" => $_POST['altmenu_ad'] . " Adlı Alt Menü Düzenlendi"
	));
	if ($update) {
		Header("Location:../production/altmenu-duzenle.php?altmenu_id=$menu_id&durum=ok");
	} else {
		Header("Location:../production/altmenu-duzenle.php?altmenu_id=$menu_id&durum=no");
	}
}

if ($_GET['altmenusil'] == "ok") {

	$sil = $db->prepare("DELETE from altmenu where altmenu_id=:id");
	$kontrol = $sil->execute(array(
		'id' => $_GET['altmenu_id']
	));
	$control = $db->prepare("SELECT * FROM logs");
	$control->execute();
	$count = $control->rowCount();
	if ($count >= $logDeleteLimit) {
		$query = $db->prepare("DELETE FROM logs ORDER BY created_at ASC LIMIT 1");
		$delete = $query->execute(array());
	}
	$newLog = $db->prepare("INSERT INTO logs SET kullanici_id = :kullanici_id, transaction = :transaction, detail = :detail");
	$logControl = $newLog->execute(array(
		"kullanici_id" => intval($_SESSION["kullanici_id"]),
		"transaction" => "Menü Silindi",
		"detail" => $_POST['menu_id'] . "ID değerindeki Menü Silindi"
	));
	if ($kontrol) {
		header("location:../production/altmenu.php?sil=ok");
	} else {
		header("location:../production/altmenu.php?sil=no");
	}
}

if (isset($_POST['sliderekle'])) {
	if (isset($_FILES["slider_resimyol"]) && $_FILES["slider_resimyol"]["size"] > 0) {
		$izinli_uzantilar = array('jpg', 'gif', 'png', 'pdf');
		$ext = strtolower(substr($_FILES['slider_resimyol']["name"], strpos($_FILES['slider_resimyol']["name"], '.') + 1));
		if (in_array($ext, $izinli_uzantilar) === false) {
			echo "Uzantı kabul edilmiyor";
			header("Location:../slider.php?durum=formathatali");
			exit;
		}
		$uploads_dir = '../../assets/resim/upload/';
		@$tmp_name = $_FILES['slider_resimyol']["tmp_name"];
		@$name = $_FILES['slider_resimyol']["name"];
		$benzersizad = strtotime(date("YmdHis"));
		$refimgyol = substr($uploads_dir, 6) . "/" . $benzersizad . $name;
		@move_uploaded_file($tmp_name, "$uploads_dir/$benzersizad$name");
	}
	$siraKontrol = $db->prepare("SELECT * FROM slider WHERE slider_sira=?");
	$siraKontrol->execute(array($_POST["slider_sira"]));
	if ($siraKontrol->rowCount() > 0) {
		echo "Bu Sıra Zaten Kullanılıyor";
	} else {

		$icerikkaydet = $db->prepare("INSERT INTO slider SET
				slider_ad=:slider_ad,
				slider_h=:slider_h,
				slider_p=:slider_p,
				slider_sira=:slider_sira,
				slider_buton=:slider_buton,
				slider_buton2=:slider_buton2,
				slider_resimyol=:slider_resimyol		
			");
		$update = $icerikkaydet->execute(array(
			'slider_ad' => $_POST['slider_ad'],
			'slider_h' => $_POST['slider_h'],
			'slider_p' => $_POST['slider_p'],
			'slider_sira' => $_POST['slider_sira'],
			'slider_buton' => $_POST['slider_buton'],
			'slider_buton2' => $_POST['slider_buton2'],
			'slider_resimyol' => $refimgyol
		));
		$control = $db->prepare("SELECT * FROM logs");
		$control->execute();
		$count = $control->rowCount();
		if ($count >= $logDeleteLimit) {
			$query = $db->prepare("DELETE FROM logs ORDER BY created_at ASC LIMIT 1");
			$delete = $query->execute(array());
		}
		$newLog = $db->prepare("INSERT INTO logs SET kullanici_id = :kullanici_id, transaction = :transaction, detail = :detail");
		$logControl = $newLog->execute(array(
			"kullanici_id" => intval($_SESSION["kullanici_id"]),
			"transaction" => "Slider Ekleme",
			"detail" => $_POST['slider_ad'] . " Başlğında Yeni Slider Eklendi"
		));
		if ($update) {
			header("Location:../production/slider.php?durum=ok");
		} else {
			header("Location:../production/slider.php?durum=no");
		}
	}
}

if ($_GET['slidersil'] == "ok") {

	$sil = $db->prepare("DELETE from slider where slider_id=:id");
	$kontrol = $sil->execute(array(
		'id' => $_GET['slider_id']
	));
	$control = $db->prepare("SELECT * FROM logs");
	$control->execute();
	$count = $control->rowCount();
	if ($count >= $logDeleteLimit) {
		$query = $db->prepare("DELETE FROM logs ORDER BY created_at ASC LIMIT 1");
		$delete = $query->execute(array());
	}
	$newLog = $db->prepare("INSERT INTO logs SET kullanici_id = :kullanici_id, transaction = :transaction, detail = :detail");
	$logControl = $newLog->execute(array(
		"kullanici_id" => intval($_SESSION["kullanici_id"]),
		"transaction" => "slider Silindi",
		"detail" => $_GET['slider_id'] . " ID Değerindeki Slider Silindi"
	));
	if ($kontrol) {
		header("location:../production/slider.php?sil=ok");
	} else {
		header("location:../production/slider.php?sil=no");
	}
}

if (isset($_POST['sliderduzenle'])) {
	if (isset($_FILES["slider_resimyol"]) && $_FILES["slider_resimyol"]["size"] > 0) {
		$izinli_uzantilar = array('jpg', 'gif', 'png', 'pdf');
		$ext = strtolower(substr($_FILES['slider_resimyol']["name"], strpos($_FILES['slider_resimyol']["name"], '.') + 1));
		if (in_array($ext, $izinli_uzantilar) === false) {
			echo "Uzantı kabul edilmiyor";
			header("Location:../slider.php?durum=formathatali");
			exit;
		}
		$uploads_dir = '../../assets/resim/upload/';
		@$tmp_name = $_FILES['slider_resimyol']["tmp_name"];
		@$name = $_FILES['slider_resimyol']["name"];
		$benzersizad = strtotime(date("YmdHis"));
		$refimgyol = substr($uploads_dir, 6) . "/" . $benzersizad . $name;
		@move_uploaded_file($tmp_name, "$uploads_dir/$benzersizad$name");
	} else {
		$refimgyol = $_POST["old_img_url"];
	}
	$id = $_POST['slider_id'];
	$ayarkaydet = $db->prepare("UPDATE slider SET
				slider_ad=:slider_ad,		
				slider_h=:slider_h,
				slider_p=:slider_p,
				slider_sira=:slider_sira,
				slider_buton=:slider_buton,
				slider_buton2=:slider_buton2,
				slider_resimyol=:slider_resimyol
			WHERE slider_id={$_POST['slider_id']}");
	$update = $ayarkaydet->execute(array(
		'slider_ad' => $_POST['slider_ad'],
		'slider_h' => $_POST['slider_h'],
		'slider_p' => $_POST['slider_p'],
		'slider_sira' => $_POST['slider_sira'],
		'slider_buton' => $_POST['slider_buton'],
		'slider_buton2' => $_POST['slider_buton2'],
		'slider_resimyol' => $refimgyol
	));
	$control = $db->prepare("SELECT * FROM logs");
	$control->execute();
	$count = $control->rowCount();
	if ($count >= $logDeleteLimit) {
		$query = $db->prepare("DELETE FROM logs ORDER BY created_at ASC LIMIT 1");
		$delete = $query->execute(array());
	}
	$newLog = $db->prepare("INSERT INTO logs SET kullanici_id = :kullanici_id, transaction = :transaction, detail = :detail");
	$logControl = $newLog->execute(array(
		"kullanici_id" => intval($_SESSION["kullanici_id"]),
		"transaction" => "Slider Güncellendi",
		"detail" => $_POST['slider_ad'] . " Başlıklı Slider Düzenlendi"
	));

	if ($update) {
		Header("Location:../production/slider-duzenle.php?slider_id=$id&durum=ok");
	} else {
		Header("Location:../production/slider-duzenle.php?slider_id=$id&durum=no");
	}
}

if (isset($_POST['logoduzenle'])) {
	$uploads_dir = '../../assets/resim/upload/';
	@$tmp_name = $_FILES['ayar_logo']["tmp_name"];
	@$name = $_FILES['ayar_logo']["name"];
	$benzersizsayi4 = rand(20000, 32000);
	$refimgyol = substr($uploads_dir, 6) . "/" . $benzersizsayi4 . $name;
	@move_uploaded_file($tmp_name, "$uploads_dir/$benzersizsayi4$name");
	$duzenle = $db->prepare("UPDATE ayar SET
		ayar_logo=:logo
		WHERE ayar_id=0");
	$update = $duzenle->execute(array(
		'logo' => $refimgyol
	));
	if ($update) {
		$resimsilunlink = $_POST['eski_yol'];
		unlink("../../$resimsilunlink");
		Header("Location:../production/site-ayar.php?durum=ok");
	} else {
		Header("Location:../production/site-ayar.php?durum=no");
	}
}

if (isset($_POST['genelayarkaydet'])) {

	$ayarkaydet = $db->prepare("UPDATE ayar SET
		ayar_title=:ayar_title,
		ayar_video=:ayar_video,
		ayar_description=:ayar_description,
		ayar_keywords=:ayar_keywords,
		ayar_dil=:ayar_dil,
		ayar_author=:ayar_author
		WHERE ayar_id=0");

	$update = $ayarkaydet->execute(array(
		'ayar_title' => $_POST['ayar_title'],
		'ayar_video' => $_POST['ayar_video'],
		'ayar_description' => $_POST['ayar_description'],
		'ayar_keywords' => $_POST['ayar_keywords'],
		'ayar_dil' => $_POST['ayar_dil'],
		'ayar_author' => $_POST['ayar_author']
	));


	if ($update) {

		header("Location:../production/site-ayar.php?durum=ok");
	} else {

		header("Location:../production/site-ayar.php?durum=no");
	}
}

if (isset($_POST['iletisimayarkaydet'])) {

	$ayarkaydet = $db->prepare("UPDATE ayar SET
		ayar_tel=:ayar_tel,
		ayar_gsm=:ayar_gsm,
		ayar_faks=:ayar_faks,
		ayar_mail=:ayar_mail,
		ayar_ilce=:ayar_ilce,
		ayar_il=:ayar_il,
		ayar_adres=:ayar_adres,
		ayar_mesai=:ayar_mesai
		WHERE ayar_id=0");

	$update = $ayarkaydet->execute(array(
		'ayar_tel' => $_POST['ayar_tel'],
		'ayar_gsm' => $_POST['ayar_gsm'],
		'ayar_faks' => $_POST['ayar_faks'],
		'ayar_mail' => $_POST['ayar_mail'],
		'ayar_ilce' => $_POST['ayar_ilce'],
		'ayar_il' => $_POST['ayar_il'],
		'ayar_adres' => $_POST['ayar_adres'],
		'ayar_mesai' => $_POST['ayar_mesai']
	));


	if ($update) {

		header("Location:../production/iletisim-ayarlar.php?durum=ok");
	} else {

		header("Location:../production/iletisim-ayarlar.php?durum=no");
	}
}

if (isset($_POST['sosyalayarkaydet'])) {
	$ayarkaydet = $db->prepare("UPDATE ayar SET
		ayar_facebook=:ayar_facebook,
		ayar_twitter=:ayar_twitter,
		ayar_instagram=:ayar_instagram,
		ayar_youtube=:ayar_youtube
		WHERE ayar_id=0");
	$update = $ayarkaydet->execute(array(
		'ayar_facebook' => $_POST['ayar_facebook'],
		'ayar_twitter' => $_POST['ayar_twitter'],
		'ayar_instagram' => $_POST['ayar_instagram'],
		'ayar_youtube' => $_POST['ayar_youtube']
	));
	if ($update) {
		Header("Location:../production/sosyal-ayar.php?durum=ok");
	} else {
		Header("Location:../production/sosyal-ayar.php?durum=no");
	}
}

if (isset($_POST['urunekle'])) {
	if (isset($_FILES["urun_teknik"]) && $_FILES["urun_teknik"]["size"] > 0) {
		$izinli_uzantilar = array('jpg', 'gif', 'png', 'pdf');
		$ext = strtolower(substr($_FILES['urun_teknik']["name"], strpos($_FILES['urun_teknik']["name"], '.') + 1));
		if (in_array($ext, $izinli_uzantilar) === false) {
			echo "Uzantı kabul edilmiyor";
			header("Location:../urunlerimiz.php?durum=formathatali");
			exit;
		}
		$uploads_dir = '../../assets/resim/upload/';
		@$tmp_name = $_FILES['urun_teknik']["tmp_name"];
		@$name = $_FILES['urun_teknik']["name"];
		$benzersizad = strtotime(date("YmdHis"));
		$refimgyol = substr($uploads_dir, 6) . "/" . $benzersizad . $name;
		@move_uploaded_file($tmp_name, "$uploads_dir/$benzersizad$name");
	}
	$urun_seourl = seo($_POST['urun_ad']);
	$ayarekle = $db->prepare("INSERT INTO urun SET
	urun_ad=:urun_ad,	
	kategori_id=:kategori_id,
	urun_sira=:urun_sira,
	altkategori_id=:altkategori_id,
	urun_kod=:urun_kod,
	urun_url=:urun_url,
	urun_teknik=:urun_teknik,
	urun_video=:urun_video,
	urun_sertifika=:urun_sertifika,		
	urun_aciklama=:urun_aciklama		
	");
	$insert = $ayarekle->execute(array(
		'urun_ad' => $_POST['urun_ad'],
		'kategori_id' => $_POST['kategori_id'],
		'urun_sira' => $_POST['urun_sira'],
		'altkategori_id' => json_encode($_POST['altkategori_id']),
		'urun_kod' => $_POST['urun_kod'],
		'urun_url' => $urun_seourl,
		'urun_teknik' => $refimgyol,
		'urun_video' => $_POST['urun_video'],
		'urun_sertifika' => json_encode($_POST['urun_sertifika']),
		'urun_aciklama' => $_POST['urun_aciklama']
	));
	$control = $db->prepare("SELECT * FROM logs");
	$control->execute();
	$count = $control->rowCount();
	if ($count >= $logDeleteLimit) {
		$query = $db->prepare("DELETE FROM logs ORDER BY created_at ASC LIMIT 1");
		$delete = $query->execute(array());
	}
	$newLog = $db->prepare("INSERT INTO logs SET kullanici_id = :kullanici_id, transaction = :transaction, detail = :detail");
	$logControl = $newLog->execute(array(
		"kullanici_id" => intval($_SESSION["kullanici_id"]),
		"transaction" => "Ürün Eklendi",
		"detail" => $_POST['urun_ad'] . " Adlı Ürün Eklendi"
	));
	if ($insert) {
		Header("Location:../production/urunlerimiz.php?durum=ok");
	} else {
		Header("Location:../production/urunlerimiz.php?durum=no");
	}
}

if ($_GET['urunsil'] == "ok") {

	$sil = $db->prepare("DELETE from urun where urun_id=:id");
	$kontrol = $sil->execute(array(
		'id' => $_GET['urun_id']
	));
	$control = $db->prepare("SELECT * FROM logs");
	$control->execute();
	$count = $control->rowCount();
	if ($count >= $logDeleteLimit) {
		$query = $db->prepare("DELETE FROM logs ORDER BY created_at ASC LIMIT 1");
		$delete = $query->execute(array());
	}
	$newLog = $db->prepare("INSERT INTO logs SET kullanici_id = :kullanici_id, transaction = :transaction, detail = :detail");
	$logControl = $newLog->execute(array(
		"kullanici_id" => intval($_SESSION["kullanici_id"]),
		"transaction" => "Ürün Silindi",
		"detail" => $_GET['urun_id'] . " ID Değerindeki Ürün Silindi"
	));

	if ($kontrol) {
		header("location:../production/urunlerimiz.php?sil=ok");
	} else {
		header("location:../production/urunlerimiz.php?sil=no");
	}
}

if (isset($_POST['urunduzenle'])) {
	if (isset($_FILES["urun_teknik"]) && $_FILES["urun_teknik"]["size"] > 0) {
		$izinli_uzantilar = array('jpg', 'gif', 'png', 'pdf');
		$ext = strtolower(substr($_FILES['urun_teknik']["name"], strpos($_FILES['urun_teknik']["name"], '.') + 1));
		if (in_array($ext, $izinli_uzantilar) === false) {
			echo "Uzantı kabul edilmiyor";
			header("Location:../urunlerimiz.php?durum=formathatali");
			exit;
		}
		$uploads_dir = '../../assets/resim/upload/';
		@$tmp_name = $_FILES['urun_teknik']["tmp_name"];
		@$name = $_FILES['urun_teknik']["name"];
		$benzersizad = strtotime(date("YmdHis"));
		$refimgyol = substr($uploads_dir, 6) . "/" . $benzersizad . $name;
		@move_uploaded_file($tmp_name, "$uploads_dir/$benzersizad$name");
	} else {
		$refimgyol = $_POST["old_img_url"];
	}

	$urun_seourl = seo($_POST['urun_ad']);
	$urun_id = $_POST['urun_id'];

	$ayarekle = $db->prepare("UPDATE urun SET
		urun_ad=:urun_ad,
		kategori_id=:kategori_id,		
		urun_sira=:urun_sira,
		altkategori_id=:altkategori_id,
		urun_kod=:urun_kod,
		urun_url=:urun_url,
		urun_teknik=:urun_teknik,
		urun_video=:urun_video,
		urun_sertifika=:urun_sertifika,
		urun_aciklama=:urun_aciklama
		WHERE urun_id={$_POST['urun_id']}		
		");
	$insert = $ayarekle->execute(array(
		'urun_ad' => $_POST['urun_ad'],
		'kategori_id' => $_POST['kategori_id'],
		'urun_sira' => $_POST['urun_sira'],
		'altkategori_id' => json_encode($_POST['altkategori_id']),
		'urun_kod' => $_POST['urun_kod'],
		'urun_url' => $urun_seourl,
		'urun_teknik' => $refimgyol,
		'urun_video' => $_POST['urun_video'],
		'urun_sertifika' => json_encode($_POST['urun_sertifika']),
		'urun_aciklama' => $_POST['urun_aciklama']
	));
	$control = $db->prepare("SELECT * FROM logs");
	$control->execute();
	$count = $control->rowCount();
	if ($count >= $logDeleteLimit) {
		$query = $db->prepare("DELETE FROM logs ORDER BY created_at ASC LIMIT 1");
		$delete = $query->execute(array());
	}
	$newLog = $db->prepare("INSERT INTO logs SET kullanici_id = :kullanici_id, transaction = :transaction, detail = :detail");
	$logControl = $newLog->execute(array(
		"kullanici_id" => intval($_SESSION["kullanici_id"]),
		"transaction" => "Ürün Düzenlendi",
		"detail" => $_POST['urun_ad'] . " Adlı Ürün Düzenlendi"
	));
	if ($insert) {
		Header("Location:../production/urun-duzenle.php?urun_id=" . $urun_id . "&durum=ok");
	} else {
		Header("Location:../production/urun-duzenle.php?urun_id=" . $urun_id . "&durum=no");
	}
}

if (isset($_POST['kategorikaydet'])) {
	if (isset($_FILES["kategori_resim"]) && $_FILES["kategori_resim"]["size"] > 0) {
		$izinli_uzantilar = array('jpg', 'gif', 'png', 'pdf');
		$ext = strtolower(substr($_FILES['kategori_resim']["name"], strpos($_FILES['kategori_resim']["name"], '.') + 1));
		if (in_array($ext, $izinli_uzantilar) === false) {
			echo "Uzantı kabul edilmiyor";
			header("Location:../kategori.php?durum=formathatali");
			exit;
		}
	}
	$kategori_seourl = seo($_POST['kategori_ad']);
	$uploads_dir = '../../assets/resim/upload/';
	@$tmp_name = $_FILES['kategori_resim']["tmp_name"];
	@$name = $_FILES['kategori_resim']["name"];
	$benzersizad = strtotime(date("YmdHis"));
	$refimgyol = substr($uploads_dir, 6) . "/" . $benzersizad . $name;
	@move_uploaded_file($tmp_name, "$uploads_dir/$benzersizad$name");
	$icerikkaydet = $db->prepare("INSERT INTO kategori SET
			kategori_ad=:kategori_ad,
			kategori_seourl=:kategori_seourl,        
			kategori_resim=:kategori_resim");
	$update = $icerikkaydet->execute(array(
		'kategori_ad' => $_POST['kategori_ad'],
		'kategori_seourl' => $kategori_seourl,
		'kategori_resim' => $refimgyol
	));
	$control = $db->prepare("SELECT * FROM logs");
	$control->execute();
	$count = $control->rowCount();
	if ($count >= $logDeleteLimit) {
		$query = $db->prepare("DELETE FROM logs ORDER BY created_at ASC LIMIT 1");
		$delete = $query->execute(array());
	}
	$newLog = $db->prepare("INSERT INTO logs SET kullanici_id = :kullanici_id, transaction = :transaction, detail = :detail");
	$logControl = $newLog->execute(array(
		"kullanici_id" => intval($_SESSION["kullanici_id"]),
		"transaction" => "kategori Ekleme",
		"detail" => $_POST['kategori_ad'] . " Başlığında Yeni kategori Eklendi"
	));
	if ($update) {
		header("Location:../production/kategori.php?durum=ok");
	} else {
		header("Location:../production/kategori.php?durum=no");
	}
}

if ($_GET['kategorisil'] == "ok") {

	$sil = $db->prepare("DELETE from kategori where kategori_id=:id");
	$kontrol = $sil->execute(array(
		'id' => $_GET['kategori_id']
	));
	$control = $db->prepare("SELECT * FROM logs");
	$control->execute();
	$count = $control->rowCount();
	if ($count >= $logDeleteLimit) {
		$query = $db->prepare("DELETE FROM logs ORDER BY created_at ASC LIMIT 1");
		$delete = $query->execute(array());
	}
	$newLog = $db->prepare("INSERT INTO logs SET kullanici_id = :kullanici_id, transaction = :transaction, detail = :detail");
	$logControl = $newLog->execute(array(
		"kullanici_id" => intval($_SESSION["kullanici_id"]),
		"transaction" => "kategori Silindi",
		"detail" => $_POST['kategori_id'] . "ID değerindeki kategori Silindi"
	));
	if ($kontrol) {
		header("location:../production/kategori.php?sil=ok");
	} else {
		header("location:../production/kategori.php?sil=no");
	}
}

if (isset($_POST['kategoriduzenle'])) {
	if (isset($_FILES["kategori_resim"]) && $_FILES["kategori_resim"]["size"] > 0) {
		$izinli_uzantilar = array('jpg', 'gif', 'png', 'pdf');
		$ext = strtolower(substr($_FILES['kategori_resim']["name"], strpos($_FILES['kategori_resim']["name"], '.') + 1));
		if (in_array($ext, $izinli_uzantilar) === false) {
			echo "Uzantı kabul edilmiyor";
			header("Location:../kategori.php?durum=formathatali");
			exit;
		}

		$uploads_dir = '../../assets/resim/upload/';
		@$tmp_name = $_FILES['kategori_resim']["tmp_name"];
		@$name = $_FILES['kategori_resim']["name"];
		$benzersizad = strtotime(date("YmdHis"));
		$refimgyol = substr($uploads_dir, 6) . "/" . $benzersizad . $name;
		@move_uploaded_file($tmp_name, "$uploads_dir/$benzersizad$name");
	} else {
		$refimgyol = $_POST["old_img_url"];
	}
	$kategori_id = $_POST['kategori_id'];
	$kategori_seourl = seo($_POST['kategori_ad']);
	$ayarkaydet = $db->prepare("UPDATE kategori SET
			kategori_ad=:kategori_ad,
			kategori_seourl=:kategori_seourl,        
			kategori_resim=:kategori_resim
			WHERE kategori_id={$_POST['kategori_id']}");
	$update = $ayarkaydet->execute(array(
		'kategori_ad' => $_POST['kategori_ad'],
		'kategori_seourl' => $kategori_seourl,
		'kategori_resim' => $refimgyol

	));
	$control = $db->prepare("SELECT * FROM logs");
	$control->execute();
	$count = $control->rowCount();
	if ($count >= $logDeleteLimit) {
		$query = $db->prepare("DELETE FROM logs ORDER BY created_at ASC LIMIT 1");
		$delete = $query->execute(array());
	}
	$newLog = $db->prepare("INSERT INTO logs SET kullanici_id = :kullanici_id, transaction = :transaction, detail = :detail");
	$logControl = $newLog->execute(array(
		"kullanici_id" => intval($_SESSION["kullanici_id"]),
		"transaction" => "kategori Güncellendi",
		"detail" => $_POST['kategori_ad'] . " Adlı kategori Düzenlendi"
	));
	if ($update) {
		Header("Location:../production/kategori-duzenle.php?kategori_id=$kategori_id&durum=ok");
	} else {
		Header("Location:../production/kategori-duzenle.php?kategori_id=$kategori_id&durum=no");
	}
}

if (isset($_POST['referansekle'])) {
	if (isset($_FILES["resim"]) && $_FILES["resim"]["size"] > 0) {
		$izinli_uzantilar = array('jpg', 'gif', 'png', 'pdf');
		$ext = strtolower(substr($_FILES['resim']["name"], strpos($_FILES['resim']["name"], '.') + 1));
		if (in_array($ext, $izinli_uzantilar) === false) {
			echo "Uzantı kabul edilmiyor";
			header("Location:../referans.php?durum=formathatali");
			exit;
		}
		$referans_seourl = seo($_POST['ad']);
		$uploads_dir = '../../assets/resim/upload/';
		@$tmp_name = $_FILES['resim']["tmp_name"];
		@$name = $_FILES['resim']["name"];
		$benzersizad = strtotime(date("YmdHis"));
		$refimgyol = substr($uploads_dir, 6) . "/" . $benzersizad . $name;
		@move_uploaded_file($tmp_name, "$uploads_dir/$benzersizad$name");
	} else {
		$refimgyol = $_POST["old_img_url"];
	}
	$icerikkaydet = $db->prepare("INSERT INTO referans SET
		ad=:ad,
		link=:link,
		yapilan_isler=:yapilan_isler,
		resim=:resim		
		");
	$update = $icerikkaydet->execute(array(
		'ad' => $_POST['ad'],
		'link' => $referans_seourl,
		'yapilan_isler' => $_POST['yapilan_isler'],
		'resim' => $refimgyol

	));
	$control = $db->prepare("SELECT * FROM logs");
	$control->execute();
	$count = $control->rowCount();
	if ($count >= $logDeleteLimit) {
		$query = $db->prepare("DELETE FROM logs ORDER BY created_at ASC LIMIT 1");
		$delete = $query->execute(array());
	}
	$newLog = $db->prepare("INSERT INTO logs SET kullanici_id = :kullanici_id, transaction = :transaction, detail = :detail");
	$logControl = $newLog->execute(array(
		"kullanici_id" => intval($_SESSION["kullanici_id"]),
		"transaction" => "Referans Ekleme",
		"detail" => $_POST['ad'] . " Başlğında Yeni Referans Eklendi"
	));
	if ($update) {
		header("Location:../production/referans.php?durum=ok");
	} else {
		header("Location:../production/referans.php?durum=no");
	}
}

if ($_GET['referanssil'] == "ok") {

	$sil = $db->prepare("DELETE from referans where id=:idd");
	$kontrol = $sil->execute(array(
		'idd' => $_GET['id']
	));
	$control = $db->prepare("SELECT * FROM logs");
	$control->execute();
	$count = $control->rowCount();
	if ($count >= $logDeleteLimit) {
		$query = $db->prepare("DELETE FROM logs ORDER BY created_at ASC LIMIT 1");
		$delete = $query->execute(array());
	}
	$newLog = $db->prepare("INSERT INTO logs SET kullanici_id = :kullanici_id, transaction = :transaction, detail = :detail");
	$logControl = $newLog->execute(array(
		"kullanici_id" => intval($_SESSION["kullanici_id"]),
		"transaction" => "referans Silindi",
		"detail" => $_GET['id'] . " ID Değerindeki referans Yazısı Silindi"
	));

	if ($kontrol) {
		header("location:../production/referans.php?sil=ok");
	} else {
		header("location:../production/referans.php?sil=no");
	}
}

if (isset($_POST['referansduzenle'])) {
	if (isset($_FILES["resim"]) && $_FILES["resim"]["size"] > 0) {
		$izinli_uzantilar = array('jpg', 'gif', 'png', 'pdf', 'jpeg');
		$ext = strtolower(substr($_FILES['resim']["name"], strpos($_FILES['resim']["name"], '.') + 1));
		if (in_array($ext, $izinli_uzantilar) === false) {
			echo "Uzantı kabul edilmiyor";
			header("Location:../referans.php?durum=formathatali");
			exit;
		}
		$uploads_dir = '../../assets/resim/upload/';
		@$tmp_name = $_FILES['resim']["tmp_name"];
		@$name = $_FILES['resim']["name"];
		$benzersizad = strtotime(date("YmdHis"));
		$refimgyol = substr($uploads_dir, 6) . "/" . $benzersizad . $name;
		@move_uploaded_file($tmp_name, "$uploads_dir/$benzersizad$name");
	} else {
		$refimgyol = $_POST["old_img_url"];
	}
	$referans_id = $_POST['id'];
	$ayarkaydet = $db->prepare("UPDATE referans SET
			ad=:ad,		
			link=:link,
			yapilan_isler=:yapilan_isler,
			resim=:resim
			WHERE id={$_POST['id']}");
	$update = $ayarkaydet->execute(array(
		'ad' => $_POST['ad'],
		'link' => $referans_seourl,
		'yapilan_isler' => $_POST['yapilan_isler'],
		'resim' => $refimgyol
	));
	$control = $db->prepare("SELECT * FROM logs");
	$control->execute();
	$count = $control->rowCount();
	if ($count >= $logDeleteLimit) {
		$query = $db->prepare("DELETE FROM logs ORDER BY created_at ASC LIMIT 1");
		$delete = $query->execute(array());
	}
	$newLog = $db->prepare("INSERT INTO logs SET kullanici_id = :kullanici_id, transaction = :transaction, detail = :detail");
	$logControl = $newLog->execute(array(
		"kullanici_id" => intval($_SESSION["kullanici_id"]),
		"transaction" => "Referans Güncellendi",
		"detail" => $_POST['ad'] . " Başlıklı Referans Yazısı Düzenlendi"
	));
	if ($update) {
		Header("Location:../production/referans-duzenle.php?id=$referans_id&durum=ok");
	} else {
		Header("Location:../production/referans-duzenle.php?id=$referans_id&durum=no");
	}
}

if (isset($_POST['urunfotosil'])) {
	$urun_id = $_POST['urun_id'];
	echo $checklist = $_POST['urunfotosec'];
	foreach ($checklist as $list) {
		$sil = $db->prepare("DELETE from urunfoto where urunfoto_id=:urunfoto_id");
		$kontrol = $sil->execute(array(
			'urunfoto_id' => $list
		));
	}
	if ($kontrol) {
		Header("Location:../production/urun-galeri.php?urun_id=$urun_id&durum=ok");
	} else {
		Header("Location:../production/urun-galeri.php?urun_id=$urun_id&durum=no");
	}
}

if (isset($_POST['sertifikakaydet'])) {
	if (isset($_FILES["sert_foto"]) && $_FILES["sert_foto"]["size"] > 0) {
		$izinli_uzantilar = array('jpg', 'gif', 'png', 'pdf');
		$ext = strtolower(substr($_FILES['sert_foto']["name"], strpos($_FILES['sert_foto']["name"], '.') + 1));
		if (in_array($ext, $izinli_uzantilar) === false) {
			echo "Uzantı kabul edilmiyor";
			header("Location:../sertifika.php?durum=formathatali");
			exit;
		}
	}

	$uploads_dir = '../../assets/resim/upload/';
	@$tmp_name = $_FILES['sert_foto']["tmp_name"];	
	$benzersizad = strtotime(date("YmdHis"));
	$refimgyol = substr($uploads_dir, 6) . "/" . $benzersizad;
	@move_uploaded_file($tmp_name, "$uploads_dir/$benzersizad");
	$icerikkaydet = $db->prepare("INSERT INTO sertifika SET
			sert_ad=:sert_ad,			       
			sert_foto=:sert_foto");
	$update = $icerikkaydet->execute(array(
		'sert_ad' => $_POST['sert_ad'],
		'sert_foto' => $refimgyol
	));
	$control = $db->prepare("SELECT * FROM logs");
	$control->execute();
	$count = $control->rowCount();
	if ($count >= $logDeleteLimit) {
		$query = $db->prepare("DELETE FROM logs ORDER BY created_at ASC LIMIT 1");
		$delete = $query->execute(array());
	}
	$newLog = $db->prepare("INSERT INTO logs SET kullanici_id = :kullanici_id, transaction = :transaction, detail = :detail");
	$logControl = $newLog->execute(array(
		"kullanici_id" => intval($_SESSION["kullanici_id"]),
		"transaction" => "sertifika Ekleme",
		"detail" => $_POST['sert_ad'] . " Adında Yeni sertifika Eklendi"
	));
	if ($update) {
		header("Location:../production/sertifika.php?durum=ok");
	} else {
		header("Location:../production/sertifika.php?durum=no");
	}
}

if ($_GET['sertifikasil'] == "ok") {

	$sil = $db->prepare("DELETE from sertifika where sert_id=:id");
	$kontrol = $sil->execute(array(
		'id' => $_GET['sert_id']
	));
	$control = $db->prepare("SELECT * FROM logs");
	$control->execute();
	$count = $control->rowCount();
	if ($count >= $logDeleteLimit) {
		$query = $db->prepare("DELETE FROM logs ORDER BY created_at ASC LIMIT 1");
		$delete = $query->execute(array());
	}
	$newLog = $db->prepare("INSERT INTO logs SET kullanici_id = :kullanici_id, transaction = :transaction, detail = :detail");
	$logControl = $newLog->execute(array(
		"kullanici_id" => intval($_SESSION["kullanici_id"]),
		"transaction" => "Sertifika Silindi",
		"detail" => $_GET['urun_id'] . " ID Değerindeki Sertifika Silindi"
	));

	if ($kontrol) {
		header("location:../production/sertifika.php?sil=ok");
	} else {
		header("location:../production/sertifika.php?sil=no");
	}
}

if (isset($_POST['sertduzenle'])) {
	if (isset($_FILES["sert_foto"]) && $_FILES["sert_foto"]["size"] > 0) {
		$izinli_uzantilar = array('jpg', 'gif', 'png', 'pdf');
		$ext = strtolower(substr($_FILES['sert_foto']["name"], strpos($_FILES['sert_foto']["name"], '.') + 1));
		if (in_array($ext, $izinli_uzantilar) === false) {
			echo "Uzantı kabul edilmiyor";
			header("Location:../sert.php?durum=formathatali");
			exit;
		}

		$uploads_dir = '../../assets/resim/upload/';
		@$tmp_name = $_FILES['sert_foto']["tmp_name"];
		
		$benzersizad = strtotime(date("YmdHis"));
		$refimgyol = substr($uploads_dir, 6) . "/" . $benzersizad;
		@move_uploaded_file($tmp_name, "$uploads_dir/$benzersizad");
	} else {
		$refimgyol = $_POST["old_img_url"];
	}
	$sert_id = $_POST['sert_id'];

	$ayarkaydet = $db->prepare("UPDATE sertifika SET
			sert_ad=:sert_ad,			        
			sert_foto=:sert_foto
			WHERE sert_id={$_POST['sert_id']}");
	$update = $ayarkaydet->execute(array(
		'sert_ad' => $_POST['sert_ad'],
		'sert_foto' => $refimgyol

	));
	$control = $db->prepare("SELECT * FROM logs");
	$control->execute();
	$count = $control->rowCount();
	if ($count >= $logDeleteLimit) {
		$query = $db->prepare("DELETE FROM logs ORDER BY created_at ASC LIMIT 1");
		$delete = $query->execute(array());
	}
	$newLog = $db->prepare("INSERT INTO logs SET kullanici_id = :kullanici_id, transaction = :transaction, detail = :detail");
	$logControl = $newLog->execute(array(
		"kullanici_id" => intval($_SESSION["kullanici_id"]),
		"transaction" => "Sertifika Güncellendi",
		"detail" => $_POST['sert_ad'] . " Adlı Sertifika Düzenlendi"
	));
	if ($update) {
		Header("Location:../production/sert-duzenle.php?sert_id=$sert_id&durum=ok");
	} else {
		Header("Location:../production/sert-duzenle.php?sert_id=$sert_id&durum=no");
	}
}

if (isset($_POST['dilekle'])) {
	if (isset($_FILES["lang_icon"]) && $_FILES["lang_icon"]["size"] > 0) {
		$izinli_uzantilar = array('jpg', 'gif', 'png', 'pdf');
		$ext = strtolower(substr($_FILES['lang_icon']["name"], strpos($_FILES['lang_icon']["name"], '.') + 1));
		if (in_array($ext, $izinli_uzantilar) === false) {
			echo "Uzantı kabul edilmiyor";
			header("Location:../dil.php?durum=formathatali");
			exit;
		}
		$uploads_dir = '../../assets/resim/upload/';
		@$tmp_name = $_FILES['lang_icon']["tmp_name"];
		@$name = $_FILES['lang_icon']["name"];
		$benzersizad = strtotime(date("YmdHis"));
		$refimgyol = substr($uploads_dir, 6) . "/" . $benzersizad . $name;
		@move_uploaded_file($tmp_name, "$uploads_dir/$benzersizad$name");
	}


	$icerikkaydet = $db->prepare("INSERT INTO diller SET
	lang_name=:lang_name,
	lang_code=:lang_code,
	align=:align,
	sira=:sira,
	durum=:durum,
	lang_icon=:lang_icon
	");
	$update = $icerikkaydet->execute(array(
		'lang_name' => $_POST['lang_name'],
		'lang_code' => $_POST['lang_code'],
		'align' => $_POST['align'],
		'sira' => $_POST['sira'],
		'durum' => $_POST['durum'],
		'lang_icon' => $refimgyol
	));
	$control = $db->prepare("SELECT * FROM logs");
	$control->execute();
	$count = $control->rowCount();
	if ($count >= $logDeleteLimit) {
		$query = $db->prepare("DELETE FROM logs ORDER BY created_at ASC LIMIT 1");
		$delete = $query->execute(array());
	}
	$newLog = $db->prepare("INSERT INTO logs SET kullanici_id = :kullanici_id, transaction = :transaction, detail = :detail");
	$logControl = $newLog->execute(array(
		"kullanici_id" => intval($_SESSION["kullanici_id"]),
		"transaction" => "dil Ekleme",
		"detail" => $_POST['lang_name'] . " Başlğında Yeni dil Eklendi"
	));
	if ($update) {
		header("Location:../production/dil.php?durum=ok");
	} else {
		header("Location:../production/dil.php?durum=no");
	}
}

if ($_GET['dilsil'] == "ok") {

	$sil = $db->prepare("DELETE from diller where id=:id");
	$kontrol = $sil->execute(array(
		'id' => $_GET['id']
	));
	$control = $db->prepare("SELECT * FROM logs");
	$control->execute();
	$count = $control->rowCount();
	if ($count >= $logDeleteLimit) {
		$query = $db->prepare("DELETE FROM logs ORDER BY created_at ASC LIMIT 1");
		$delete = $query->execute(array());
	}
	$newLog = $db->prepare("INSERT INTO logs SET kullanici_id = :kullanici_id, transaction = :transaction, detail = :detail");
	$logControl = $newLog->execute(array(
		"kullanici_id" => intval($_SESSION["kullanici_id"]),
		"transaction" => "Dil Silindi",
		"detail" => $_GET['id'] . " ID Değerindeki Sertifika Silindi"
	));

	if ($kontrol) {
		header("location:../production/dil.php?sil=ok");
	} else {
		header("location:../production/dil.php?sil=no");
	}
}

if (isset($_POST['dilduzenle'])) {
	if (isset($_FILES["lang_icon"]) && $_FILES["lang_icon"]["size"] > 0) {
		$izinli_uzantilar = array('jpg', 'gif', 'png', 'pdf');
		$ext = strtolower(substr($_FILES['lang_icon']["name"], strpos($_FILES['lang_icon']["name"], '.') + 1));
		if (in_array($ext, $izinli_uzantilar) === false) {
			echo "Uzantı kabul edilmiyor";
			header("Location:../dil.php?durum=formathatali");
			exit;
		}
		$uploads_dir = '../../assets/resim/upload/';
		@$tmp_name = $_FILES['lang_icon']["tmp_name"];
		@$name = $_FILES['lang_icon']["name"];
		$benzersizad = strtotime(date("YmdHis"));
		$refimgyol = substr($uploads_dir, 6) . "/" . $benzersizad . $name;
		@move_uploaded_file($tmp_name, "$uploads_dir/$benzersizad$name");
	} else {
		$refimgyol = $_POST["old_img_url"];
	}
	$id = $_POST['id'];

	$icerikkaydet = $db->prepare("UPDATE diller SET
	lang_name=:lang_name,
	lang_code=:lang_code,
	align=:align,
	sira=:sira,
	durum=:durum,
	lang_icon=:lang_icon
	WHERE id={$_POST['id']}");
	$update = $icerikkaydet->execute(array(
		'lang_name' => $_POST['lang_name'],
		'lang_code' => $_POST['lang_code'],
		'align' => $_POST['align'],
		'sira' => $_POST['sira'],
		'durum' => $_POST['durum'],
		'lang_icon' => $refimgyol
	));
	$control = $db->prepare("SELECT * FROM logs");
	$control->execute();
	$count = $control->rowCount();
	if ($count >= $logDeleteLimit) {
		$query = $db->prepare("DELETE FROM logs ORDER BY created_at ASC LIMIT 1");
		$delete = $query->execute(array());
	}
	$newLog = $db->prepare("INSERT INTO logs SET kullanici_id = :kullanici_id, transaction = :transaction, detail = :detail");
	$logControl = $newLog->execute(array(
		"kullanici_id" => intval($_SESSION["kullanici_id"]),
		"transaction" => "Dil güncelleme",
		"detail" => $_POST['lang_name'] . " Dili Güncellendi"
	));
	if ($update) {
		header("Location:../production/dil-duzenle.php?id=$id&durum=ok");
	} else {
		header("Location:../production/dil-duzenle.php?id=$id&durum=no");
	}
}

if (isset($_POST['yorumekle'])) {
	if (isset($_FILES["foto"]) && $_FILES["foto"]["size"] > 0) {
		$izinli_uzantilar = array('jpg', 'gif', 'png', 'pdf');
		$ext = strtolower(substr($_FILES['foto']["name"], strpos($_FILES['foto']["name"], '.') + 1));
		if (in_array($ext, $izinli_uzantilar) === false) {
			echo "Uzantı kabul edilmiyor";
			header("Location:../musteriyorum.php?durum=formathatali");
			exit;
		}
		$uploads_dir = '../../assets/resim/upload/';
		@$tmp_name = $_FILES['foto']["tmp_name"];
		@$name = $_FILES['foto']["name"];
		$benzersizad = strtotime(date("YmdHis"));
		$refimgyol = substr($uploads_dir, 6) . "/" . $benzersizad . $name;
		@move_uploaded_file($tmp_name, "$uploads_dir/$benzersizad$name");
	}


	$icerikkaydet = $db->prepare("INSERT INTO musteriyorum SET
	ad_soyad=:ad_soyad,
	icerik=:icerik,	
	foto=:foto
	");
	$update = $icerikkaydet->execute(array(
		'ad_soyad' => $_POST['ad_soyad'],
		'icerik' => $_POST['icerik'],
		'foto' => $refimgyol
	));
	$control = $db->prepare("SELECT * FROM logs");
	$control->execute();
	$count = $control->rowCount();
	if ($count >= $logDeleteLimit) {
		$query = $db->prepare("DELETE FROM logs ORDER BY created_at ASC LIMIT 1");
		$delete = $query->execute(array());
	}
	$newLog = $db->prepare("INSERT INTO logs SET kullanici_id = :kullanici_id, transaction = :transaction, detail = :detail");
	$logControl = $newLog->execute(array(
		"kullanici_id" => intval($_SESSION["kullanici_id"]),
		"transaction" => "Yorum Ekleme",
		"detail" => $_POST['ad_soyad'] . "  Yeni Yorum Eklendi"
	));
	if ($update) {
		header("Location:../production/musteriyorum.php?durum=ok");
	} else {
		header("Location:../production/musteriyorum.php?durum=no");
	}
}

if (isset($_POST['yorumduzenle'])) {
	if (isset($_FILES["foto"]) && $_FILES["foto"]["size"] > 0) {
		$izinli_uzantilar = array('jpg', 'gif', 'png', 'pdf');
		$ext = strtolower(substr($_FILES['foto']["name"], strpos($_FILES['foto']["name"], '.') + 1));
		if (in_array($ext, $izinli_uzantilar) === false) {
			echo "Uzantı kabul edilmiyor";
			header("Location:../musteriyorum.php?durum=formathatali");
			exit;
		}
		$uploads_dir = '../../assets/resim/upload/';
		@$tmp_name = $_FILES['foto']["tmp_name"];
		@$name = $_FILES['foto']["name"];
		$benzersizad = strtotime(date("YmdHis"));
		$refimgyol = substr($uploads_dir, 6) . "/" . $benzersizad . $name;
		@move_uploaded_file($tmp_name, "$uploads_dir/$benzersizad$name");
	} else {
		$refimgyol = $_POST["old_img_url"];
	}
	$id = $_POST['id'];

	$icerikkaydet = $db->prepare("UPDATE musteriyorum SET
	ad_soyad=:ad_soyad,
	icerik=:icerik,	
	foto=:foto
	WHERE id={$_POST['id']}");
	$update = $icerikkaydet->execute(array(
		'ad_soyad' => $_POST['ad_soyad'],
		'icerik' => $_POST['icerik'],
		'foto' => $refimgyol
	));
	$control = $db->prepare("SELECT * FROM logs");
	$control->execute();
	$count = $control->rowCount();
	if ($count >= $logDeleteLimit) {
		$query = $db->prepare("DELETE FROM logs ORDER BY created_at ASC LIMIT 1");
		$delete = $query->execute(array());
	}
	$newLog = $db->prepare("INSERT INTO logs SET kullanici_id = :kullanici_id, transaction = :transaction, detail = :detail");
	$logControl = $newLog->execute(array(
		"kullanici_id" => intval($_SESSION["kullanici_id"]),
		"transaction" => "Yorum Düzenleme",
		"detail" => $_POST['ad_soyad'] . "  Yorum Düzenlendi"
	));
	if ($update) {
		header("Location:../production/yorum-duzenle.php?id=$id&durum=ok");
	} else {
		header("Location:../production/yorum-duzenle.php?id=$id&durum=no");
	}
}

if ($_GET['yorumsil'] == "ok") {

	$sil = $db->prepare("DELETE from musteriyorum where id=:id");
	$kontrol = $sil->execute(array(
		'id' => $_GET['id']
	));
	$control = $db->prepare("SELECT * FROM logs");
	$control->execute();
	$count = $control->rowCount();
	if ($count >= $logDeleteLimit) {
		$query = $db->prepare("DELETE FROM logs ORDER BY created_at ASC LIMIT 1");
		$delete = $query->execute(array());
	}
	$newLog = $db->prepare("INSERT INTO logs SET kullanici_id = :kullanici_id, transaction = :transaction, detail = :detail");
	$logControl = $newLog->execute(array(
		"kullanici_id" => intval($_SESSION["kullanici_id"]),
		"transaction" => "Müşteri yorumu Silindi",
		"detail" => $_GET['id'] . " ID Değerindeki Müşteri yorumu Silindi"
	));

	if ($kontrol) {
		header("location:../production/musteriyorum.php?sil=ok");
	} else {
		header("location:../production/musteriyorum.php?sil=no");
	}
}

if (isset($_POST['katalogekle'])) {
	if (isset($_FILES["url"]) && $_FILES["url"]["size"] > 0) {
		$izinli_uzantilar = array('jpg', 'gif', 'png', 'pdf');
		$ext = strtolower(substr($_FILES['url']["name"], strpos($_FILES['url']["name"], '.') + 1));
		if (in_array($ext, $izinli_uzantilar) === false) {
			echo "Uzantı kabul edilmiyor";
			header("Location:../katalog.php?durum=formathatali");
			exit;
		}
		$uploads_dir = '../../assets/resim/upload/';
		@$tmp_name = $_FILES['url']["tmp_name"];
		@$name = $_FILES['url']["name"];
		$benzersizad = strtotime(date("YmdHis"));
		$refimgyol = substr($uploads_dir, 6) . "/" . $benzersizad . $name;
		@move_uploaded_file($tmp_name, "$uploads_dir/$benzersizad$name");
	}


	$icerikkaydet = $db->prepare("INSERT INTO katalog SET
	ad=:ad,		
	url=:url
	");
	$update = $icerikkaydet->execute(array(
		'ad' => $_POST['ad'],
		'url' => $refimgyol
	));
	$control = $db->prepare("SELECT * FROM logs");
	$control->execute();
	$count = $control->rowCount();
	if ($count >= $logDeleteLimit) {
		$query = $db->prepare("DELETE FROM logs ORDER BY created_at ASC LIMIT 1");
		$delete = $query->execute(array());
	}
	$newLog = $db->prepare("INSERT INTO logs SET kullanici_id = :kullanici_id, transaction = :transaction, detail = :detail");
	$logControl = $newLog->execute(array(
		"kullanici_id" => intval($_SESSION["kullanici_id"]),
		"transaction" => "Katalog Ekleme",
		"detail" => $_POST['ad'] . "  Yeni Katalog Eklendi"
	));
	if ($update) {
		header("Location:../production/katalog.php?durum=ok");
	} else {
		header("Location:../production/katalog.php?durum=no");
	}
}

if ($_GET['katalogsil'] == "ok") {

	$sil = $db->prepare("DELETE from katalog where id=:id");
	$kontrol = $sil->execute(array(
		'id' => $_GET['id']
	));
	$control = $db->prepare("SELECT * FROM logs");
	$control->execute();
	$count = $control->rowCount();
	if ($count >= $logDeleteLimit) {
		$query = $db->prepare("DELETE FROM logs ORDER BY created_at ASC LIMIT 1");
		$delete = $query->execute(array());
	}
	$newLog = $db->prepare("INSERT INTO logs SET kullanici_id = :kullanici_id, transaction = :transaction, detail = :detail");
	$logControl = $newLog->execute(array(
		"kullanici_id" => intval($_SESSION["kullanici_id"]),
		"transaction" => "Katalog Silindi",
		"detail" => $_GET['id'] . " ID Değerindeki Katalog Silindi"
	));

	if ($kontrol) {
		header("location:../production/katalog.php?sil=ok");
	} else {
		header("location:../production/katalog.php?sil=no");
	}
}

if (isset($_POST['ceviri_update'])) {

	$diller = $db->query("SELECT * FROM diller")->fetchAll();

	foreach ($diller as $dil) {

		$bak = $db->query("SELECT * FROM translates WHERE ceviri_id='{$_POST['ceviri_id']}' AND lang_id='{$dil['id']}'")->fetch();

		if ($bak) {

			$save = $db->prepare("UPDATE translates SET
			translate=:translate
			WHERE ceviri_id='{$_POST['ceviri_id']}' AND lang_id='{$dil['id']}'");

			$postname = 'translate_' . $dil['id'];

			$update = $save->execute(array(
				'translate' => $_POST[$postname],
			));
		} else {

			$save = $db->prepare("INSERT INTO translates SET
			translate=:translate,
			lang_id=:lang_id,
			ceviri_id=:ceviri_id");

			$postname = 'translate_' . $dil['id'];

			$update = $save->execute(array(
				'translate' => $_POST[$postname],
				'lang_id' => $dil['id'],
				'ceviri_id' => $_POST['ceviri_id']
			));
		}
	}

	header("Location:../production/translates_edit.php?ceviri_id=" . $_POST['ceviri_id']);
}

if (isset($_POST['albumekle'])) {
	$kategori_seourl = seo($_POST['ad']);
	$icerikkaydet = $db->prepare("INSERT INTO gal_kat SET
	ad=:ad,
	kat_url=:kat_url	
	");
	$update = $icerikkaydet->execute(array(
		'ad' => $_POST['ad'],
		'kat_url' => $kategori_seourl

	));
	$control = $db->prepare("SELECT * FROM logs");
	$control->execute();
	$count = $control->rowCount();
	if ($count >= $logDeleteLimit) {
		$query = $db->prepare("DELETE FROM logs ORDER BY created_at ASC LIMIT 1");
		$delete = $query->execute(array());
	}
	$newLog = $db->prepare("INSERT INTO logs SET kullanici_id = :kullanici_id, transaction = :transaction, detail = :detail");
	$logControl = $newLog->execute(array(
		"kullanici_id" => intval($_SESSION["kullanici_id"]),
		"transaction" => "Galeri Ekleme",
		"detail" => $_POST['ad'] . "Adında Galeri Eklendi"
	));
	if ($update) {
		header("Location:../production/fotogalerimiz.php?durum=ok");
	} else {
		header("Location:../production/fotogalerimiz.php?durum=no");
	}
}

if ($_GET['albumsil'] == "ok") {

	$sil = $db->prepare("DELETE from gal_kat where kategori_idd =:kategori_idd");
	$kontrol = $sil->execute(array(
		'kategori_idd' => $_GET['kategori_idd']
	));
	$control = $db->prepare("SELECT * FROM logs");
	$control->execute();
	$count = $control->rowCount();
	if ($count >= $logDeleteLimit) {
		$query = $db->prepare("DELETE FROM logs ORDER BY created_at ASC LIMIT 1");
		$delete = $query->execute(array());
	}
	$newLog = $db->prepare("INSERT INTO logs SET kullanici_id = :kullanici_id, transaction = :transaction, detail = :detail");
	$logControl = $newLog->execute(array(
		"kullanici_id" => intval($_SESSION["kullanici_id"]),
		"transaction" => "Katalog Silindi",
		"detail" => $_GET['kategori_idd'] . " ID Değerindeki Katalog Silindi"
	));

	if ($kontrol) {
		header("location:../production/fotogalerimiz.php?sil=ok");
	} else {
		header("location:../production/fotogalerimiz.php?sil=no");
	}
}

if (isset($_POST['ulkeekle'])) {

	$icerikkaydet = $db->prepare("INSERT INTO ulkeler SET
	name=:name		
	");
	$update = $icerikkaydet->execute(array(
		'name' => $_POST['name']
	));
	$control = $db->prepare("SELECT * FROM logs");
	$control->execute();
	$count = $control->rowCount();
	if ($count >= $logDeleteLimit) {
		$query = $db->prepare("DELETE FROM logs ORDER BY created_at ASC LIMIT 1");
		$delete = $query->execute(array());
	}
	$newLog = $db->prepare("INSERT INTO logs SET kullanici_id = :kullanici_id, transaction = :transaction, detail = :detail");
	$logControl = $newLog->execute(array(
		"kullanici_id" => intval($_SESSION["kullanici_id"]),
		"transaction" => "Ülke Ekleme",
		"detail" => $_POST['name'] . " Başlğında Yeni Ülke Eklendi"
	));
	if ($update) {
		header("Location:../production/ulke.php?durum=ok");
	} else {
		header("Location:../production/ulke.php?durum=no");
	}
}

if ($_GET['ulkesil'] == "ok") {

	$sil = $db->prepare("DELETE from ulkeler where ulke_id=:ulke_id");
	$kontrol = $sil->execute(array(
		'ulke_id' => $_GET['ulke_id']
	));
	$control = $db->prepare("SELECT * FROM logs");
	$control->execute();
	$count = $control->rowCount();
	if ($count >= $logDeleteLimit) {
		$query = $db->prepare("DELETE FROM logs ORDER BY created_at ASC LIMIT 1");
		$delete = $query->execute(array());
	}
	$newLog = $db->prepare("INSERT INTO logs SET kullanici_id = :kullanici_id, transaction = :transaction, detail = :detail");
	$logControl = $newLog->execute(array(
		"kullanici_id" => intval($_SESSION["kullanici_id"]),
		"transaction" => "Ülke Silindi",
		"detail" => $_GET['ulke_id'] . " ID Değerindeki Ülke Silindi"
	));

	if ($kontrol) {
		header("location:../production/ulke.php?sil=ok");
	} else {
		header("location:../production/ulke.php?sil=no");
	}
}

if (isset($_POST['epostakaydet'])) {

	$ayarkaydet = $db->prepare("UPDATE eposta_ayar SET
		kariyer_eposta=:kariyer_eposta,
		teklif_eposta=:teklif_eposta,
		iletisim_eposta=:iletisim_eposta

		WHERE id=1");

	$update = $ayarkaydet->execute(array(
		'kariyer_eposta' => $_POST['kariyer_eposta'],
		'teklif_eposta' => $_POST['teklif_eposta'],
		'iletisim_eposta' => $_POST['iletisim_eposta']

	));

	if ($update) {

		header("Location:../production/eposta-ayar.php?durum=ok");
	} else {

		header("Location:../production/eposta-ayar.php?durum=no");
	}
	$control = $db->prepare("SELECT * FROM logs");
	$control->execute();
	$count = $control->rowCount();
	if ($count >= $logDeleteLimit) {
		$query = $db->prepare("DELETE FROM logs ORDER BY created_at ASC LIMIT 1");
		$delete = $query->execute(array());
	}
	$newLog = $db->prepare("INSERT INTO logs SET kullanici_id = :kullanici_id, transaction = :transaction, detail = :detail");
	$logControl = $newLog->execute(array(
		"kullanici_id" => intval($_SESSION["kullanici_id"]),
		"transaction" => "E-posta ayarları güncellendi",

	));
}

if (isset($_POST['altkategorikaydet'])) {

	$kategori_seourl = seo($_POST['ad']);

	$icerikkaydet = $db->prepare("INSERT INTO alt_kategori SET
			ad=:ad,
			seourl=:seourl,        
			ust=:ust ");
	$update = $icerikkaydet->execute(array(
		'ad' => $_POST['ad'],
		'seourl' => $kategori_seourl,
		'ust' => json_encode($_POST['ust'])

	));
	$control = $db->prepare("SELECT * FROM logs");
	$control->execute();
	$count = $control->rowCount();
	if ($count >= $logDeleteLimit) {
		$query = $db->prepare("DELETE FROM logs ORDER BY created_at ASC LIMIT 1");
		$delete = $query->execute(array());
	}
	$newLog = $db->prepare("INSERT INTO logs SET kullanici_id = :kullanici_id, transaction = :transaction, detail = :detail");
	$logControl = $newLog->execute(array(
		"kullanici_id" => intval($_SESSION["kullanici_id"]),
		"transaction" => "alt kategori Ekleme",
		"detail" => $_POST['ad'] . " Başlığında Yeni Alt kategori Eklendi"
	));
	if ($update) {
		header("Location:../production/altkategori.php?durum=ok");
	} else {
		header("Location:../production/altkategori.php?durum=no");
	}
}

if (isset($_POST['altkategoriduzenle'])) {	
	$idd = $_POST['id'];
	$kategori_seourl = seo($_POST['ad']);
	$icerikkaydet = $db->prepare("UPDATE alt_kategori SET
			ad=:ad,
			seourl=:seourl,        
			ust=:ust 
	WHERE id={$_POST['id']}");
	
	$update = $icerikkaydet->execute(array(
		'ad' => $_POST['ad'],
		'seourl' => $kategori_seourl,
		'ust' => json_encode($_POST['ust'])
	));
	$control = $db->prepare("SELECT * FROM logs");
	$control->execute();
	$count = $control->rowCount();
	if ($count >= $logDeleteLimit) {
		$query = $db->prepare("DELETE FROM logs ORDER BY created_at ASC LIMIT 1");
		$delete = $query->execute(array());
	}
	$newLog = $db->prepare("INSERT INTO logs SET kullanici_id = :kullanici_id, transaction = :transaction, detail = :detail");
	$logControl = $newLog->execute(array(
		"kullanici_id" => intval($_SESSION["kullanici_id"]),
		"transaction" => "Dil güncelleme",
		"detail" => $_POST['lang_name'] . " Dili Güncellendi"
	));
	if ($update) {
		header("Location:../production/alt-kategori-duzenle.php?id=$idd&durum=ok");
	} else {
		header("Location:../production/alt-kategori-duzenle.php?id=$idd&durum=no");
	}
}
if ($_GET['altkategorisil'] == "ok") {

	$sil = $db->prepare("DELETE from alt_kategori where id=:id");
	$kontrol = $sil->execute(array(
		'id' => $_GET['id']
	));
	$control = $db->prepare("SELECT * FROM logs");
	$control->execute();
	$count = $control->rowCount();
	if ($count >= $logDeleteLimit) {
		$query = $db->prepare("DELETE FROM logs ORDER BY created_at ASC LIMIT 1");
		$delete = $query->execute(array());
	}
	$newLog = $db->prepare("INSERT INTO logs SET kullanici_id = :kullanici_id, transaction = :transaction, detail = :detail");
	$logControl = $newLog->execute(array(
		"kullanici_id" => intval($_SESSION["kullanici_id"]),
		"transaction" => "Alt Kategori Silindi",
		"detail" => $_GET['id'] . " ID Değerindeki Alt Kategori Silindi"
	));

	if ($kontrol) {
		header("location:../production/altkategori.php?sil=ok");
	} else {
		header("location:../production/altkategori.php?sil=no");
	}
}
