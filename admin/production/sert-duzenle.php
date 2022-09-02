<?php
include("header.php");
include("sidebar.php");
$sertsor = $db->prepare("SELECT * FROM sertifika where sert_id=:id");
$sertsor->execute(array(
    'id' => $_GET['sert_id']
));
$sertcek = $sertsor->fetch(PDO::FETCH_ASSOC);
?>
<div class="right_col" role="main">
    <div class="">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2><?= __c("Sertifika Düzenleme") ?> </h2>
                        <div class="clearfix"></div>
                        <div class="x_content">
                            <br />
                            <form enctype="multipart/form-data" action="../baglan/islem.php" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name"><?= __c("Ad") ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="first-name" name="sert_ad" required="required" value="<?php echo __c($sertcek['sert_ad']) ?>" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name"><?= __c("Foto") ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="hidden" name="old_img_url" value="<?php echo $sertcek['sert_foto']; ?>">
                                        <img src="../../<?php echo $sertcek['sert_foto']; ?>" style="width: 100%; height: 100%;">
                                        <input type="file" id="sert_foto" name="sert_foto" class="form-control col-md-5 col-xs-12">
                                    </div>
                                </div>
                                <input type="hidden" name="sert_id" value="<?php echo $sertcek['sert_id'] ?>">
                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div align="right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                        <button type="submit" name="sertduzenle" class="btn btn-success"><?= __c("Kaydet") ?></button>
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