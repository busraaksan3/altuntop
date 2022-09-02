<?php
include "header.php";
?>
<!--Page Title-->
<section class="page-title centred" style="background-image: url(assets/images/background/page-title.jpg);">
    <div class="auto-container">
        <div class="content-box clearfix">
            <h1><?= __c("İletişim")?></h1>
            <ul class="bread-crumb clearfix">
            <li><a href="index"><?= __c("Anasayfa")?></a></li>
                <li><?= __c("İletişim")?></li>
            </ul>
        </div>
    </div>
</section>

<section class="contact-style-two">
    <div class="auto-container">
        <div class="row">
            <div class="col-xl-4 col-lg-12 col-md-12 footer-column">
                <?php $ayarsor = $db->prepare("select * from ayar where ayar_id=?");
                $ayarsor->execute(array(0));
                $ayarcek = $ayarsor->fetch(PDO::FETCH_ASSOC); ?>
                
                <ul class="info-list clearfix">
                    <li class="p-3"><i class="fas fa-map-marker-alt"></i><?php echo __c($ayarcek['ayar_adres']); ?> <?php echo __c($ayarcek['ayar_ilce']); ?> / <?php echo __c($ayarcek['ayar_il']); ?></li>
                    <li class="p-3"><i class="fas fa-envelope"></i> <?=__c("E-posta")?> <a href="mailto:<?php echo $ayarcek['ayar_mail']; ?>"><?php echo $ayarcek['ayar_mail']; ?></a></li>
                    <li class="p-3"><i class="fas fa-headphones"></i> <?=__c("Telefon")?> <a href="tel:<?php echo __c($ayarcek['ayar_tel']); ?>"><?php echo $ayarcek['ayar_tel']; ?></a></li>
                </ul>
                <ul class="social-links clearfix list-group list-group-horizontal">
                    <li class="p-3"><a href="<?php echo __c($ayarcek['ayar_facebook']); ?>"><i class="fab fa-facebook-f"></i></a></li>
                    <li class="p-3"><a href="<?php echo __c($ayarcek['ayar_twitter']); ?>"><i class="fab fa-twitter"></i></a></li>
                    <li class="p-3"><a href="<?php echo __c($ayarcek['ayar_instagram']); ?>"><i class="fab fa-instagram"></i></a></li>
                    <li class="p-3"><a href="<?php echo __c($ayarcek['ayar_youtube']); ?>"><i class="fab fa-youtube"></i></a></li>
                </ul>
                
            </div>
            <div class="col-xl-8 col-lg-12 col-md-12 inner-column">
                <div class="sec-title right">
                    <h5 style="color:#666666!important;"><?=__c("Bize Mesaj Gönderin")?></h5>
                </div>
                <?php if (@$_GET['message']) { ?>
                    <?= showAlert(@$_GET['type'], $_GET['message']) ?>
                <?php } ?>
                <form method="post" action="mail.php" id="contact-form" class="default-form">
                    <input type="hidden" name="mail_type" value="iletisim">
                    <div class="row clearfix">
                        <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                            <input type="text" name="name" placeholder="<?=__c("Adınız/Soyadınız")?>" required="">
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                            <input type="email" name="email" placeholder="<?=__c("Email adresiniz")?>" required="">
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                            <input type="text" name="phone" placeholder="<?=__c("Telefon numaranız")?>" required="">
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                            <textarea name="message" placeholder="<?=__c("Mesajınız")?>"></textarea>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 form-group message-btn">
                            <button class="theme-btn style-one" type="submit" name="submit-form"><?=__c("gönder")?></button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</section>
<section class="google-map-section mb-5">
    <div class="map-column">
        <div class="google-map-area">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2825.0275168130297!2d38.174720472137956!3d38.33504686122318!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x407633390e7bb265%3A0xfcae998aa1e16634!2sALTUNTOP%20ISI%20MAK.SAN.T%C4%B0C.LTD.%C5%9ET%C4%B0!5e1!3m2!1str!2str!4v1595489179263!5m2!1str!2str" width="100%" height="430" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
        </div>
    </div>
</section>

<!-- about-style-two end -->
<?php include "footer.php"; ?>