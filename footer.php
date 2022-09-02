<?php
$ayarsor = $db->prepare("select * from ayar where ayar_id=?");
$ayarsor->execute(array(0));
$ayarcek = $ayarsor->fetch(PDO::FETCH_ASSOC); ?>
<!-- main-footer -->
<footer class="main-footer">
    <div class="footer-top">
        <div class="auto-container">
            <div class="widget-section">
                <div class="row clearfix">
                    <div class="col-lg-3 col-md-6 col-sm-12 footer-column">
                        <div class="footer-widget logo-widget">
                            <figure class="footer-logo"><a href="javascript:"><img src="assets/resim/logo.png" class="me-footer-logo" alt=""></a></figure>
                            <div class="text">
                                <p>
                                    <?=__c("Altuntop Fırın Makinaları firmamız Türkiye nin önde gelen fırın makinaları
                                    üreticilerinden biridir.")?>
                                </p>
                            </div>
                            <ul class="info-list clearfix">
                                <li><i class="fas fa-map-marker-alt"></i><?php echo __c($ayarcek['ayar_adres']); ?> <?php echo __c($ayarcek['ayar_ilce']); ?> / <?php echo __c($ayarcek['ayar_il']); ?></li>
                                <li><i class="fas fa-envelope"></i> <?= __c("E-posta") ?> <a href="mailto:<?php echo $ayarcek['ayar_mail']; ?>"><?php echo $ayarcek['ayar_mail']; ?></a></li>
                                <li><i class="fas fa-headphones"></i> <?= __c("Telefon") ?> <a href="tel:<?php echo __c($ayarcek['ayar_tel']); ?>"><?php echo $ayarcek['ayar_tel']; ?></a></li>
                            </ul>
                            <ul class="social-links clearfix">
                                <li><a href="<?php echo __c($ayarcek['ayar_facebook']); ?>"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="<?php echo __c($ayarcek['ayar_twitter']); ?>"><i class="fab fa-twitter"></i></a></li>
                                <li><a href="<?php echo __c($ayarcek['ayar_instagram']); ?>"><i class="fab fa-instagram"></i></a></li>
                                <li><a href="<?php echo __c($ayarcek['ayar_youtube']); ?>"><i class="fab fa-youtube"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 footer-column">
                        <div class="footer-widget links-widget ml-70">
                            <div class="widget-title">
                                <h4><?=__c("Site Haritası")?></h4>
                            </div>
                            <div class="widget-content">
                                <?php $menusor = $db->prepare("SELECT * FROM menu order by menu_sira");
                                $menusor->execute(); ?>
                                <ul class="list clearfix">
                                <li><a href="index"><?=__c("Anasayfa")?></a></li>
                                    <?php while ($menucek = $menusor->fetch(PDO::FETCH_ASSOC)) { ?>
                                        <li><a href="menu-<?= $menucek["menu_url"] . '-' . $menucek["menu_id"] ?>"><?php echo __c($menucek['menu_ad']) ?></a></li>
                                    <?php } ?>
                                    <li><a href="iletisim"><?=__c("İletişim")?></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 footer-column">
                        <div class="footer-widget links-widget">
                            <div class="widget-title">
                                <h4><?=__c("Kategoriler")?></h4>
                            </div>
                            <div class="widget-content">
                                <ul class="list clearfix">
                                    <?php $kategorisor = $db->prepare("SELECT * FROM kategori order by kategori_id ASC");
                                    $kategorisor->execute();
                                    while ($kategoricek = $kategorisor->fetch(PDO::FETCH_ASSOC)) { ?>
                                        <li><a href="menu-<?= $kategoricek["kategori_seourl"]; ?>"><?php echo __c($kategoricek['kategori_ad']) ?></a></li>
                                        </li><?php } ?>
                                    <li><a href="menu-urunler-21"><?=__c("Tüm Ürünler")?></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="auto-container">
            <div class="copyright">
                <p>&copy;<?=__c("2022 Her Hakkı Saklıdır. kopyalanması, çoğaltılması ve dağıtılması halinde yasal haklarımız işletilecektir.")?> </p>
            </div>
        </div>
    </div>
</footer>
<!-- main-footer end -->



<!--Scroll to top-->
<button class="scroll-top scroll-to-target" data-target="html">
    <span class="fa fa-arrow-up"></span>
</button>


<!-- sidebar cart item -->
<div class="xs-sidebar-group info-group info-sidebar">
    <div class="xs-overlay xs-bg-black"></div>
    <div class="xs-sidebar-widget">
        <div class="sidebar-widget-container">
            <div class="widget-heading">
                <a href="#" class="close-side-widget">X</a>
            </div>
            <div class="sidebar-textwidget">
                <div class="sidebar-info-contents">
                    <div class="content-inner">
                        <div class="upper-box">
                            <div class="logo">
                                <a href="javascript:"><img src="assets/resim/logo.png" alt="" /></a>
                            </div>
                            <div class="text">
                                <p>
                                   <?=__c("Altuntop Fırın Makinaları firmamız Türkiye nin önde gelen fırın makinaları üreticilerinden biridir.")?> 
                                </p>
                            </div>
                        </div>
                        <div class="side-menu-box">
                            <div class="side-menu">
                                <nav class="menu-box">
                                    <div class="menu-outer">
                                    </div>
                                </nav>
                            </div>
                        </div>
                        <div class="info-box">
                            <h3><?=__c("İletişim Bilgileri")?></h3>
                            <ul class="info-list clearfix">
                                <li><i class="fas fa-map-marker-alt"></i><?php echo __c($ayarcek['ayar_adres']); ?> <?php echo __c($ayarcek['ayar_ilce']); ?> / <?php echo __c($ayarcek['ayar_il']); ?></li>
                                <li><i class="fas fa-envelope"></i><?=__c("E-posta")?> <a href="mailto:<?php echo $ayarcek['ayar_mail']; ?>"><?php echo $ayarcek['ayar_mail']; ?></a></li>
                                <li><i class="fas fa-headphones"></i><?=__c("Telefon")?> <a href="tel:<?php echo $ayarcek['ayar_tel']; ?>"><?php echo $ayarcek['ayar_tel']; ?></a></li>
                                <li><i class="far fa-clock"></i><?php echo __c($ayarcek['ayar_mesai']); ?></li>
                            </ul>
                           
                            <ul class="social-links clearfix">
                                <li><a href="<?php echo __c($ayarcek['ayar_facebook']); ?>"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="<?php echo __c($ayarcek['ayar_twitter']); ?>"><i class="fab fa-twitter"></i></a></li>
                                <li><a href="<?php echo __c($ayarcek['ayar_instagram']); ?>"><i class="fab fa-instagram"></i></a></li>
                                <li><a href="<?php echo __c($ayarcek['ayar_youtube']); ?>"><i class="fab fa-youtube"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- END sidebar widget item -->

<?= getWebCustomContent("content_end_body",$db) ?>


<!-- jequery plugins -->
<script src="assets/js/jquery.js"></script>
<script src="assets/js/popper.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/owl.js"></script>
<script src="assets/js/wow.js"></script>
<script src="assets/js/validation.js"></script>
<script src="assets/js/jquery.fancybox.js"></script>
<script src="assets/js/appear.js"></script>
<script src="assets/js/jquery.countTo.js"></script>
<script src="assets/js/scrollbar.js"></script>
<script src="assets/js/nav-tool.js"></script>
<script src="assets/js/TweenMax.min.js"></script>
<script src="assets/js/circle-progress.js"></script>
<!-- <script src="assets/js/jquery.nice-select.min.js"></script> -->

<!-- main-js -->
<script src="assets/js/script.js"></script>

<?= getWebCustomContent("content_js",$db) ?>

<script type="text/javascript">
    $(document).ready(function(){

    });
</script>

</body><!-- End of .page_wrapper -->

</html>