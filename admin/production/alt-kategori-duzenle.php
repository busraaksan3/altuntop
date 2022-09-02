<?php
include("header.php");
include("sidebar.php");
$altkategorisor = $db->prepare("SELECT * FROM alt_kategori where id=:id");
$altkategorisor->execute(array(
    'id' => $_GET['id']
));
$altkategoricek = $altkategorisor->fetch(PDO::FETCH_ASSOC);
?>
<div class="right_col" role="main">
    <div class="">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2><?= __c("Alt Kategori Düzenle") ?> </h2>
                        <div class="clearfix"></div>
                        <div class="x_content">
                            <br />
                            <form enctype="multipart/form-data" action="../baglan/islem.php" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name"><?= __c("Üst Kategori Seç") ?><span class="required">*</span>
                                        <label><?= __c("Ctrl tuşuna basarak çoklu seçim yapabilirsiniz") ?> </label></label>
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <?php
                                        $kategorisor = $db->prepare("select * from kategori order by kategori_id");
                                        $kategorisor->execute();
                                        foreach ($kategorisor as $kategoricek) { ?>
                                            <div class="col-md-3 col-sm-3 col-xs-6"> <label>
                                            <input <?php if (@in_array($kategoricek["kategori_id"], json_decode($altkategoricek['ust'], true))) { ?> checked <?php } ?> type="checkbox" name="ust[]" value="<?php echo $kategoricek['kategori_id'] ?>"> <?php echo __c($kategoricek['kategori_ad']) ?><br>
                                            
                                                </label>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name"><?= __c("Adı") ?><span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="first-name" name="ad" required="required" value="<?= $altkategoricek['ad'] ?>" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name"><?= __c("Url") ?><span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="first-name" name="seourl" readonly class="form-control" value="<?= $altkategoricek['seourl'] ?>" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>

                                <div class="ln_solid"></div>
                                <input type="hidden" name="id" value="<?php echo $altkategoricek['id'] ?>">
                                <div class="form-group">
                                    <div align="right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                        <button type="submit" name="altkategoriduzenle" class="btn btn-success"><?= __c("Kaydet") ?></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include("footer.php"); ?>