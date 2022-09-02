<?php
include("header.php");
include("sidebar.php");
$dilsor = $db->prepare("SELECT * FROM diller order by sira ASC");
$dilsor->execute();
?>
<div class="right_col" role="main">
    <div class="">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2><?= __c("Dil Listeleme") ?> <small>

                                <?php
                                if (@$_GET['durum'] == "ok") { ?>
                                    <b style="color:green;"><?= __c("İşlem Başarılı...") ?></b>
                                <?php } elseif (@$_GET['durum'] == "no") { ?>
                                    <b style="color:red;"><?= __c("İşlem Başarısız...") ?></b>
                                <?php }
                                ?>
                            </small></h2>
                        <div class="clearfix"></div>
                        <div align="right">
                            <a href="dil-ekle.php"><button class="btn btn-success btn-xs"><?= __c("Yeni Ekle") ?></button></a>
                        </div>
                    </div>
                    <div class="x_content">
                        <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th><?= __c("Sıra") ?></th>
                                    <th><?= __c("Durum") ?></th>
                                    <th><?= __c("Ad") ?></th>
                                    <th><?= __c("Kod") ?> </th>
                                    <th><?= __c("Foto") ?></th>
                                    <th><?= __c("İşlemler") ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                while ($dilcek = $dilsor->fetch(PDO::FETCH_ASSOC)) { ?>
                                    <tr>
                                        <td width=20><?php echo __c($dilcek['sira']) ?></td>
                                        <td width=20><?php echo __c($dilcek['durum']) ?></td>
                                        <td><?php echo __c($dilcek['lang_name']) ?></td>
                                        <td><?php echo __c($dilcek['lang_code']) ?></td>
                                        <td><img style="width:32px;" src="../../<?php echo $dilcek['lang_icon'] ?>"></td>

                                        <td width=140>
                                            <a href="dil-duzenle.php?id=<?php echo $dilcek['id']; ?>"><button class="btn btn-primary btn-xs"><?= __c("Düzenle") ?></button></a>
                                            <a href="../baglan/islem.php?id=<?php echo $dilcek['id']; ?>&dilsil=ok"><button class="btn btn-danger btn-xs"><?= __c("Sil") ?></button></a>
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