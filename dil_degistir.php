<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if(@$_GET['lang']){
    $_SESSION['LANG'] = $_GET['lang'];

    if($_GET['lang'] == "ar_AR"){
        $_SESSION['DRCT'] = "rtl";
    }else{
        $_SESSION['DRCT'] = "ltr";
    }

    header('Location: ' . $_SERVER['HTTP_REFERER']);

}
