<?php
include "header.php";
$menusor = $db->prepare("SELECT * FROM altmenu where altmenu_id=:id");
$menusor->execute(array("id" => $_GET['altmenu_id']));
$menucek = $menusor->fetch(PDO::FETCH_ASSOC); ?>
<!--Page Title-->
<section class="page-title centred" style="background-image: url(assets/images/background/page-title.jpg);">
    <div class="auto-container">
        <div class="content-box clearfix">
            <h1><?php echo __c($menucek['altmenu_ad']) ?></h1>
            <ul class="bread-crumb clearfix">
                <li><a href="index.html"><?= __c("Anasayfa")?></a></li>
                <li><?php echo __c($menucek['altmenu_ad']) ?></li>
            </ul>
        </div>
    </div>
</section>
<?php
if ($menucek['altmenu_url'] == "sertifikalarimiz") { ?>
    <section class="feature-section mt-5">
        <div class="auto-container">            
            <div class="row clearfix">
                <?php $kategorisor = $db->prepare("SELECT * FROM sertifika order by sert_id ASC");
                $kategorisor->execute();
                while ($kategoricek = $kategorisor->fetch(PDO::FETCH_ASSOC)) { ?>
                    <div class="col-lg-4 col-md-6 col-sm-12 p-4 feature-block">
                        <a href="<?= $kategoricek['sert_foto'] ?>" class="lightbox-image " width="100%"> <img src="<?= $kategoricek['sert_foto'] ?>" alt="" style="height:200px; width:100%;"></a>
                    </div> <?php } ?>
            </div>
       

    </section>
<?php } else if ($menucek['altmenu_url'] == "kariyer") { ?>
    <section class="contact-style-two">
        <div class="auto-container">
            <div class="row">
                <div class="col-xl-8 col-lg-12 col-md-12 inner-column">
                    <div class="sec-title right">
                        <h5 style="color:#666666!important;"><?= __c("İnsan Kaynakları Formu")?></h5>
                    </div>
                    <form method="post" action="" id="contact-form" class="default-form">
                        <div class="row clearfix">
                            <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                <input type="text" name="username" placeholder="<?= __c("Adınız/Soyadınız")?>" required="">
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                <input type="email" name="email" placeholder="<?= __c("Email adresiniz")?>" required="">
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                <input type="text" name="phone" placeholder="<?= __c("Telefon numaranız")?>" required="">
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                <input type="file" name="cv" required=""> <label for="file">CV</label>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                <textarea name="message" placeholder="<?= __c("Varsa Mesajınız")?>"></textarea>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 form-group message-btn">
                                <button class="theme-btn style-one" type="submit" name="submit-form"><?= __c("gönder")?></button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-xl-4 col-lg-12 col-md-12">
                    <figure class="image"><img src="<?php echo $menucek['altmenu_foto']; ?>" alt=""></figure>
                </div>
            </div>
        </div>
    </section>
<?php } else {  ?>
    <section class="about-style-two about-page-1 bg-color-1">
        <div class="auto-container">
            <div class="row clearfix">
                <div class="col-lg-7 col-md-12 col-sm-12 content-column">
                    <div id="content_block_three">
                        <div class="content-box">
                            <div class="sec-title right">
                                <h5><?php echo __c($menucek['altmenu_ad']) ?></h5>
                            </div>

                            <div class="text">
                                <p> <?php echo __c($menucek['altmenu_icerik'])?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 col-md-12 col-sm-12 image-column">
                    <div id="image_block_two">
                        <div class="image-box">
                            <div class="pattern-layer" style="background-image: url(assets/images/shape/shape-25.png);"></div>
                            <figure class="image" style="height: 100%;"><img src="<?php echo $menucek['altmenu_foto']; ?>" alt=""></figure>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><?php } ?>
<!-- about-style-two end -->
<?php include "footer.php"; ?>