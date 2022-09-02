<?php
include("header.php");
include("sidebar.php");
$ulkesor = $db->prepare("SELECT * FROM ulkeler");
$ulkesor->execute(); ?>
<div class="right_col" role="main">
    <div class="">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2><?=__c("Ülke Ekle")?> </h2>
                        <div class="clearfix"></div>
                        <div class="x_content">
                            <br />
                            <form enctype="multipart/form-data" action="../baglan/islem.php" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12"><?=__c("Adı")?><span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="first-name" name="name" required="required" placeholder="<?=__c("Ülke Adını Giriniz")?>" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>
                             
                        </div>
                    </div>
                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div align="right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                            <button type="submit" name="ulkeekle" class="btn btn-success"><?=__c("KAYDET")?></button>
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