<?php
include ("header.php");
include ("sidebar.php");
$ayarsor=$db->prepare("select * from ayar where ayar_id=?");
$ayarsor->execute(array(0));
$ayarcek=$ayarsor->fetch(PDO::FETCH_ASSOC);

?>

<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3><?= __c("Ayarlar") ?></h3>
            </div>

            <!-- <div class="title_right">
               <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                 <div class="input-group">
                   <input type="text" class="form-control" placeholder="Anahtar Kelimeniz...">
                   <span class="input-group-btn">
                     <button class="btn btn-default" type="button">Ara!</button>
                   </span>
                 </div>
               </div>
             </div>-->
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2><?= __c("Smtp Mail Ayarları") ?> <small>
                                    <?php
                                    if (@$_GET['durum']=='ok') {?>

                                        <b style="color:green;"><?= __c("Güncelleme başarılı...") ?></b>

                                    <?php } elseif (@$_GET['durum']=='no')  {?>

                                        <b style="color:red;"><?= __c("Güncelleme yapılamadı...") ?></b>

                                    <?php } ?></small> </h2>
                            <ul class="nav navbar-right panel_toolbox">




                            </ul>
                            <div class="clearfix"></div>
                        </div>

                        <div class="x_content">

                            <form action="../baglan/islem.php" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ayar_smtphost"><?= __c("SMTP HOST") ?><span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="ayar_smtphost" name="ayar_smtphost" value="<?php echo $ayarcek['ayar_smtphost']; ?>" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ayar_smtpfromname"><?= __c("SMTP FROM NAME") ?><span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="ayar_smtpfromname" name="ayar_smtpfromname" value="<?php echo $ayarcek['ayar_smtpfromname']; ?>" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ayar_smtpuser"><?= __c("SMTP USERNAME") ?><span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="ayar_smtpuser" name="ayar_smtpuser" value="<?php echo $ayarcek['ayar_smtpuser']; ?>" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ayar_smtppassword"><?= __c("SMTP PASSWORD") ?><span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="password" id="ayar_smtppassword" name="ayar_smtppassword" value="<?php echo $ayarcek['ayar_smtppassword']; ?>" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ayar_smtpport"><?= __c("SMTP PORT") ?><span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="ayar_smtpport" name="ayar_smtpport" value="<?php echo $ayarcek['ayar_smtpport']; ?>" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>


                                <div align="right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                    <button type="submit" name="mailayarkaydet" class="btn btn-primary"><?= __c("Güncelle") ?></button>
                                </div>

                            </form>



                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- /page content -->



<?php include 'footer.php'; ?>
