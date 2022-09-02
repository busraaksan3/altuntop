<?php
include("header.php");
include("sidebar.php");
$ulkesor = $db->prepare("SELECT * FROM ulkeler order by ulke_id ASC");
$ulkesor->execute(); ?>
<div class="right_col" role="main">
    <div class="">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2><?= __c("Ülke Listeleme") ?> <small>
                                <?php
                                if (@$_GET['durum'] == "ok") { ?>
                                    <b style="color:green;"><?= __c("İşlem Başarılı...") ?></b>
                                <?php } elseif (@$_GET['durum'] == "no") { ?>
                                    <b style="color:red;"><?= __c("İşlem Başarısız...") ?></b>
                                <?php } ?>
                            </small></h2>
                        <div class="clearfix"></div>
                        <div align="right">
                            <a href="ulke-ekle.php"><button class="btn btn-success btn-xs"><?= __c("Yeni Ekle") ?></button></a>
                        </div>
                    </div>
                    <div class="x_content">
                        <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                <th><?= __c("Sıra") ?></th> 
                                <th><?= __c("Ülke Ad") ?></th> 

                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $say = 0;
                                while ($ulkecek = $ulkesor->fetch(PDO::FETCH_ASSOC)) {
                                    $say++ ?>
                                    <tr>
                                        <td width="20"><?php echo $say ?></td>
                                        <td><?php echo $ulkecek['name'] ?></td>

                                        <td>
                                            <center><a href="../baglan/islem.php?ulke_id=<?php echo $ulkecek['ulke_id']; ?>&ulkesil=ok"><button class="btn btn-danger btn-xs"><?=__c("Sil")?></button></a></center>
                                        </td>
                                    <?php  } ?>
                                    </tr>
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