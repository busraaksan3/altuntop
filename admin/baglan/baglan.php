<?php

try {
    $db = new PDO("mysql:host=localhost;dbname=altuntop;charset=utf8", "root", "");
    
} catch ( PDOException $e ){
     print $e->getMessage();
}

$sorgu = $db->prepare("SELECT * FROM options WHERE id = 1");
$sorgu->execute(array());
$options = $sorgu->fetch(PDO::FETCH_ASSOC);

$logDeleteLimit = $options["log_delete_limit"];

function getEpostaAyar($column_name,$db){
    $sorgu = $db->prepare("SELECT * FROM eposta_ayar WHERE id = 1");
    $sorgu->execute(array());
    $get = $sorgu->fetch(PDO::FETCH_ASSOC);

    return $get[$column_name];
}

function getCountryNameForID($ulke_id,$db){

    $sorgu = $db->prepare("SELECT * FROM ulkeler WHERE ulke_id =".$ulke_id);
    $sorgu->execute(array());
    $get = $sorgu->fetch(PDO::FETCH_ASSOC);

    return $get["name"];

}

function getWebCustomContent($column_name,$db){

    $sorgu = $db->prepare("SELECT * FROM webcustomcontent WHERE id = 1");
    $sorgu->execute(array());
    $get = $sorgu->fetch(PDO::FETCH_ASSOC);

    return $get[$column_name];

}

function ltr_or_rtl(){

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    $result = "ltr";

    if(@$_SESSION['DRCT']){
        $result = $_SESSION['DRCT'];
    }

    return $result;

}

# ÇEVİRİ FONKSİYONU BAŞLAR
function __c($str,$lang = "tr_TR"){

    # DB BAĞLANTISI
    try {
        $db = new PDO("mysql:host=localhost;dbname=altuntop;charset=utf8", "root", "");

    } catch ( PDOException $e ){
        print $e->getMessage();
    }


    # CURRENT DİLİ GETİRME
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    $currentLanguageCode = "tr_TR";
    if(@$_SESSION['LANG']){
        $currentLanguageCode = $_SESSION['LANG'];
    }

    $findCurrentLanguage = $db->query("SELECT * FROM diller WHERE lang_code = '{$currentLanguageCode}'")->fetch(PDO::FETCH_ASSOC);

    $checkKey = $db->query("SELECT * FROM ceviriler WHERE lang_code = '{$lang}' AND string_key ='".$str."'")->fetch(PDO::FETCH_ASSOC);
    $ceviri_id = 0;
    if($checkKey){
        //var
        $CeviriID = $checkKey['ceviri_id'];
        $ceviri_id = $CeviriID;
        $getAllLanguage = $db->query("SELECT * FROM diller")->fetchAll();
        foreach ($getAllLanguage as $language){

            $checkTranslate = $db->query("SELECT * FROM translates WHERE ceviri_id = '{$CeviriID}' AND lang_id = '{$language['id']}'")->fetch(PDO::FETCH_ASSOC);

            if(!$checkTranslate){

                if($language['lang_code'] == $lang){

                    $saveTranslate = $db->prepare("INSERT INTO translates SET
                ceviri_id=:ceviri_id,
                lang_id=:lang_id,
                translate=:translate
                ");
                    $createTranslate = $saveTranslate->execute(array(
                        'ceviri_id' => $CeviriID,
                        'lang_id' => $language['id'],
                        'translate' => $str
                    ));

                }else{

                    $saveTranslate = $db->prepare("INSERT INTO translates SET
                ceviri_id=:ceviri_id,
                lang_id=:lang_id,
                translate=:translate
                ");
                    $createTranslate = $saveTranslate->execute(array(
                        'ceviri_id' => $CeviriID,
                        'lang_id' => $language['id'],
                        'translate' => null
                    ));

                }

            }
        }

    }else{
        //yok

        $saveKey = $db->prepare("INSERT INTO ceviriler SET
        lang_code=:lang_code,
        string_key=:string_key	
        ");
        $createKey = $saveKey->execute(array(
            'lang_code' => $lang,
            'string_key' => $str
        ));

        $CeviriID = $db->lastInsertId();
        $ceviri_id = $CeviriID;

        $getAllLanguage = $db->query("SELECT * FROM diller")->fetchAll();
        foreach ($getAllLanguage as $language){
            if($language['lang_code'] == $lang){

                $saveTranslate = $db->prepare("INSERT INTO translates SET
                ceviri_id=:ceviri_id,
                lang_id=:lang_id,
                translate=:translate
                ");
                $createTranslate = $saveTranslate->execute(array(
                    'ceviri_id' => $CeviriID,
                    'lang_id' => $language['id'],
                    'translate' => $str
                ));

            }else{

                $saveTranslate = $db->prepare("INSERT INTO translates SET
                ceviri_id=:ceviri_id,
                lang_id=:lang_id,
                translate=:translate
                ");
                $createTranslate = $saveTranslate->execute(array(
                    'ceviri_id' => $CeviriID,
                    'lang_id' => $language['id'],
                    'translate' => null
                ));

            }
        }

    }

   $getTranslate = $db->query("SELECT * FROM translates WHERE ceviri_id = '{$ceviri_id}' AND lang_id = '{$findCurrentLanguage['id']}'")->fetch(PDO::FETCH_ASSOC);

    return $getTranslate['translate'];

}

function showAlert($type,$message){

    if($type == 0){

        $msg = '    <div class="alert alert-danger" role="alert">
         '.$message.'
        </div>';

        return $msg;

    }else if($type == 1){
        $msg = '    <div class="alert alert-success" role="alert">
         '.$message.'
        </div>';

        return $msg;
    }else{
        $msg = '    <div class="alert alert-primary" role="alert">
         '.$message.'
        </div>';

        return $msg;
    }

}

function getCountCountryForUserForMail($db,$ulke_id){

    $checkuser = $db->query("SELECT * FROM ulke_to_user WHERE ulke_id = '{$ulke_id}'")->fetchAll();
    return $checkuser;

}

function getCountCountryForUser($db,$ulke_id){

    $checkuser = $db->query("SELECT * FROM ulke_to_user WHERE ulke_id = '{$ulke_id}'")->fetchAll();
    return count($checkuser);

}

function getUser($db,$user_id){

    $checkuser = $db->query("SELECT * FROM kullanici WHERE kullanici_id = '{$user_id}'")->fetch(PDO::FETCH_ASSOC);
    if($checkuser){
        return $checkuser;
    }

}


?>