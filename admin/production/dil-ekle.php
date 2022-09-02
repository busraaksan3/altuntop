<?php
include("header.php");
include("sidebar.php");
$dilsor = $db->prepare("SELECT * FROM diller");
$dilsor->execute();
$dilcek = $dilsor->fetch(PDO::FETCH_ASSOC);
?>
<div class="right_col" role="main">
    <div class="">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                    <h2><?= __c("Dil Ekleme")?></h2>
                        <div class="clearfix"></div>
                        <div class="x_content">
                            <br />
                            <form enctype="multipart/form-data" action="../baglan/islem.php" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name"><?=__c("Foto")?><span>*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="file" id="first-name" name="lang_icon" class="form-control col-md-5 col-xs-12">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12"><?= __c("Adı")?><span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="first-name" name="lang_name" required="required" placeholder="<?= __c("Dil adını giriniz")?>" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name"><?= __c("Kod")?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="first-name" name="lang_code" placeholder="<?= __c("Kod giriniz")?>" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name"><?=__c("Sıra")?><span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="sira" name="sira" placeholder="Sıra" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name"><?=__c("Hizala")?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select class="form-control" name="align" class="form-control col-md-7 col-xs-12">
                                            <option></option>
                                            <option value="<?php echo $dilcek['align']=0; ?>"><?=__c("Sol")?></option>
                                            <option value="<?php echo $dilcek['align']=1; ?>"><?=__c("Sağ")?></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name"><?=__c("Durum")?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select class="form-control" name="durum" class="form-control col-md-7 col-xs-12">
                                            <option></option>
                                            <option value="<?php echo $dilcek['durum']="pasif"; ?>"><?=__c("Pasif")?></option>
                                            <option value="<?php echo $dilcek['durum']="aktif"; ?>"><?=__c("Aktif")?></option>
                                        </select>
                                    </div>
                                </div>

                        </div>
                    </div>
                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div align="right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                            <button type="submit" name="dilekle" class="btn btn-success"><?=__c("Kaydet")?></button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include("footer.php"); ?>