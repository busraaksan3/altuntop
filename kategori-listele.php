<?php
include "header.php";
$urunsor = $db->prepare("SELECT * FROM urun where kategori_id=:id");
$urunsor->execute(array("id" => $_GET['kategori_id']));

?>
<!--Page Title-->
<section class="page-title centred" style="background-image: url(assets/images/background/page-title.jpg);">
    <div class="auto-container">
        <div class="content-box clearfix">

            <?php

            $kategorisor = $db->prepare("SELECT * FROM kategori where kategori_id=:id");
            $kategorisor->execute(array(
                'id' => $_GET['kategori_id']
            ));
            $kategoricek = $kategorisor->fetch(PDO::FETCH_ASSOC); ?>
            <h1><?php echo __c($kategoricek['kategori_ad']) ?></h1>
            <ul class="bread-crumb clearfix">
                <li><a href="index"><?= __c("Anasayfa") ?></a></li>
                <li><a href="menu-urunler-21"><?= __c("Ürünler") ?></a></li>
                <li><?php echo __c($kategoricek['kategori_ad']) ?></li>
            </ul>
        </div>
    </div>
</section>


<section class="feature-section mt-5">
    <div class="auto-container">
        <div class="row clearfix">
            <div class=" col-lg-3 col-md-6 col-sm-12 sidebar-side my-5">
            <h5><b><?php echo __c($kategoricek['kategori_ad']) ?> </b></h5><hr>
                <?php
                $katsor = $db->prepare("SELECT * FROM alt_kategori");
                $katsor->execute();
                foreach ($katsor as $subCat) {
                    $coz = json_decode($subCat["ust"],true);
                    if(in_array($kategoricek['kategori_id'],$coz)){
                ?> 
                        <h6><a style="color:black" href="altkategori-<?= $subCat['seourl'] . '-' . $subCat["id"] ?>"> <i class="fa fa-angle-right"></i> <?= $subCat['ad'] ?></a></h6> <br>
                        
                <?php }} ?>
            </div>
            <div class="col-lg-9 col-md-6 col-sm-12 content-side">
                <div class="row clearfix" id="">
                    <?php
                    foreach ($urunsor as $uruncek) { ?>
                        <div class="col-lg-4 col-md-6 col-sm-12 my-5">
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
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- about-style-two end -->
<?php include "footer.php"; ?>