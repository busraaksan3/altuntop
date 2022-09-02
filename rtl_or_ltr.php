<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$result = "ltr";

if(@$_GET['value']){
    $result = $_GET['value'];
    $_SESSION['DRCT'] = $result;
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}
