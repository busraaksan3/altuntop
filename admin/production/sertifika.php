<?php
include("header.php");
include("sidebar.php");
$sertsor = $db->prepare("SELECT * FROM sertifika order by sert_id DESC");
$sertsor->execute();
?>
<div class="right_col" role="main">
    <div class="">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2><?= __c("Sertifikalar") ?></h2><small>
                            <?php
                            if (@$_GET['durum'] == "ok") { ?>
                                <b style="color:green;"><?= __c("İşlem Başarılı...") ?></b>
                            <?php } elseif (@$_GET['durum'] == "no") { ?>
                                <b style="color:red;"><?= __c("İşlem Başarısız...") ?></b>
                            <?php } ?>
                        </small></h2>
                        <div class="clearfix"></div>
                        <div align="right">
                            <a href="sert-ekle.php"><button class="btn btn-success btn-xs"> <?= __c("Yeni Ekle") ?></button></a>
                        </div>
                    </div>
                    <div class="x_content">
                        <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                            <thead>
                                <tr>

                                <th><?= __c("Ad") ?></th>
                                <th><?= __c("Foto") ?></th>
                                    
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                while ($sertcek = $sertsor->fetch(PDO::FETCH_ASSOC)) { ?>

                                    <tr>

                                        <td><?php echo $sertcek['sert_ad'] ?></td>
                                        <td><img src="../../<?php echo $sertcek['sert_foto'] ?>" style="width:175px; height:100px;"></td>
                                        <td>
                                            <center><a href="sert-duzenle.php?sert_id=<?php echo $sertcek['sert_id']; ?>"><button class="btn btn-primary btn-xs"><?= __c("Düzenle") ?></button></a></center>
                                            <center><a href="../baglan/islem.php?sert_id=<?php echo $sertcek['sert_id']; ?>&sertifikasil=ok"><button class="btn btn-danger btn-xs"><?= __c("Sil") ?></button></a></center>
                                        </td>
                                    </tr>
                                <?php  }
                                ?>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include("footer.php"); ?>