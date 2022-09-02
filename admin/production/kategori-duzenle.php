<?php
include("header.php");
include("sidebar.php");
$kategorisor = $db->prepare("SELECT * FROM kategori where kategori_id=:id");
$kategorisor->execute(array(
    'id' => $_GET['kategori_id']
));
$kategoricek = $kategorisor->fetch(PDO::FETCH_ASSOC);
?>
<div class="right_col" role="main">
    <div class="">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2><?=__c("Kategori Düzenleme")?></h2>
                        <div class="clearfix"></div>
                        <div class="x_content">
                            <br />
                            <form enctype="multipart/form-data" action="../baglan/islem.php" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name"><?= __c("Adı") ?><span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="first-name" name="kategori_ad" required="required" value="<?php echo __c($kategoricek['kategori_ad']) ?>" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name"><?= __c("Url") ?><span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="first-name" name="kategori_seourl" readonly class="form-control" value="<?php echo $kategoricek['kategori_seourl'] ?>" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name"><?= __c("Foto") ?><span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="hidden" name="old_img_url" value="<?php echo $kategoricek['kategori_resim']; ?>">
                                        <img src="../../<?php echo $kategoricek['kategori_resim']; ?>" style="width: 100%; height: 100%;">
                                        <input type="file" id="kategori_resim" name="kategori_resim" class="form-control col-md-5 col-xs-12">
                                    </div>
                                </div>
                                <input type="hidden" name="kategori_id" value="<?php echo $kategoricek['kategori_id'] ?>">
                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div align="right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                        <button type="submit" name="kategoriduzenle" class="btn btn-success"><?= __c("Kaydet") ?></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    include("footer.php"); ?>