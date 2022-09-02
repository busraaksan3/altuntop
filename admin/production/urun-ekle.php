<?php
include("header.php");
include("sidebar.php");
$urunsor = $db->prepare("SELECT * FROM urun");
$urunsor->execute(); ?>
<div class="right_col" role="main">
  <div class="">
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
          <h2><?=__c("Ürün Ekleme")?> </h2>
            <div class="clearfix"></div>
            <div class="x_content">
              <br />
              <form enctype="multipart/form-data" action="../baglan/islem.php" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name"><?=__c("Kategori Seç")?><span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-6">
                    <?php
                    //$urun_id=$uruncek['kategori_id'];           
                    $kategorisor = $db->prepare("select * from kategori order by kategori_id");
                    $kategorisor->execute(); ?>
                    <select class="select2_multiple form-control" required="" name="kategori_id">
                      <?php

                      while ($kategoricek = $kategorisor->fetch(PDO::FETCH_ASSOC)) {
                        $kategori_id = $kategoricek['kategori_id']; ?>
                        <option value="<?php echo $kategoricek['kategori_id']; ?>"><?php echo __c($kategoricek['kategori_ad']); ?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name"><?=__c("Alt Kategori Seç")?><span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-6">
                    <?php
                    //$urun_id=$uruncek['kategori_id'];           
                    $altkategorisor = $db->prepare("select * from alt_kategori order by id");
                    $altkategorisor->execute();                   
                    foreach ($altkategorisor as $altkategoricek)  {
                      ?> 
                      <div class="col-md-3 col-sm-3 col-xs-6"> <label>
                          <input type="checkbox" name="altkategori_id[]" value="<?php echo $altkategoricek['id']?>"> <?php echo __c($altkategoricek['ad']) ?><br>
                        </label>                                      
                        </div>
                      <?php } ?>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name"><?=__c("Ad")?><span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" id="first-name" name="urun_ad" required="required" placeholder="<?=__c("Ürün Adını Giriniz")?>" class="form-control col-md-7 col-xs-12">
                  </div>
                </div>
                 <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name"><?=__c("Sıra")?><span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" id="first-name" name="urun_sira" required="required" placeholder="<?=__c("Ürün Sırasını Giriniz")?>" class="form-control col-md-7 col-xs-12">
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name"><?=__c("Ürün Kod")?><span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" id="first-name" name="urun_kod" required="required" placeholder="<?=__c("Ürün Kodunu Giriniz")?>" class="form-control col-md-7 col-xs-12">
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name"><?=__c("URL")?>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" name="urun_url" readonly class="form-control" placeholder="<?=__c("URL")?>" class="form-control col-md-7 col-xs-12">
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12"><?=__c("Ürün Açıklama")?><span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">

                    <textarea class="ckeditor" id="editor1" name="urun_aciklama"></textarea>
                  </div>
                </div>
                <script type="text/javascript">
                  CKEDITOR.replace('editor1', {
                    filebrowserBrowseUrl: 'ckfinder/ckfinder.html',
                    filebrowserImageBrowseUrl: 'ckfinder/ckfinder.html?type=Images',
                    filebrowserFlashBrowseUrl: 'ckfinder/ckfinder.html?type=Flash',
                    filebrowserUploadUrl: 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
                    filebrowserImageUploadUrl: 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
                    filebrowserFlashUploadUrl: 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',
                    forcePasteAsPlainText: true
                  });
                </script>
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name"><?=__c("Ürün Teknik bilgileri Görseli")?><span>*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="file" id="first-name" name="urun_teknik" class="form-control col-md-5 col-xs-12">
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name"><?=__c("Ürün Video")?>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" name="urun_video" class="form-control" placeholder="<?=__c("Linkin sadece son kısmını giriniz. Örneğin: PxUcXi4HS4g")?>" class="form-control col-md-7 col-xs-12">
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for=""><?=__c("Sertifikaları seç")?><span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <?php
                    $paketiceriksor = $db->prepare("SELECT * FROM sertifika order by sert_id ASC");
                    $paketiceriksor->execute();
                    ?>
                    <?php
                    foreach ($paketiceriksor as $paketicerikcek) {
                    ?>
                      <div class="col-md-3 col-sm-3 col-xs-6"> <label>
                          <input type="checkbox" name="urun_sertifika[]" value="<?php echo $paketicerikcek['sert_id'] ?>"> <?php echo __c($paketicerikcek['sert_ad']) ?><br>
                        </label>
                      </div>
                    <?php } ?>
                  </div> 
                </div>
            </div>
          </div>
          <div class="ln_solid"></div>
          <div class="form-group">
            <div align="right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
              <button type="submit" name="urunekle" class="btn btn-success"><?=__c("Kaydet")?></button>
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