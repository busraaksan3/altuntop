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
                        <h2><?=__c("Müşteri Yorum Ekleme")?> </h2>
                        <div class="clearfix"></div>
                        <div class="x_content">
                            <br />
                            <form enctype="multipart/form-data" action="../baglan/islem.php" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name"><?=__c("Ad Soyad")?><span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="first-name" name="ad_soyad" required="required" placeholder="<?=__c("Müşteri Ad Soyad Giriniz")?>" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12"><?=__c("Yorum")?><span class="required">*</span>
                                    </label>
                                    <div class="col-md-8 col-sm-8 col-xs-12">

                                        <textarea class="ckeditor" id="editor1" name="icerik"></textarea>
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
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name"><?=__c("Foto")?><span>*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="file" id="first-name" name="foto" class="form-control col-md-5 col-xs-12">
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
                <div class="ln_solid"></div>
                <div class="form-group">
                    <div align="right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                        <button type="submit" name="yorumekle" class="btn btn-success"><?=__c("Kaydet")?></button>
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