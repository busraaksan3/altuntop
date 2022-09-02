<?php
include "header.php";
if (isset($_POST['arama'])) {
    $aranan = $_POST['aranan'];
    $urunsor = $db->prepare("SELECT * FROM urun where urun_ad LIKE ?");
    $urunsor->execute(array("%$aranan%"));
    $say = $urunsor->rowCount();
} else {
    Header("Location:index.php?durum=bos");
}
if ($say == 0) {
    echo __c("Bu kategoride ürün bulunamadı");
} ?>
<!-- about-style-two -->
<section class="about-style-two about-page-1 bg-color-1">
    <div class="auto-container">
        <h5 class="mb-4"><?=__c("Arama")?></h5>
        <div class="row clearfix">
            <?php while ($uruncek = $urunsor->fetch(PDO::FETCH_ASSOC)) { ?>
                <div class="col-lg-4 col-md-6 col-sm-12 service-block">
                    <div class="service-block-three">
                        <div class="inner-box">
                            <figure class="image-box">
                                <div class="overlay-box-1"></div>
                                <div class="overlay-box-2"></div>
                                <?php
                            $urun_id = $uruncek['urun_id'];
                            $urunfotosor = $db->prepare("SELECT * FROM urunfoto where urun_id=:urun_id order by urunfoto_id ASC limit 1");
                            $urunfotosor->execute(array(
                                'urun_id' => $urun_id
                            ));
                            $urunfotocek = $urunfotosor->fetch(PDO::FETCH_ASSOC); ?>
                                <img src="<?php echo $urunfotocek['urunfoto_resimyol'] ?>" style="height: 240px;!important" alt=""> 
                                <a href="urun-<?= $uruncek["urun_url"] . '-' . $uruncek["urun_id"] ?>"><i class="fas fa-link"></i></a>
                            </figure>
                            <div class="lower-content">
                                <h3><a href="urun-<?= $uruncek["urun_url"] . '-' . $uruncek["urun_id"] ?>"><?php echo __c($uruncek['urun_ad']) ?></a></h3>
                                
                                <div class="link"><a href="urun-<?= $uruncek["urun_url"] . '-' . $uruncek["urun_id"] ?>"><i class="fas fa-arrow-right"></i><span><?=__c("Ürüne git")?></span></a></div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</section>
<!-- about-style-two end -->
<?php include "footer.php"; ?>