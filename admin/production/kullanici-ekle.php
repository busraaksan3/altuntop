<?php
include("header.php");
include("sidebar.php");

$user = $db->prepare("SELECT * FROM kullanici WHERE kullanici_id=?");
$user->execute(array($_SESSION["kullanici_id"]));

$kullanicisor = $db->prepare("SELECT * FROM kullanici");
$kullanicisor->execute();
$kullanicicek = $kullanicisor->fetch(PDO::FETCH_ASSOC);

?>
<div class="right_col" role="main">
  <div class="">
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
          <h2><?=__c("Kullanıcı Ekleme")?> </h2>
            <div class="clearfix"></div>
            <div class="x_content">
              <br /> <br />
              <form enctype="multipart/form-data" action="../baglan/islem.php" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name"><?=__c("Kullanıcı Adı")?><span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" id="first-name" name="kullanici_ad" required="required" class="form-control col-md-7 col-xs-12">
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name"><?=__c("Kullanıcı İsim")?>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" id="first-name" name="kullanici_isim" class="form-control col-md-7 col-xs-12">
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name"><?=__c("Kullanıcı Soyisim")?>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" id="first-name" name="kullanici_soyisim" class="form-control col-md-7 col-xs-12">
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name"><?=__c("Parola")?><span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="password" id="first-name" name="kullanici_password" required="required" class="form-control col-md-7 col-xs-12">
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name"><?=__c("E-posta")?><span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="mail" id="first-name" name="kullanici_mail" required="required" class="form-control col-md-7 col-xs-12">
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name"><?=__c("Telefon")?><span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" id="first-name" name="kullanici_gsm" required="required" class="form-control col-md-7 col-xs-12">
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Y<?=__c("Yetki")?>etki<span class="required">*</span>
                  </label><br> <br>
                  <?php foreach ($sidebar_menu as $menu) { ?>
                    <div class="col-md-3 col-sm-3 col-xs-12"> <label>
                        <input type="checkbox" name="hizmet[]" value="<?php echo $menu['id']; ?>"> <i class="<?php echo $menu['icon']; ?>"></i> <?php echo __c($menu['name']); ?>
                      </label>
                    </div> <?php } ?>
                </div>                
            </div>
          </div>
          <div class="ln_solid"></div>
          <div class="form-group">
            <div align="right" class="col-md-12 col-sm-12 col-xs-12">
              <button type="submit" name="kullaniciekle" class="btn btn-success"><?= __c("Kaydet") ?></button>
            </div>
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