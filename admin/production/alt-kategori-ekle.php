<?php
include("header.php");
include("sidebar.php");
?>
<div class="right_col" role="main">
  <div class="">
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2><?=__c("Alt Kategori Ekleme")?> </h2>
            <div class="clearfix"></div>
            <div class="x_content">
              <br />
              <form enctype="multipart/form-data" action="../baglan/islem.php" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
              <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name"><?=__c("Üst Kategori Seç")?><span class="required">*</span>
                  <label><?=__c("Ctrl tuşuna basarak çoklu seçim yapabilirsiniz")?> </label></label> 
                  <div class="col-md-6 col-sm-6 col-xs-6">
                    <?php
                    //$urun_id=$uruncek['kategori_id'];           
                    $kategorisor = $db->prepare("select * from kategori order by kategori_id");
                    $kategorisor->execute(); ?>
                    <select multiple class="select2_multiple form-control" required="" name="ust[]">
                      <?php

                      while ($kategoricek = $kategorisor->fetch(PDO::FETCH_ASSOC)) {
                        $kategori_id = $kategoricek['kategori_id']; ?>
                        <option value="<?php echo $kategoricek['kategori_id']; ?>"><?php echo __c($kategoricek['kategori_ad']); ?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name"><?= __c("Adı") ?><span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" id="first-name" name="ad" required="required" placeholder="<?= __c("Kategori adını giriniz") ?>" class="form-control col-md-7 col-xs-12">
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name"><?= __c("Url") ?><span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" id="first-name" name="seourl" readonly class="form-control" value="" class="form-control col-md-7 col-xs-12">
                  </div>
                </div>
               
                <div class="ln_solid"></div>
                <div class="form-group">
                  <div align="right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                    <button type="submit" name="altkategorikaydet" class="btn btn-success"><?= __c("Kaydet") ?></button>
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