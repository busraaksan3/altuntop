<?php
include 'header.php';
include("sidebar.php");
$galerisor = $db->prepare("SELECT * FROM gal_kat where kategori_idd=kategori_idd");
$galerisor->execute(array('kategori_idd' => $_GET['kategori_idd']));
$galericek = $galerisor->fetch(PDO::FETCH_ASSOC);
?>

<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
        </div>
        <div class="col-md-12">
            <div class="title_right">
                <a href="foto-galeri.php?kategori_idd=<?= $_GET['kategori_idd']; ?> "><input type="button" class="btn btn-primary btn-xs" value="-"> </a>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="x_panel">
                                        <div class="x_title">
                                            <h2><?=__c("Çoklu resim yükleme işlemleri")?></h2>
                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="x_content">
                                            <p><?=__c("Yüklenecek resimlerin bulunduğu klasöre giderek tamamını tek seferde seçerek yükleyebilirsiniz.")?></p>
                                            <form action="../baglan/foto-galeri.php" class="dropzone">
                                                <input type="hidden" name="kategori_idd" value="<?= $_GET['kategori_idd']; ?>">
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<!-- /page content -->



<?php include 'footer.php'; ?>