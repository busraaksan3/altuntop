<?php
include "header.php";
$urunsor = $db->prepare("SELECT * FROM urun where urun_id=:id");
$urunsor->execute(array("id" => $_GET['urun_id']));
$uruncek = $urunsor->fetch(PDO::FETCH_ASSOC);
?>

<section class="about-style-two about-page-1 bg-color-1">
    <div class="auto-container">
        <div class="row clearfix">
            <div class="col-lg-7 col-md-12 col-sm-12 content-column">
                <div id="content_block_three">
                    <div class="content-box">
                        <div class="sec-title right">
                            <h5><?php echo __c($uruncek['urun_ad']) ?></h5>
                        </div>
                        <div class="text">
                            <h5><?=__c("Ürün Kodu:")?><?php echo $uruncek['urun_kod'] ?></h5>
                            <p> <?php echo __c($uruncek['urun_aciklama']) ?></p>
                        </div>
                    </div>
                </div>
            </div>

            <?php $urun_id = $uruncek['urun_id'];
            $urunfotosor = $db->prepare("SELECT * FROM urunfoto where urun_id=:urun_id");
            $urunfotosor->execute(array(
                'urun_id' => $urun_id
            )); ?>
            <div class="col-lg-5 col-md-12 col-sm-12 ">
                <div class="blog-classic-content">
                    <div class="news-carousel owl-carousel owl-theme owl-dots-none">
                        <?php while ($urunfotocek = $urunfotosor->fetch(PDO::FETCH_ASSOC)) { ?>
                            <div class="col-lg-12 col-md-12 col-sm-12 image-column">
                                <div class="auto-container">
                                    <div class="news-block-three">
                                        <div class="inner-box">
                                            <figure class="image-box">
                                                <a href="<?php echo $urunfotocek['urunfoto_resimyol'] ?>" class="lightbox-image"> <img src="<?php echo $urunfotocek['urunfoto_resimyol'] ?>"  alt=""></a>
                                            </figure>
                                        </div>
                                    </div>
                                </div>
                            </div><?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 content-column mt-5">
                <?php if ($uruncek['urun_teknik'] == true) { ?>
                    <img src="<?=$uruncek['urun_teknik']?>" alt="" class="w-100">
                <?php } ?>
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 content-column mt-5">
                <?php if ($uruncek['urun_video'] == true) { ?>
                    <iframe width="100%" height="600" src="https://www.youtube.com/embed/<?php echo $uruncek['urun_video'] ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                <?php } ?>
            </div>
        </div>
        <div class="row clearfix">
        <?php if ($uruncek['urun_sertifika'] != null) { ?>
            <div class="col-lg-12 col-md-12 col-sm-12 mt-5 d-none d-lg-block">                
                <h4><?=__c("Sertifikalar")?>:</h4>
                <div class="auto-container" style="display:flex;">
                <?php
                  $paketiceriksor = $db->prepare("SELECT * FROM sertifika order by sert_id ASC");
                  $paketiceriksor->execute();
                  ?>
                  <?php
                  foreach ($paketiceriksor as $paketicerikcek) {
                   if (@in_array($paketicerikcek["sert_id"], json_decode($uruncek['urun_sertifika'],true))) { ?>
                  
                        <a href="<?= $paketicerikcek['sert_foto'] ?>" class="lightbox-image" style="margin:0 5px;"> <img src="<?= $paketicerikcek['sert_foto'] ?>" alt="" class="mt-2" style="height:500px; width:100%;"></a>
                    <?php } }?>
                </div>
            </div>

            <div class="col-lg-12 col-md-12 col-sm-12 mt-5">
                <div class="auto-container d-lg-none">
                <?php
                  $paketiceriksor = $db->prepare("SELECT * FROM sertifika order by sert_id ASC");
                  $paketiceriksor->execute();
                  ?>
                  <?php
                  foreach ($paketiceriksor as $paketicerikcek) {
                   if (@in_array($paketicerikcek["sert_id"], json_decode($uruncek['urun_sertifika'],true))) { ?>
                  
                        <a href="<?= $paketicerikcek['sert_foto'] ?>" class="lightbox-image" style="margin:0 5px;"> <img src="<?= $paketicerikcek['sert_foto'] ?>" alt="" class="mt-2" style="height:500px; width:100%;"></a>
                    <?php } }?>
                </div>
            </div>  <?php } ?>
        </div>
    </div>
    </div>
</section>
<!-- about-style-two end -->
<?php include "footer.php"; ?>