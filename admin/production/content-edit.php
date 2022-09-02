<?php
include("header.php");
include("sidebar.php");
$ayarsor = $db->prepare("select * from webcustomcontent where id=?");
$ayarsor->execute(array(1));
$ayarcek = $ayarsor->fetch(PDO::FETCH_ASSOC);
?>
    <div class="right_col" role="main">
        <div class="">
            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2><?=__c("Özel Sabit Site İçeriği")?> <small>,
                                    <?php
                                    if (@$_GET['durum'] == "ok") { ?>
                                        <b style="color:green;"><?= __c("İşlem Başarılı...") ?></b>
                                    <?php } elseif (@$_GET['durum'] == "no") { ?>
                                        <b style="color:red;"><?= __c("İşlem Başarısız...") ?></b>
                                    <?php }
                                    ?>
                                </small></h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <br />
                            <!-- / => en kök dizine çık ... ../ bir üst dizine çık -->
                            <form action="../baglan/islem.php" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="content_css"><?=__c("İÇERİK ÖZEL CSS")?>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea class="form-control" rows="6" id="content_css" name="content_css"  class="form-control col-md-7 col-xs-12"><?php echo $ayarcek['content_css'] ?></textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="content_start_body"><?=__c("İÇERİK ÖZEL BODY BAŞLANGIÇ")?>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea class="form-control" rows="6" id="content_start_body" name="content_start_body"  class="form-control col-md-7 col-xs-12"><?php echo $ayarcek['content_start_body'] ?></textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="content_end_body"><?=__c("İÇERİK ÖZEL BODY BİTİŞ")?>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea class="form-control" rows="6" id="content_end_body" name="content_end_body"  class="form-control col-md-7 col-xs-12"><?php echo $ayarcek['content_end_body'] ?></textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="content_js"><?=__c("İÇERİK ÖZEL JS")?>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea class="form-control" rows="6" id="content_js" name="content_js"  class="form-control col-md-7 col-xs-12"><?php echo $ayarcek['content_js'] ?></textarea>
                                    </div>
                                </div>

                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div align="right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                        <button type="submit" name="webcustomcontentkaydet" class="btn btn-success"><?=__c("Güncelle")?></button>
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
include("footer.php");
?>