<?php
include "header.php";
$urunsor = $db->prepare("SELECT * FROM foto_galeri where kategori_idd=:id");
$urunsor->execute(array("id" => $_GET['kategori_idd']));

?>
<!--Page Title-->
<section class="page-title centred" style="background-image: url(assets/images/background/page-title.jpg);">
    <div class="auto-container">
        <div class="content-box clearfix">

            <?php

            $kategorisor = $db->prepare("SELECT * FROM gal_kat where kategori_idd=:id");
            $kategorisor->execute(array(
                'id' => $_GET['kategori_idd']
            ));
            $kategoricek = $kategorisor->fetch(PDO::FETCH_ASSOC); ?>
            <h1><?php echo $kategoricek['ad'] ?></h1>
            <ul class="bread-crumb clearfix">
            <li><a href="index"><?= __c("Anasayfa")?></a></li>
                <li><a href="menu-galeri-22"><?=__c("Galeri")?></a></li>
                <li><?php echo __c($kategoricek['ad']) ?></li>
            </ul>
        </div>
    </div>
</section>


<section class="feature-section mt-5">
    <div class="auto-container">
        <div class="row gallery">
            <?php
            while ($uruncek = $urunsor->fetch(PDO::FETCH_ASSOC)) { ?>

                <div class="col-lg-3 col-md-6 col-sm-12 mb-5">
                    <a href="<?= $uruncek['foto'] ?>">
                        <img class="img-fluid" src="<?= $uruncek['foto'] ?>">
                    </a>
                </div>

            <?php } ?>
        </div>
    </div>
    </div>
</section>

<script src="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.11.1/baguetteBox.min.js"></script>
<script>
    baguetteBox.run(".gallery", {
        animation: "slideIn"
    });
</script>
<!-- about-style-two end -->
<?php include "footer.php"; ?>