<?php
include("header.php");
include("sidebar.php");
$urunsor = $db->prepare("SELECT * FROM ceviriler where ceviri_id=:ceviri_id");
$urunsor->execute(array(
    'ceviri_id' => $_GET['ceviri_id']
));
$uruncek = $urunsor->fetch(PDO::FETCH_ASSOC);
$diller = $db->query("SELECT * FROM diller")->fetchAll();
?>
    <div class="right_col" role="main">
        <div class="">
            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                        <a class="p-3" href="translates.php"><input type="button" class="btn btn-primary btn-xs" value="<?=__c("GERİ")?>">  </a>  
                            <center><h2><?=__c("Çeviri Düzenle")?> </h2></center>
                               
                            <div class="clearfix"></div>
                            <div class="x_content">
                                <br />
                                <form enctype="multipart/form-data" action="../baglan/islem.php" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                                    <input type="hidden" name="ceviri_id" value="<?= $uruncek['ceviri_id'] ?>">
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="string_key"><?=__c("Çeviri Metni")?><span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="text" id="string_key" name="string_key" disabled value="<?= $uruncek['string_key'] ?>" class="form-control col-md-7 col-xs-12">
                                        </div>
                                    </div>

                                    <?php foreach($diller as $dil){ ?>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">
                                                <img src="../../<?= $dil['lang_icon'] ?>" style="width: 32px !important;">
                                                <?= __c($dil['lang_name']) ?> [<?= $dil['lang_code'] ?>]
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <?php
                                                    $getTranslate = $db->query("SELECT * FROM translates WHERE ceviri_id = '{$uruncek['ceviri_id']}' AND lang_id = '{$dil['id']}'")->fetch(PDO::FETCH_ASSOC);
                                                ?>
                                                <textarea class="form-control" rows="5"  name="translate_<?= $dil['id'] ?>"><?= $getTranslate['translate'] ?></textarea>
                                            </div>
                                        </div>
                                    <?php } ?>

                                    <button type="submit" name="ceviri_update" class="btn btn-primary" style="width: 100%;">
                                        <i class="fa fa-save"></i>
                                        <?=__c("KAYDET")?>
                                    </button>

                                </form>
                            </div>

                        </div>
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