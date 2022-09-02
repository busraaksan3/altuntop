<?php
include("header.php");
include("sidebar.php");
$kullanicisor = $db->prepare("SELECT * FROM kullanici where kullanici_id=:id");
$kullanicisor->execute(array(
  'id' => $_GET['kullanici_id']
));
$kullanicicek = $kullanicisor->fetch(PDO::FETCH_ASSOC);
?>
<div class="right_col" role="main">
  <div class="">
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2><?=__c("Kullanıcı Düzenle")?> </h2>
            <div class="clearfix"></div>
            <div class="x_content">
              <br /> <br />
              <form enctype="multipart/form-data" action="../baglan/islem.php" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">

                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name"><?=__c("Kullanıcı Adı")?><span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" id="first-name" name="kullanici_ad" value="<?= $kullanicicek["kullanici_ad"] ?>" required="required" class="form-control col-md-7 col-xs-12">
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name"><?=__c("Kullanıcı İsim")?>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" id="first-name" name="kullanici_isim" value="<?= $kullanicicek["kullanici_isim"] ?>" class="form-control col-md-7 col-xs-12">
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name"><?=__c("Kullanıcı Soyisim")?>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" id="first-name" name="kullanici_soyisim" value="<?= $kullanicicek["kullanici_soyisim"] ?>" class="form-control col-md-7 col-xs-12">
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name"><?=__c("Parola")?>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="password" id="first-name" name="kullanici_password" class="form-control col-md-7 col-xs-12">
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name"><?=__c("E-posta")?><span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="mail" id="first-name" name="kullanici_mail" value="<?= $kullanicicek["kullanici_mail"] ?>" required="required" class="form-control col-md-7 col-xs-12">
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name"><?=__c("Telefon")?><span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" id="first-name" name="kullanici_gsm" value="<?= $kullanicicek["kullanici_gsm"] ?>" required="required" class="form-control col-md-7 col-xs-12">
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name"><?=__c("Yetki")?><span class="required">*</span>
                  </label><br> <br>
                  <?php foreach ($sidebar_menu as $menu) { ?>
                    <div class="col-md-3 col-sm-3 col-xs-12"> <label>
                        <input <?php if(in_array($menu['id'],json_decode($kullanicicek["hizmet"]))){?> checked <?php }?> type="checkbox" name="hizmet[]" value="<?php echo $menu['id']; ?>"> <i class="<?php echo $menu['icon']; ?>"></i> <?php echo __C($menu['name']); ?>
                      </label>
                    </div> <?php } ?>
                </div>
            </div>
          </div>
          <input type="hidden" name="kullanici_id" value="<?php echo $kullanicicek['kullanici_id'] ?>">
          <div class="ln_solid"></div>
          <div class="form-group">
            <div align="right" class="col-md-12 col-sm-12 col-xs-12">
              <button type="submit" name="kullaniciduzenle" class="btn btn-success"><?= __c("Kaydet") ?></button>
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