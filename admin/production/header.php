<?php
session_start();
if(!isset($_SESSION['user_ad'])){
  header('Location:login.php');
}
include '../baglan/baglan.php';
$user = $db->prepare("SELECT * FROM kullanici WHERE kullanici_id=?");
$user->execute(array($_SESSION["kullanici_id"]));
if($user->rowCount() > 0){
  $getUser = $user->fetch(PDO::FETCH_ASSOC);
  
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">  
  <title><?=__c("Yönetim Paneli")?></title>
  <!-- Bootstrap -->
  <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <!-- NProgress -->
  <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
  <!-- iCheck -->
  <link href="../vendors/iCheck/skins/flat/green.css" rel="stylesheet">
  <!-- bootstrap-progressbar -->
  <link href="../vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
  <!-- JQVMap -->
  <link href="../vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
  <!-- bootstrap-daterangepicker -->
  <link href="../vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
  <!-- Custom Theme Style -->
  <link href="../build/css/custom.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.11.5/b-2.2.2/datatables.min.css"/>
    <script src="https://cdn.ckeditor.com/4.7.1/standard/ckeditor.js"></script>


  <link href="../vendors/dropzone/dist/dropzone.css" rel="stylesheet">
  <script src="../vendors/dropzone/dist/dropzone.js"></script>
  
</head>
<body class="nav-md">
  <div class="container body">
    <div class="main_container">
      <div class="col-md-3 left_col">
        <div class="left_col scroll-view">
          <div class="navbar nav_title" style="border: 0;">
            <a href="index.php" class="site_title"><i class="fa fa-cogs"></i> <span><?=__c("Yönetim Paneli")?></span></a>
          </div>
          <div class="clearfix"></div>
          <!-- menu profile quick info -->
          <div class="profile clearfix">
            <div class="profile_pic">             
            </div>
            <div class="profile_info">
              <span><?=__c("Hoşgeldiniz")?>,</span>
              <h2><?php echo $getUser['kullanici_ad'] ?></h2>
            </div>
          </div>
          <!-- /menu profile quick info -->
          <br />