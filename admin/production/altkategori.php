<?php
include("header.php");
include("sidebar.php");
$kategorisor = $db->prepare("SELECT * FROM alt_kategori order by id ASC");
$kategorisor->execute();
?>
<div class="right_col" role="main">
    <div class="">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2><?= __c("Alt Kategoriler") ?> <small>
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
                            <a href="alt-kategori-ekle.php"><button class="btn btn-success btn-xs"><?= __c("Yeni Ekle") ?></button></a>
                        </div>
                    </div>
                    <div class="x_content">
                        <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th><?= __c("ID") ?></th>
                                    <th><?= __c("Ad") ?></th>
                                   
                                    <th><?= __c("Url") ?> </th>                                    
                                    <th><?= __c("İşlemler") ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                
                                while ($kategoricek = $kategorisor->fetch(PDO::FETCH_ASSOC)) {
                                    ?>
                                    <tr>
                                        <td width="20"><?php echo  $kategoricek['id'] ?></td>
                                        <td><?php echo __c($kategoricek['ad']) ?></td>
                                       
                                        <td><?php echo $kategoricek['seourl'] ?></td>                                       
                                        <td>
                                            <center><a href="alt-kategori-duzenle.php?id=<?php echo $kategoricek['id']; ?>"><button class="btn btn-primary btn-xs"><?= __c("Düzenle") ?></button></a></center>
                                            <center><a href="../baglan/islem.php?id=<?php echo $kategoricek['id']; ?>&altkategorisil=ok"><button class="btn btn-danger btn-xs"><?= __c("Sil") ?></button></a></center>
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