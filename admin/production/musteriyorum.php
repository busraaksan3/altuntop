<?php
include("header.php");
include("sidebar.php");
$dilsor = $db->prepare("SELECT * FROM musteriyorum order by id ASC");
$dilsor->execute();
?>
<div class="right_col" role="main">
    <div class="">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2><?=__c("Müşteri Yorum Listeleme ")?><small>
                                <?php if (@$_GET['durum'] == "ok") { ?>
                                    <b style="color:green;"><?= __c("İşlem Başarılı...") ?></b>
                                <?php } elseif (@$_GET['durum'] == "no") { ?>
                                    <b style="color:red;"><?= __c("İşlem Başarısız...") ?></b>
                                <?php } ?>

                            </small></h2>
                        <div class="clearfix"></div>
                        <div align="right">
                            <a href="yorum-ekle.php"><button class="btn btn-success btn-xs"><?= __c("Yeni Ekle") ?> </button></a>
                        </div>
                    </div>
                    <div class="x_content">
                        <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th><?= __c("Müşteri Adı") ?></th>
                                    <th><?= __c("Foto") ?> </th>
                                    <th><?= __c("İçerik") ?></th>
                                    <th><?= __c("İşlemler") ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                while ($dilcek = $dilsor->fetch(PDO::FETCH_ASSOC)) { ?>
                                    <tr>
                                        <td><?php echo $dilcek['ad_soyad'] ?></td>
                                        <td><img style="width:50px;" src="../../<?php echo $dilcek['foto'] ?>"></td>
                                        <td><?php echo substr($dilcek['icerik'], 0, 90) ?></td>
                                        <td>
                                            <center><a href="yorum-duzenle.php?id=<?php echo $dilcek['id']; ?>"><button class="btn btn-primary btn-xs"><?= __c("Düzenle") ?></button></a></center>
                                            <center><a href="../baglan/islem.php?id=<?php echo $dilcek['id']; ?>&yorumsil=ok"><button class="btn btn-danger btn-xs"><?= __c("Sil") ?></button></a></center>
                                        </td>
                                    </tr>
                                <?php  } ?>
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