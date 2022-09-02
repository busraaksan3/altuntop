<?php 
include ("header.php");
include ("sidebar.php");
$altmenusor=$db->prepare("SELECT * FROM altmenu where menu_id=menu_id");
$altmenusor->execute(array());
$altmenucek=$altmenusor->fetch(PDO::FETCH_ASSOC);

?>  
<div class="right_col" role="main">
  <div class="">
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
          <h2><?= __c("Alt Menü Ekleme")?></h2>
            <div class="clearfix"></div>
            <div class="x_content">
            <br />
            <form enctype="multipart/form-data" action="../baglan/islem.php" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
              
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name"><?=__c("Alt Menü Ad ")?> <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="first-name" name="altmenu_ad"  required="required" placeholder="<?= __c("Alt Menü adını giriniz")?>" class="form-control col-md-7 col-xs-12">
                </div>
              </div>            
            <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name"><?=__c("Url")?> <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" id="first-name" name="altmenu_url"  readonly class="form-control" value="" class="form-control col-md-7 col-xs-12">
              </div>
            </div>           
              <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" ><?=__c("İçerik")?> <span class="required">*</span>
                  </label>
                  <div class="col-md-8 col-sm-8 col-xs-12">

                    <textarea  class="ckeditor" id="editor1" name="altmenu_icerik"></textarea>
                  </div>
                </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name"><?=__c("Foto")?><span class="required">*</span>
                </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="file" id="first-name"  name="altmenu_foto"  class="form-control col-md-5 col-xs-12">               
                  </div>
              </div>
             <div class="ln_solid"></div>
             <div class="form-group">
              <div align="right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
              <input type="hidden" name="menu_id" value="<?=$_GET['menu_id'];?>">
                <button type="submit" name="altmenukaydet" class="btn btn-success"><?=__c("Kaydet")?></button>
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
