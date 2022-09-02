<?php
 include("../baglan/baglan.php");
session_start();
if(isset($_SESSION['user_ad'])){
  header('Location:index.php');
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
  <link href="https://fonts.googleapis.com/css?family=Abel|Titillium+Web&display=swap&subset=latin-ext" rel="stylesheet">
  <title><?=__c("Kullanıcı Giriş")?> | <?=__c("Altuntop Makine")?></title>
  <!-- Bootstrap -->
  <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <!-- NProgress -->
  <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
  <!-- Animate.css -->
  <link href="../vendors/animate.css/animate.min.css" rel="stylesheet">
  <!-- Custom Theme Style -->
  <link href="../build/css/custom.min.css" rel="stylesheet">  
  <style>    
    body{
      font-family: 'Titillium Web', sans-serif;
    }    
    </style>
</head>
<body class="login">
  <div>
    <a class="hiddenanchor" id="signup"></a>
    <a class="hiddenanchor" id="signin"></a>

    <div class="login_wrapper">
      <div class="animate form login_form">
        <section class="login_content"> 
          <form action="../baglan/islem.php" method="post"> 
            <a href="../../index.php"><img src="../../assets\resim\logo.png" style="width: 200px; "></a> <br>
            <h1><a href="../../index.php"><?=__c("Anasayfaya Dön")?></a></h1>
            <h1><?=__c("Kullanıcı Giriş")?></h1>
            <div>
              <input type="text" name="admin_ad" class="form-control" placeholder="<?=__c("Kullanıcı Adı")?>" required="" />
            </div>
            <div>
              <input type="password" name="admin_password" class="form-control" placeholder="<?=__c("Parola")?>" required="" />
            </div>
            <div>
              <button type="submit" style="background-color:#3b79ae;" name="userlogin" class="btn btn-success"> <?=__c("Giriş Yap")?>" </button>               
            </div>
            <div class="clearfix"></div>
          </form>
        </section>
      </div>        
    </div>
  </div>
</body>
</html>
