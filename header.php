<?php include("admin/baglan/baglan.php");
include "admin/production/fonksiyon.php";
$ayarsor = $db->prepare("select * from ayar where ayar_id=?");
$ayarsor->execute(array(0));
$ayarcek = $ayarsor->fetch(PDO::FETCH_ASSOC);
$menusor = $db->prepare("SELECT * FROM menu where menu_id=:id");
@$menusor->execute(array("id" => $_GET['menu_id']));
$menucek = $menusor->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="tr">

<!-- Mirrored from azim.commonsupport.com/Fionca/about-1.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 30 Oct 2021 07:45:55 GMT -->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="<?php echo $ayarcek['ayar_description']; ?>" name="description">
    <meta name="keyword" content="<?php echo $ayarcek['ayar_keywords']; ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

    <title><?php echo $ayarcek['ayar_title']; ?> </title>

    <!-- Fav Icon -->
    <link rel="icon" href="assets/resim/favvv.png" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Arimo:400,400i,700,700i&amp;display=swap" rel="stylesheet">

    <!-- Stylesheets -->
    <link href="assets/css/teklif.css" rel="stylesheet">
    <link href="assets/css/font-awesome-all.css" rel="stylesheet">
    <link href="assets/css/flaticon.css" rel="stylesheet">
    <link href="assets/css/owl.css" rel="stylesheet">
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <link href="assets/css/jquery.fancybox.min.css" rel="stylesheet">
    <link href="assets/css/animate.css" rel="stylesheet">
    <link href="assets/css/color.css" rel="stylesheet">
    <link href="assets/css/rtl.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/responsive.css" rel="stylesheet">
    <link href="assets/css/me.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.11.1/baguetteBox.min.css">


</head>


<!-- page wrapper -->

