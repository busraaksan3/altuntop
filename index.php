<?php include("admin/baglan/baglan.php");
include "admin/production/fonksiyon.php";
$ayarsor = $db->prepare("select * from ayar where ayar_id=?");
$ayarsor->execute(array(0));
$ayarcek = $ayarsor->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

    <title>ALTUNTOP - Bakery Equipment | Fırın Makinaları</title>

    <!-- Fav Icon -->
    <link rel="icon" href="assets/resim/favvv.png" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Arimo:400,400i,700,700i&amp;display=swap" rel="stylesheet">

    <!-- Stylesheets -->
    <link href="assets/css/font-awesome-all.css" rel="stylesheet">
    <link href="assets/css/flaticon.css" rel="stylesheet">
    <link href="assets/css/owl.css" rel="stylesheet">
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <script src="assets/js/jquery.js"></script>
    <link href="assets/css/jquery.fancybox.min.css" rel="stylesheet">
    <link href="assets/css/animate.css" rel="stylesheet">
    <link href="assets/css/color.css" rel="stylesheet">
    <link href="assets/css/rtl.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/responsive.css" rel="stylesheet">
    <link href="assets/css/me.css" rel="stylesheet">
</head>


<!-- page wrapper -->

<body class="boxed_wrapper <?= ltr_or_rtl() ?>">

    <!-- Preloader -->
    <div class="loader-wrap">
        <div class="preloader">
            <div class="preloader-close"><?= __c("Animasyon Kapat") ?></div>
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
                <h3><?= __c("Son Arama Anahtar Kelimeleri") ?></h3>
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
    <header class="main-header style-one">
        <div class="header-top">
            <div class="auto-container">
                <div class="top-inner clearfix">
                    <ul class="info top-left pull-left">
                        <li><i class="fas fa-map-marker-alt"></i><?php echo __c($ayarcek['ayar_adres']);?> <?php echo __c($ayarcek['ayar_ilce']); ?> / <?php echo __c($ayarcek['ayar_il']); ?></li>
                        <li><i class="fas fa-headphones"></i><?= __c("Destek") ?> <a href="tel:<?php echo __c($ayarcek['ayar_tel']); ?>"><?php echo $ayarcek['ayar_tel']; ?></a></li>


                    </ul>
                    <div class="top-right pull-right">
                        <ul class="social-links clearfix">

                            </li>
                            <li><a href="<?php echo $ayarcek['ayar_facebook']; ?>"><i class="fab fa-facebook-f"></i></a></li>
                            <li><a href="<?php echo $ayarcek['ayar_twitter']; ?>"><i class="fab fa-twitter"></i></a></li>
                            <li><a href="<?php echo $ayarcek['ayar_instagram']; ?>"><i class="fab fa-instagram"></i></a></li>
                            <li><a href="<?php echo $ayarcek['ayar_youtube']; ?>"><i class="fab fa-youtube"></i></a></li>
                            <li class="dropdown dropdown-toggle" data-toggle="dropdown"><a href=""><i class="fa fa-globe"></i></a></li>
                            <div class="dropdown-menu">
                                <ul>
                                    <?php $diller = $db->query("SELECT * FROM diller where durum='aktif' order by sira")->fetchAll();
                                    foreach ($diller as $dil) { ?>

                                        <li style=" display:flex; flex-direction: column;" class="p-2"><a href="dil_degistir.php?lang=<?= $dil['lang_code'] ?>" style="color: black;"> <img src="<?= $dil['lang_icon'] ?>" style="width: 22px !important;"> <?= __c($dil['lang_name']) ?></a></li>

                                    <?php } ?>
                                </ul>
                            </div>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-lower">
            <div class="auto-container">
                <div class="outer-box clearfix">
                    <div class="logo-box pull-left">
                        <figure class="logo"><a href="javascript:"><img src="assets/resim/logo.png" class="me-logo" alt=""></a></figure>
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
                                    <li><a href="index"><?= __c("Anasayfa") ?></a></li>
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
                                                        <li><a href="altmenu-<?= $altmenucek['altmenu_url'] . '-' . $altmenucek['altmenu_id'] ?>"><?= __c($altmenucek['altmenu_ad']) ?></a></li>

                                                    <?php endforeach; ?>
                                                    <li><a href="iletisim"><?= __c("İletişim") ?></a></li>
                                                </ul>
                                            </li>
                                        <?php else : ?>
                                            <li><a href="menu-<?= $menucek["menu_url"] . '-' . $menucek["menu_id"] ?>"><?php echo __c($menucek['menu_ad']) ?></a></li>
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
                                <a href="teklif.php" class="theme-btn style-one"><?= __c("Teklif Al") ?></a>
                            </div>

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
                        <figure class="logo"><a href="javascript:"><img src="assets/resim/logo.png" class="me-fixed-logo" alt=""></a></figure>
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
                <h4><?= __c("İletişim Bilgileri") ?></h4>
                <ul>
                    <li><?php echo __c($ayarcek['ayar_adres']); ?> <?php echo __c($ayarcek['ayar_ilce']); ?> / <?php echo __c($ayarcek['ayar_il']); ?></li>
                    <li><a href="tel:+90(422) 237 56 08">+90(422) 237 56 08</a></li>
                    <li><a href="mailto:info@altuntop.com">info@altuntop.com</a></li>
                </ul>
            </div>
            <div class="social-links">
                <ul class="clearfix">
                    <li><a href="javascript:"><span class="fab fa-facebook-f"></span></a></li>
                    <li><a href="javascript:"><span class="fab fa-twitter"></span></a></li>
                    <li><a href="javascript:"><span class="fab fa-instagram"></span></a></li>
                    <li><a href="javascript:"><span class="fab fa-youtube"></span></a></li>
                </ul>
            </div>
        </nav>
    </div><!-- End Mobile Menu -->


    <!-- banner-section -->
    <section class="banner-section">
        <div class="banner-carousel owl-theme owl-carousel owl-dots-none">
            <?php $slidersor = $db->prepare("SELECT * FROM slider order by slider_sira ASC");
            $slidersor->execute();
            while ($slidercek = $slidersor->fetch(PDO::FETCH_ASSOC)) { ?>
                <!-- start slider -->
                <div class="slide-item">
                    <div class="image-layer" style="background-image:url(<?= $slidercek['slider_resimyol']; ?>)"></div>
                    <div class="auto-container">
                        <div class="content-box">
                            <center>
                                <h5><?= __c($slidercek['slider_p']); ?></h5>
                            </center>
                            <center>
                                <h1><?= __c($slidercek['slider_h']); ?></h1>
                            </center>
                            <?php if ($slidercek['slider_buton'] == true) : ?>
                                <div class="btn-box">
                                    <center><a href="iletisim" class="theme-btn style-one"><?= __c("Nasıl yardımcı olabiliriz") ?></a>
                                        <a href="iletisim" class="user-btn"><i class="far fa-user"></i><span><?= __c("Bize Ulaşın") ?></span></a>
                                    </center>
                                </div><?php endif; ?>
                        </div>
                    </div>
                </div> <?php } ?>
            <!-- end slider -->
        </div>
    </section>
    <!-- banner-section end -->


    <!-- info-section -->
    <section class="info-section">
        <div class="auto-container">
            <div class="row clearfix">
                <div class="col-lg-7 col-md-12 col-sm-12 title-column">
                    <div class="title-inner">
                        <div class="year-box">
                            <figure class="image-box"><img src="assets/images/icons/year-icon.png" alt=""></figure>
                            <h2 style="font-size: 45px;">30<?= __c("YIL") ?></h2>
                            <h4><?= __c("TECRÜBE") ?></h4>
                        </div>
                        <div class="title">
                            <h2><?= __c("Yılların Mücadelesi") ?><span> — </span><?= __c("Kaliteli İşlerle Daha İyi Strateji") ?></h2>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 col-md-12 col-sm-12 text-column">
                    <div class="text">
                        <p>
                            <?=__c("Altuntop Fırın Makinaları firmamız Türkiye nin önde gelen fırın makinaları üreticilerinden
                            biridir . Dünyanın her yerinde farklı pazarlara hizmet vermek için şirketimizin önceliği
                            teknoloji ve kalitedir.")?>
                        </p>
                        <a href="altmenu-hakkimizda-4" style="margin-right: 20px;">
                            <i class="fas fa-university" style="font-size: 20px;"></i>
                            <span><?= __c("Biz Kimiz") ?></span>
                        </a>
                        <a href="https://www.youtube.com/watch?v=FcUxrdBvuGs" class="lightbox-image">
                            <i class="fas fa-play-circle" style="font-size: 20px;"></i>
                            <span><?= __c("Tanıtım Videosu") ?></span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- info-section end -->


    <!-- feature-section -->
    <section class="feature-section">
        <div class="auto-container">
            <div class="row clearfix">

                <?php $kategorisor = $db->prepare("SELECT * FROM kategori order by kategori_id ASC limit 3");
                $kategorisor->execute();
                while ($kategoricek = $kategorisor->fetch(PDO::FETCH_ASSOC)) { ?>
                    <div class="col-lg-4 col-md-6 col-sm-12 feature-block">
                        <div class="feature-block-one wow fadeInUp animated animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                            <div class="inner-box">
                                <figure class="image-box"> <a href="kategori-<?= $kategoricek['kategori_seourl'] . '-' . $kategoricek["kategori_id"] ?>"><img src="<?php echo $kategoricek['kategori_resim'] ?>" alt=""></a></figure>
                                <div class="lower-content">
                                    <div class="inner">
                                        <h3><?php echo __c($kategoricek['kategori_ad']) ?></h3>
                                        <a href="kategori-<?= $kategoricek['kategori_seourl'] . '-' . $kategoricek["kategori_id"] ?>"><span><?= __c("Daha Fazla") ?></span><i class="fas fa-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><?php } ?>
            </div>
        </div>
    </section>
    <!-- feature-section end -->


    <!-- about-section -->
    <section class="about-section bg-color-1">
        <div class="auto-container">
            <div class="row clearfix">
                <div class="col-lg-6 col-md-12 col-sm-12 video-column">
                    <div class="video-inner">
                        <figure class="image-box"><img src="assets/resim/hak-resim.jpg" alt=""></figure>
                        <div class="video-btn">
                            <a href="<?php echo $ayarcek['ayar_video'] ?>" class="lightbox-image" data-caption="" style="background-image: url(assets/resim/hak-resim.jpg); background-position: center;">
                                <i class="fas fa-play"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12 content-column">
                    <div id="content_block_one">
                        <div class="content-box" style="margin-top: 50px;">
                            <div class="sec-title left">
                                <h5><?= __c("Bizi Tanıyın") ?></h5>
                                <h2><?= __c("Altuntop - Fırın Makinaları") ?></h2>
                            </div>
                            <div class="text">
                                <p>
                                    <?= __c("Yılların Tecrübesi Ve Ekibimizin Profesyonel Duruşu İle Yanınızdayız.") ?>
                                </p>
                            </div>
                            <div class="inner-box">
                                <div class="single-item">
                                    <div class="icon-box">
                                        <span class="bg-box"></span>
                                        <i class="flaticon-laptop"></i>
                                    </div>
                                    <h4><a href="<?php echo $ayarcek['ayar_video'] ?>"><?= __c("Kurumsal Video Tanıtım") ?></a></h4>
                                    <p style="margin-bottom: 15px;"><?= __c("Tanıtım videomuzu izleyerek bizim ve ürünlerimiz hakkında daha fazla şey öğrenebilirsiniz.") ?> </p>
                                    <a href="<?php echo $ayarcek['ayar_video'] ?>" class="lightbox-image" style="margin-right: 20px; margin-top: 5px; color: #009fe3;">
                                        <i class="fas fa-play" style="font-size: 20px;"></i>
                                        <span><?= __c("Hemen İzle") ?></span>
                                    </a>
                                </div>
                                <div class="single-item">
                                    <div class="icon-box">
                                        <span class="bg-box"></span>
                                        <i class="flaticon-folder"></i>
                                    </div>
                                    <h4><a href="menu-e-katalog-23"><?= __c("E-Katalog") ?></a></h4>
                                    <p style="margin-bottom: 15px;"><?= __c("Aradığınız her şeye e-kataloğumuzdan ulalşabilirsiniz.") ?></p>
                                    <a href="menu-e-katalog-23" style="margin-right: 20px; color: #009fe3;">
                                        <i class="fas fa-book" style="font-size: 20px;"></i>
                                        <span><?= __c("Hemen İncele") ?></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- about-section end -->

    <!-- annual-stats -->
    <section class="annual-stats">
        <div class="auto-container">
            <div class="row clearfix">
                <div class="col-lg-6 col-md-12 col-sm-12 content-column">
                    <div id="content_block_two">
                        <div class="content-box">
                            <div class="sec-title left">
                                <h5><?= __c("Altuntop - Fırın Makinaları") ?></h5>
                                <h2><?= __c("Gözle Görülür Farklar Yaratıyoruz") ?></h2>
                            </div>
                            <div class="text">
                                <p>
                                    <?= __c("Sürekli olarak müşterilerin ihtiyaçlarını karşılamak için çalışmakta, teknolojik
                                    düşünce ve inovasyon kuralları dahil olmak üzere çalışmaktadır ve müşterilerimize
                                    her türlü fırsat ve hizmeti sunmaktadır.") ?>

                                </p>
                            </div>
                            <div class="inner-box clearfix">
                                <div class="single-progress-box">
                                    <div class="box">
                                        <div class="piechart" data-fg-color="#204669" data-value=".95">
                                            <span>.95</span>
                                        </div>
                                        <h5><?= __c("Her ihtiyaca uygun çözümler.") ?></h5>
                                        <h3><?= __c("Küresel Esneklik") ?></h3>
                                    </div>
                                </div>
                                <div class="single-progress-box">
                                    <div class="box">
                                        <div class="piechart" data-fg-color="#009fe3" data-value=".85">
                                            <span>.85</span>
                                        </div>
                                        <h5><?= __c("Kurumsal destek hizmetleri") ?></h5>
                                        <h3><?= __c("Kesin Sonuçlar") ?></h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12 image-column">
                    <div id="image_block_one">
                        <div class="image-box">
                            <div class="pattern-layer" style="background-image: url(assets/images/shape/shape-1.png);"></div>
                            <figure class="image"><img src="assets/resim/kalite.jpg" alt=""></figure>
                            <div class="award-box">
                                <div class="box">
                                    <figure class="icon-box"><img src="assets/images/icons/icon-1.png" alt=""></figure>
                                    <span><?= __c("2019 - 2020 Üretkenlik Ödülü") ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- annual-stats end -->


    <!-- world-cyber -->
    <section class="world-cyber bg-color-1">
        <div class="pattern-layer" style="background-image: url(assets/images/shape/shape-2.png);"></div>
        <div class="auto-container">
            <div class="sec-title centred">
                <h5><?= __c("Dünyanın Her Yerindeyiz") ?></h5>
                <h2><?= __c("92 noktadan Dünyanın her yerine hizmet sağlıyoruz") ?></h2>
            </div>
            <div class="office-location">
                <div class="location-area">
                    <div class="location-box">
                        <div class="address-box">
                            <figure class="icon-box"></figure>
                            <p><img src="assets\resim\logo.png" alt=""></p>
                        </div>
                    </div>
                    <div class="location-box">
                        <div class="address-box">
                            <figure class="icon-box"></figure>
                            <p><img src="assets\resim\logo.png" alt=""></p>
                        </div>
                    </div>
                    <div class="location-box">
                        <div class="address-box">
                            <figure class="icon-box"></figure>
                            <p><img src="assets\resim\logo.png" alt=""></p>
                        </div>
                    </div>
                    <div class="location-box">
                        <div class="address-box">
                            <figure class="icon-box"></figure>
                            <p><img src="assets\resim\logo.png" alt=""></p>
                        </div>
                    </div>
                    <div class="location-box">
                        <div class="address-box">
                            <figure class="icon-box"></figure>
                            <p><img src="assets\resim\logo.png" alt=""></p>
                        </div>
                    </div>
                    <div class="location-box">
                        <div class="address-box">
                            <figure class="icon-box"></figure>
                            <p><img src="assets\resim\logo.png" alt=""></p>
                        </div>
                    </div>
                    <div class="location-box">
                        <div class="address-box">
                            <figure class="icon-box"></figure>
                            <p><img src="assets\resim\logo.png" alt=""></p>
                        </div>
                    </div>
                    <div class="location-box">
                        <div class="address-box">
                            <figure class="icon-box"></figure>
                            <p><img src="assets\resim\logo.png" alt=""></p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- world-cyber end -->


    <!-- support-section -->
    <section class="support-section">
        <div class="auto-container">
            <div class="inner-container">
                <div class="row clearfix">
                    <div class="col-lg-7 col-md-12 col-sm-12 inner-column">
                        <div class="inner-box">
                            <div class="sec-title light left">
                                <h5><?= __c("Bize Ulaşın") ?></h5>
                                <h2><?= __c("Bize bir mesaj gönderin") ?></h2>
                                <p>
                                    <?= __c("Size yardımcı olabilmek için profesyonel ekibimiz ve tüm iletişim seçeneklerimiz ile
                                    7/24 hazır şekilde beklemekteyiz. Her hangi bir sorun oluştuğunda veya bilgi almak
                                    istediğinizde bizimle iletişime geçmekten çekinmeyin.") ?>
                                </p>
                            </div>
                            <form action="javascript:" method="post" class="submit-form">
                                <div class="form-group">
                                    <input type="text" name="name" placeholder="<?= __c("İsim") ?>" required="">
                                </div>
                                <div class="form-group">
                                    <input type="email" name="email" placeholder="<?= __c("E-posta") ?>" required="">
                                </div>
                                <div class="form-group">
                                    <input type="text" name="phone" placeholder="<?= __c("Telefon") ?>" required="">
                                </div>
                                <div class="form-group">
                                    <textarea name="message" placeholder="<?= __c("Mesajınız") ?>"></textarea>
                                </div>
                                <div class="form-group message-btn">
                                    <button type="submit" class="theme-btn style-one"><?= __c("Gönder") ?></button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-5 col-md-12 col-sm-12 info-column">
                        <div class="info-inner">
                            <figure class="image-box"><img src="assets/resim/form-resim.jpg" alt=""></figure>
                            <div class="info-box">
                                <figure class="info-logo"><img src="assets/images/icons/info-logo.png" alt=""></figure>
                                <div class="icon-box"><i class="fas fa-phone"></i></div>
                                <h2><a href="tel:+90(422) 237 56 08">+90(422) 237 56 08</a></h2>
                                <div class="email"><a href="mailto:info@altuntop.com" style="margin-bottom: 6px">info@altuntop.com</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- support-section end -->


    <!-- testimonial-section -->
    <section class="testimonial-section" style="background-image: url(assets/resim/anasayfa-bg-1.jpg);">
        <div class="auto-container" style="background-color: rgba(255,255,255,0.8); padding: 35px 5px 25px 5px">
            <div class="title-box">
                <div class="row clearfix">
                    <div class="col-lg-6 col-md-12 col-sm-12 title-column">
                        <div class="sec-title right">
                            <h5><?= __c("Yorumlar") ?></h5>
                            <h2><?= __c("Müşteri") ?> <br /><?= __c("Yorumları") ?></h2>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-sm-12 text-column">
                        <div class="text">
                            <p>
                                <?= __c("Hizmet verdiğimiz müşterilerimizin bizim hakkımızdaki yorum ve düşünceleri") ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="testimonial-inner px-5">
                <div class="blog-classic-content">
                    <div class="news-carousel owl-carousel owl-theme owl-dots-none">
                        <?php
                        $yorumsor = $db->prepare("SELECT * FROM musteriyorum order by id ASC");
                        $yorumsor->execute();
                        foreach ($yorumsor as $yorumcek) {  ?>
                            <div class="news-block-three">
                                <div class="inner-box">
                                    <div class="lower-content">
                                        <center>
                                            <p class="px-5"> <?= __c($yorumcek['icerik']) ?></p>
                                        </center>
                                        <center>
                                            <h2><?= $yorumcek['ad_soyad'] ?></h2>
                                            <img src="<?= $yorumcek['foto'] ?>" alt="" style="width: 80px; height: 50px;">
                                        </center>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
    <!-- testimonial-section end -->



    <!-- cta-section -->
    <section class="cta-section">
        <div class="pattern-layer" style="background-image: url(assets/images/shape/shape-3.png);"></div>
        <div class="auto-container">
            <div class="inner-container clearfix">
                <div class="title pull-left">
                    <h2 style="font-size: 22px; margin-top: -15px;">
                        <?= __c("Bir sorun yaşadığınızda veya ürünlerimiz hakkında bilgi <br> almak istediğinizde, çekinmeden bizi arayabilirsiniz.") ?>
                    </h2>
                </div>
                <div class="btn-box pull-right">
                    <a href="iletisim"><?= __c("Bize Ulaşın") ?></a>
                </div>
            </div>
        </div>
    </section>
    <!-- cta-section end -->


    <!-- fun-fact -->
    <section class="fun-fact centred">
        <div class="auto-container">
            <div class="row clearfix">
                <div class="col-lg-3 col-md-6 col-sm-12 counter-column">
                    <div class="counter-block-one wow slideInUp" data-wow-delay="00ms" data-wow-duration="1500ms">
                        <div class="count-outer count-box">
                            <span class="count-text" data-speed="1500" data-stop="4254">0</span>
                        </div>
                        <p><?= __c("Mutlu Müşteri") ?></p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 counter-column">
                    <div class="counter-block-one wow slideInUp" data-wow-delay="00ms" data-wow-duration="1500ms">
                        <div class="count-outer count-box">
                            <span class="count-text" data-speed="1500" data-stop="2930">0</span>
                        </div>
                        <p><?= __c("Siparişler") ?></p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 counter-column">
                    <div class="counter-block-one wow slideInUp" data-wow-delay="00ms" data-wow-duration="1500ms">
                        <div class="count-outer count-box">
                            <span class="count-text" data-speed="1500" data-stop="826">0</span>
                        </div>
                        <p><?= __c("Ürünler") ?></p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 counter-column">
                    <div class="counter-block-one wow slideInUp" data-wow-delay="00ms" data-wow-duration="1500ms">
                        <div class="count-outer count-box">
                            <span class="count-text" data-speed="1500" data-stop="1720">0</span>
                        </div>
                        <p><?= __c("Hizmet") ?></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- fun-fact end -->
    <?php include "footer.php"; ?>