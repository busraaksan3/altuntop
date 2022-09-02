<?php 
include ("header.php");
include ("sidebar.php");
$slidersor=$db->prepare("SELECT * FROM slider where slider_id=:id");
$slidersor->execute(array( 'id' => $_GET['slider_id']));
$slidercek=$slidersor->fetch(PDO::FETCH_ASSOC);
?>  
<div class="right_col" role="main">
  <div class="">
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2><?=__c("Slider Düzenleme")?> </h2>
            <div class="clearfix"></div>
            <div class="x_content">
              <br />
              <form enctype="multipart/form-data" action="../baglan/islem.php" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name"><?=__c("Foto")?><span>*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="file" id="first-name"  name="slider_resimyol"  class="form-control col-md-5 col-xs-12">
                    <input type="hidden" name="old_img_url" value="<?php echo $slidercek['slider_resimyol']; ?>">
                    <img src="../../<?php echo $slidercek['slider_resimyol']; ?>"  style="width: 100%; height: 100%;" >                
                  </div>                  
                </div>
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" ><?=__c("Adı")?><span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" id="first-name" name="slider_ad"  required="required" value="<?php echo $slidercek['slider_ad']; ?>" class="form-control col-md-7 col-xs-12">
                  </div>
                </div>            
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name"><?=__c("Başlık")?> <span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" id="first-name" name="slider_h"  value="<?php echo __c($slidercek['slider_h']); ?>" class="form-control col-md-7 col-xs-12">
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name"><?=__c("Alt başlık")?><span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" id="first-name" name="slider_p"  value="<?php echo $slidercek['slider_p']; ?>" class="form-control col-md-7 col-xs-12">
                  </div>
                </div>  
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name"><?=__c("Sıra")?><span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" id="first-name" name="slider_sira" value="<?php echo $slidercek['slider_sira']; ?>" class="form-control col-md-7 col-xs-12">
                  </div>
                </div>
                <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name"><?=__c("Buton")?>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" id="first-name" name="slider_buton"   value="<?php echo __c($slidercek['slider_buton']); ?>" class="form-control col-md-7 col-xs-12">
              </div>
            </div>
            <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name"><?=__c("Buton")?>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" id="first-name" name="slider_buton2"  value="<?php echo __c($slidercek['slider_buton2']); ?>" class="form-control col-md-7 col-xs-12">
              </div>
            </div>
               </div>
              </div>
            </div>
            <input type="hidden" name="slider_id" value="<?php echo $slidercek['slider_id'] ?>">
            <div class="ln_solid"></div>
            <div class="form-group">
              <div align="right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                <button type="submit" name="sliderduzenle" class="btn btn-success"><?=__c("Kaydet")?></button>
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
include ("footer.php");?>