<body class="boxed_wrapper <?= ltr_or_rtl() ?>">

    <!-- Preloader -->
    <div class="loader-wrap">
        <div class="preloader">
            <div class="preloader-close"><?=__c("Animasyon Kapat")?></div>
        </div>
        <div class="layer layer-one"><span class="overlay"></span></div>
        <div class="layer layer-two"><span class="overlay"></span></div>
        <div class="layer layer-three"><span class="overlay"></span></div>
    </div>


    <!-- search-popup -->
    <div id="search-popup" class="search-popup">
        <div class="close-search"><span><?= __c("Kapat") ?></span></div>
        <div class="popup-inner">
            <div class="overlay-layer"></div>
            <div class="search-form">
                <form method="post" action="arama.php">
                    <div class="form-group">
                        <fieldset>
                            <input type="search" class="form-control" name="aranan" value="" placeholder="<?= __c("Arama") ?>" required>
                            <input type="submit" value="<?= __c("Ara!") ?>" name="arama" class="theme-btn style-four">
                        </fieldset>
                    </div>
                </form>
                <h3><?= __C("Son Arama Anahtar Kelimeleri") ?></h3>
                <ul class="recent-searches">
                    <li><a href="javascript:"><?= __c("Fırın") ?></a></li>
                    <li><a href="javascript:"><?= __c("Makine") ?></a></li>
                    <li><a href="javascript:"><?= __c("Hamur Makinesi") ?></a></li>
                    <li><a href="javascript:"><?= __c("Karıştırıcı") ?></a></li>
                    <li><a href="javascript:"><?= __c("Ürünler") ?></a></li>
                </ul>
            </div>
        </div>
    </div>
    <!-- search-popup end -->



    <!-- main header -->
    <header class="main-header style-one style-six">
        <div class="header-top">
        <div class="auto-container">
                <div class="top-inner clearfix">
                    <ul class="info top-left pull-left">
                        <li><i class="fas fa-map-marker-alt"></i><?php echo __c($ayarcek['ayar_adres']); ?> <?php echo __c($ayarcek['ayar_ilce']); ?> / <?php echo __c($ayarcek['ayar_il']); ?></li>
                        <li><i class="fas fa-headphones"></i><?=__c("Destek")?> <a href="tel:<?php echo __c($ayarcek['ayar_tel']); ?>"><?php echo $ayarcek['ayar_tel']; ?></a></li>
                        
                       
                    </ul>
                    <div class="top-right pull-right">
                        <ul class="social-links clearfix">

                            </li>
                            <li><a href="<?php echo $ayarcek['ayar_facebook']; ?>"><i class="fab fa-facebook-f"></i></a></li>
                            <li><a href="<?php echo $ayarcek['ayar_twitter']; ?>"><i class="fab fa-twitter"></i></a></li>
                            <li><a href="<?php echo $ayarcek['ayar_instagram']; ?>"><i class="fab fa-instagram"></i></a></li>
                            <li><a href="<?php echo $ayarcek['ayar_youtube']; ?>"><i class="fab fa-youtube"></i></a></li>
                            <li class="dropdown dropdown-toggle" data-toggle="dropdown"><a href=""><i class="fa fa-globe"></i></a></li>
                            <div class="dropdown-menu ">
                                <ul >
                                    <?php $diller = $db->query("SELECT * FROM diller where durum='aktif' order by sira")->fetchAll();
                                    foreach ($diller as $dil) { ?>

                                        <li style=" display:flex; flex-direction: column;" class="p-2"><a href="dil_degistir.php?lang=<?=$dil['lang_code']?>" style="color: black;"> <img src="<?= $dil['lang_icon'] ?>" style="width: 22px !important;"> <?= __c($dil['lang_name']) ?></a></li>

                                    <?php } ?>
                                </ul>
                            </div>
                        </ul>
                    </div>
                </div>
            </div>
            </div>
        </div>
        <div class="header-lower">
            <div class="auto-container">
                <div class="outer-box clearfix">
                    <div class="logo-box pull-left">
                        <figure class="logo"><a href="index"><img src="assets/resim/logo.png" class="me-logo" alt=""></a></figure>
                    </div>
                    <div class="menu-area pull-right">
                        <!--Mobile Navigation Toggler-->
                        <div class="mobile-nav-toggler">
                            <i class="icon-bar"></i>
                            <i class="icon-bar"></i>
                            <i class="icon-bar"></i>
                        </div>
                        <nav class="main-menu navbar-expand-md navbar-light">
                            <div class="collapse navbar-collapse show clearfix" id="navbarSupportedContent">
                                <ul class="navigation clearfix">
                                <li><a href="index"><?=__c("Anasayfa")?></a></li>
                                    <?php
                                    $menusor = $db->prepare("SELECT * FROM menu order by menu_sira");
                                    $menusor->execute();
                                    while ($menucek = $menusor->fetch(PDO::FETCH_ASSOC)) { ?>
                                        <?php if ($menucek['menu_url'] === "kurumsal") : ?>
                                            <li class="dropdown"><a href=""><?= __c("Kurumsal") ?></a>
                                                <ul>

                                                    <?php $altmenusor = $db->prepare("SELECT * FROM altmenu order by altmenu_id ASC");
                                                    $altmenusor->execute();
                                                    foreach ($altmenusor as $altmenucek) :
                                                    ?>
                                                        <li><a href="altmenu-<?= $altmenucek['altmenu_url'] . '-' . $altmenucek['altmenu_id'] ?>"><?= __c($altmenucek['altmenu_ad'] )?></a></li>

                                                    <?php endforeach; ?>
                                                    <li><a href="iletisim"><?=__c("İletişim")?></a></li>
                                                </ul>
                                            </li>
                                        <?php else : ?>
                                            <li><a href="menu-<?= $menucek["menu_url"] . '-' . $menucek["menu_id"] ?>"><?php echo  __c($menucek['menu_ad']) ?></a></li>
                                        <?php endif ?>
                                    <?php } ?>
                                </ul>
                            </div>
                        </nav>
                        <div class="menu-right-content clearfix">
                            <div class="search-btn">
                                <button type="button" class="search-toggler"><i class="flaticon-search-1"></i></button>
                            </div>
                            <div class="nav-btn nav-toggler navSidebar-button clearfix">
                                <i class="fas fa-align-right"></i>
                            </div>
                            <div class="btn-box">
                                <a href="teklif.php" class="theme-btn style-one"><?=__c("Teklif Al")?></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--sticky Header-->
            <div class="sticky-header">
                <div class="auto-container">
                    <div class="outer-box clearfix">
                        <div class="logo-box pull-left">
                            <figure class="logo"><a href="index"><img src="assets/resim/logo.png" style="width: 212px;" alt=""></a></figure>
                        </div>
                        <div class="menu-area pull-right">
                            <nav class="main-menu clearfix">
                                <!--Keep This Empty / Menu will come through Javascript-->
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
    </header>
    <!-- main-header end -->

    <!-- Mobile Menu  -->
    <div class="mobile-menu">
        <div class="menu-backdrop"></div>
        <div class="close-btn"><i class="fas fa-times"></i></div>

        <nav class="menu-box">
            <div class="nav-logo"><a href="javascript:"><img src="assets/resim/logo.png" alt="" title=""></a></div>
            <div class="menu-outer">
                <!--Here Menu Will Come Automatically Via Javascript / Same Menu as in Header-->
            </div>
            <div class="contact-info">
            <h4><?=__c("İletişim Bilgileri")?></h4>
                <ul>
                    <li><?php echo __c($ayarcek['ayar_adres']); ?> <?php echo __c($ayarcek['ayar_ilce']); ?> / <?php echo __c($ayarcek['ayar_il']); ?></li>
                    <li><a href="tel:+90(422) 237 56 08">+90(422) 237 56 08</a></li>
                    <li><a href="mailto:info@altuntop.com">info@altuntop.com</a></li>
                </ul>
            </div>
            <div class="social-links">
                <ul class="clearfix">
                    <li><a href="<?php echo $ayarcek['ayar_facebook']; ?>"><span class="fab fa-facebook-f"></span></a></li>
                    <li><a href="<?php echo $ayarcek['ayar_twitter']; ?>"><span class="fab fa-twitter"></span></a></li>
                    <li><a href="<?php echo $ayarcek['ayar_instagram']; ?>"><span class="fab fa-instagram"></span></a></li>
                    <li><a href="<?php echo $ayarcek['ayar_youtube']; ?>"><span class="fab fa-youtube"></span></a></li>
                </ul>
            </div>
        </nav>
    </div><!-- End Mobile Menu -->