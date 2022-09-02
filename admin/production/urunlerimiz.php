<?php
include("header.php");
include("sidebar.php");
$paketsor = $db->prepare("SELECT * FROM urun order by urun_id DESC");
$paketsor->execute(); ?>
<div class="right_col" role="main">
    <div class="">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2><?= __c("Ürün Listeleme") ?> <small>
                                <?php
                                if (@$_GET['durum'] == "ok") { ?>
                                    <b style="color:green;"><?= __c("İşlem Başarılı...") ?></b>
                                <?php } elseif (@$_GET['durum'] == "no") { ?>
                                    <b style="color:red;"><?= __c("İşlem Başarısız...") ?></b>
                                <?php } ?>
                            </small></h2>
                        <div class="clearfix"></div>
                        <div align="right">
                            <a href="kategori.php">
                                <button class="btn btn-warning "> <?= __c("Kategori Ayarları") ?></button>
                            </a>
                            <a href="urun-ekle.php">
                                <button class="btn btn-success"> <?= __c("Yeni ürün ekle") ?></button>
                            </a>
                            <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-left top_search ">
                                <form method="post" action="urun-ara.php">
                                    <div class="input-group">
                                        <input type="search" class="form-control" name="aranan" placeholder="<?=__c("Ürün Ara")?>">
                                        <span class="input-group-btn">
                                            <input type="submit" value="<?= __c("Ara!") ?>" class="btn btn-default" name="arama">
                                        </span>
                                    </div>
                                </form>
                            </div>
                        </div> <br>
                    </div>
                    <div class="x_content">
                        <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th><?=__c("Ad")?></th>
                                    <th><?=__c("Kod")?></th>
                                    <th><?=__c("İçerik")?></th>
                                    <th><?=__c("Galeri")?></th>
                                    <th><?=__c("İşlemler")?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($paketsor as $paket) : ?>
                                    <tr>
                                        <td><?= $paket["urun_id"] ?></td>
                                        <td><?= $paket["urun_ad"] ?></td>
                                        <td><?= $paket["urun_kod"] ?></td>
                                        <td><?= substr($paket["urun_aciklama"], 0, 90) ?></td>
                                        <td>
                                            <center><a href="urun-galeri.php?urun_id=<?php echo $paket['urun_id']; ?>"><button class="btn btn-primary btn-xs"><?=__c("Galeri İşlemleri")?></button></a></center>
                                        </td>
                                        <td><a href="urun-duzenle.php?urun_id=<?php echo $paket['urun_id']; ?>"><button class="btn btn-primary btn-xs"><?=__c("Düzenle")?></button></a>
                                            <a href="../baglan/islem.php?urun_id=<?php echo $paket['urun_id']; ?>&urunsil=ok"><button class="btn btn-danger btn-xs"><?=__c("Sil")?></button></a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
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