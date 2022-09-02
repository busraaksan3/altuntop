<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

include 'admin/baglan/baglan.php';

$ayarsor=$db->prepare("select * from ayar where ayar_id=?");
$ayarsor->execute(array(0));
$ayarcek=$ayarsor->fetch(PDO::FETCH_ASSOC);

$mail = new PHPMailer(true);

try {

    $mail->SMTPDebug = SMTP::DEBUG_OFF;
    $mail->isSMTP();
    $mail->CharSet = "UTF-8";
    $mail->Host       = $ayarcek['ayar_smtphost'];
    $mail->SMTPAuth   = true;
    $mail->Username   = $ayarcek['ayar_smtpuser'];
    $mail->Password   = $ayarcek['ayar_smtppassword'];
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port       = $ayarcek['ayar_smtpport'];
    $mail->isHTML(true);


    $mail->setFrom($ayarcek['ayar_smtpuser'], $ayarcek['ayar_smtpfromname']);
    $mail->addReplyTo($ayarcek['ayar_smtpuser'], $ayarcek['ayar_smtpfromname']);

    // DEĞİŞKEN

    if(@$_POST['mail_type'] == "teklif"){

        $get_eposta_ayar = getEpostaAyar("teklif_eposta",$db);
        $cozbaba = explode(",",$get_eposta_ayar);

        foreach ($cozbaba as $coz){
            $mail->addAddress($coz);
        }

        $get_ulke_to_users = getCountCountryForUserForMail($db,$_POST['country']);
        foreach ($get_ulke_to_users as $utu){
            $getUser = getUser($db,$utu['kullanici_id']);
            $mail->addAddress($getUser['kullanici_mail']);
        }

        $mail->Subject = __c("FİYAT TEKLİF İSTEĞİ");

        $bodyContent = "";

        $bodyContent .= '<b>'.__c("Ad Soyad").' : </b>'.'&nbsp;'.$_POST['name'].'<br>';
        $bodyContent .= '<b>'.__c("Ülke").' : </b>'.'&nbsp;'.getCountryNameForID($_POST['country'],$db).'<br>';
        $bodyContent .= '<b>'.__c("Şehir").' : </b>'.'&nbsp;'.$_POST['city'].'<br>';
        $bodyContent .= '<b>'.__c("E-Posta").' : </b>'.'&nbsp;'.$_POST['email'].'<br>';
        $bodyContent .= '<b>'.__c("Telefon").' : </b>'.'&nbsp;'.$_POST['phone'].'<br>';
        $bodyContent .= '<b>'.__c("Üretilecek Ürün").' : </b>'.'&nbsp;'.$_POST['urun_name'].'<br>';
        $bodyContent .= '<b>'.__c("Üretilecek Ürün Gramı (Ürün Başı)").' : </b>'.'&nbsp;'.$_POST['urun_gram'].'<br>';
        $bodyContent .= '<b>'.__c("Üretilecek Ürün Sayısı (8 saatte)").' : </b>'.'&nbsp;'.$_POST['urun_saat'].'<br>';

        $mail->Body = $bodyContent;

        $mail->send();

        $msg = __c("Talebiniz başarıyla alındı ! En kısa süre içerisinde size geri dönüş sağlayacağız.");
        Header("Location:teklif.php?type=1&message=$msg");

    }

    if(@$_POST['mail_type'] == "kariyer"){

        $get_eposta_ayar = getEpostaAyar("kariyer_eposta",$db);
        $cozbaba = explode(",",$get_eposta_ayar);

        foreach ($cozbaba as $coz){
            $mail->addAddress($coz);
        }

        $mail->Subject = __c("KARİYER TALEP İSTEĞİ");

        $bodyContent = "";

        $bodyContent .= '<b>'.__c("Ad Soyad").' : </b>'.'&nbsp;'.$_POST['name'].'<br>';
        $bodyContent .= '<b>'.__c("E-Posta").' : </b>'.'&nbsp;'.$_POST['email'].'<br>';
        $bodyContent .= '<b>'.__c("Telefon").' : </b>'.'&nbsp;'.$_POST['phone'].'<br>';
        $bodyContent .= '<b>'.__c("Mesaj").' : </b>'.'&nbsp;'.$_POST['message'].'<br>';

        $mail->Body = $bodyContent;

        $mail->send();

        $msg = __c("Talebiniz başarıyla alındı ! En kısa süre içerisinde size geri dönüş sağlayacağız.");
        Header("Location:menu-kariyer-20.php?type=1&message=$msg");

    }

    if(@$_POST['mail_type'] == "iletisim"){

        $get_eposta_ayar = getEpostaAyar("iletisim_eposta",$db);
        $cozbaba = explode(",",$get_eposta_ayar);

        foreach ($cozbaba as $coz){
            $mail->addAddress($coz);
        }

        $mail->Subject = __c("İLETİŞİM İSTEĞİ");

        $bodyContent = "";

        $bodyContent .= '<b>'.__c("Ad Soyad").' : </b>'.'&nbsp;'.$_POST['name'].'<br>';
        $bodyContent .= '<b>'.__c("E-Posta").' : </b>'.'&nbsp;'.$_POST['email'].'<br>';
        $bodyContent .= '<b>'.__c("Telefon").' : </b>'.'&nbsp;'.$_POST['phone'].'<br>';
        $bodyContent .= '<b>'.__c("Mesaj").' : </b>'.'&nbsp;'.$_POST['message'].'<br>';

        $mail->Body = $bodyContent;

        $mail->send();

        $msg = __c("Talebiniz başarıyla alındı ! En kısa süre içerisinde size geri dönüş sağlayacağız.");
        Header("Location:iletisim.php?type=1&message=$msg");

    }

    // DEĞİŞKEN

} catch (Exception $e) {
    if(@$_POST['mail_type'] == "teklif"){
        Header("Location:teklif.php?type=0&message={$mail->ErrorInfo}");
    }
    if(@$_POST['mail_type'] == "kariyer"){
        Header("Location:menu-kariyer-20.php?type=0&message={$mail->ErrorInfo}");
    }
    if(@$_POST['mail_type'] == "iletisim"){
        Header("Location:iletisim.php?type=0&message={$mail->ErrorInfo}");
    }
}