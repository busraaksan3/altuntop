<?php
include("header.php");
include("sidebar.php");

$menusor = $db->prepare("SELECT * FROM altmenu where altmenu_id=:id");
$menusor->execute(array(
  'id' => $_GET['altmenu_id']
));
$menucek = $menusor->fetch(PDO::FETCH_ASSOC);
?>
<div class="right_col" role="main">
  <div class="">
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2><?= __c("Alt Menü Düzenleme") ?></h2>
            <div class="clearfix"></div>
            <div class="x_content">
              <br />
              <form enctype="multipart/form-data" action="../baglan/islem.php" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name"><?= __c("Alt Menü Ad ") ?><span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" id="first-name" name="altmenu_ad" required="required" value="<?php echo __c($menucek['altmenu_ad']) ?>" class="form-control col-md-7 col-xs-12">
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name"><?= __c("Url") ?> <span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" id="first-name" name="altmenu_url" readonly class="form-control" value="<?php echo $menucek['altmenu_url'] ?>" class="form-control col-md-7 col-xs-12">
                  </div>
                </div>

                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12"><?= __c("Alt Menü İçerik") ?> <span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">

                    <textarea class="ckeditor" id="editor1" name="altmenu_icerik"> <?php echo __c($menucek['altmenu_icerik']) ?></textarea>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name"><?= __c("Foto") ?> <span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="hidden" name="old_img_url" value="<?php echo $menucek['altmenu_foto']; ?>">
                    <img src="../../<?php echo $menucek['altmenu_foto']; ?>" style="width: 100%; height: 100%;">
                    <input type="file" id="altmenu_foto" name="altmenu_foto" class="form-control col-md-5 col-xs-12">
                  </div>
                </div>
              </form>
            </div>
          </div>

          <input type="hidden" name="altmenu_id" value="<?php echo $menucek['altmenu_id'] ?>">
          <div class="ln_solid"></div>
          <div class="form-group">
            <div align="right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
              <button type="submit" name="altmenuduzenle" class="btn btn-success"><?= __c("Kaydet") ?></button>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
</div>
</div>
<?php
include("footer.php"); ?>