<?php
include("header.php");
include("sidebar.php");
$kategorisor = $db->prepare("SELECT * FROM kategori order by kategori_id ASC");
$kategorisor->execute();
?>
<div class="right_col" role="main">
    <div class="">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2><?= __c("Kategoriler") ?> <small>
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
                            <a href="kategori-ekle.php"><button class="btn btn-success btn-xs"><?= __c("Yeni Ekle") ?></button></a>
                        </div>
                    </div>
                    <div class="x_content">
                        <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th><?= __c("Sıra No") ?></th>
                                    <th><?= __c("Ad") ?></th>
                                    <th><?= __c("Url") ?> </th>
                                    <th><?= __c("Foto") ?></th>
                                    <th><?= __c("İşlemler") ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $say = 0;
                                while ($kategoricek = $kategorisor->fetch(PDO::FETCH_ASSOC)) {
                                    $say++ ?>
                                    <tr>
                                        <td width="20"><?php echo $say ?></td>
                                        <td><?php echo __c($kategoricek['kategori_ad']) ?></td>
                                        <td><?php echo $kategoricek['kategori_seourl'] ?></td>
                                        <td><img src="../../<?php echo $kategoricek['kategori_resim'] ?>" style="width:175px; height:100px;"></td>
                                        <td>
                                            <center><a href="kategori-duzenle.php?kategori_id=<?php echo $kategoricek['kategori_id']; ?>"><button class="btn btn-primary btn-xs"><?= __c("Düzenle") ?></button></a></center>
                                            <center><a href="../baglan/islem.php?kategori_id=<?php echo $kategoricek['kategori_id']; ?>&kategorisil=ok"><button class="btn btn-danger btn-xs"><?= __c("Sil") ?></button></a></center>
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