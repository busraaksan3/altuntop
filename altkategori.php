<?php
include "header.php";
?>
<!--Page Title-->
<section class="page-title centred" style="background-image: url(assets/images/background/page-title.jpg);">
    <div class="auto-container">
        <div class="content-box clearfix">

            <?php

            $kategorisor = $db->prepare("SELECT * FROM alt_kategori where id=:id");
            $kategorisor->execute(array("id" => $_GET['altkategori_id']));
            $kategoricek = $kategorisor->fetch(PDO::FETCH_ASSOC); ?>

            <h1><?php echo __c($kategoricek['ad']) ?></h1>
            <ul class="bread-crumb clearfix">
                <li><a href="index"><?= __c("Anasayfa") ?></a></li>
                <li><a href="menu-urunler-21"><?= __c("Ürünler") ?></a></li>
                <li><?php echo __c($kategoricek['ad']) ?></li>
            </ul>
        </div>
    </div>
</section>


<section class="feature-section mt-5">
    <div class="auto-container">
    <div class="row clearfix" id="">
                    <?php     
                    $urunsor = $db->prepare("SELECT * FROM urun");
                    $urunsor->execute();                                  
                    foreach ($urunsor as $uruncek) {
                        if(@in_array($kategoricek["id"], json_decode($uruncek["altkategori_id"],true))) {
                        ?>
                        <div class="col-lg-3 col-md-6 col-sm-12 my-5">
                            <div class="feature-block-one wow fadeInUp animated animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                                <div class="inner-box" id="item-<?= $uruncek["urun_id"] ?>">
                                    <?php
                                    $urun_id = $uruncek['urun_id'];
                                    $urunfotosor = $db->prepare("SELECT * FROM urunfoto where urun_id=:urun_id order by urunfoto_id ASC limit 1");
                                    $urunfotosor->execute(array(
                                        'urun_id' => $urun_id
                                    ));
                                    $urunfotocek = $urunfotosor->fetch(PDO::FETCH_ASSOC); ?>
                                    <figure class="image-box"> <a href="urun-<?= $uruncek["urun_url"] . '-' . $uruncek["urun_id"] ?>"><img src="<?php echo $urunfotocek['urunfoto_resimyol'] ?>" style="height: 240px;!important" alt=""></a></figure>
                                    <div class="lower-content">
                                        <div class="inner">
                                            <h3><?php echo __c($uruncek['urun_ad']) ?></h3>
                                            <a href="urun-<?= $uruncek["urun_url"] . '-' . $uruncek["urun_id"] ?>"><span><?= __c("İncele") ?></span><i class="fas fa-arrow-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } } ?>
                </div>
    </div>
    </div>

</section>
<!-- about-style-two end -->
<?php include "footer.php"; ?>