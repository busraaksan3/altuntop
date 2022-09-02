<?php
include("header.php");
include("sidebar.php");
$paketsor = $db->prepare("SELECT * FROM gal_kat order by kategori_idd DESC");
$paketsor->execute(); ?>
<div class="right_col" role="main">
    <div class="">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2><?=__c("Foto Albüm")?><small>
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

                            <a href="album-ekle.php">
                                <button class="btn btn-success btn-xs"> <?=__c("Yeni Ekle")?></button>
                            </a>
                        </div>
                        <div class="x_content">
                            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th><?=__c("Ad")?></th>
                                        <th><?=__c("Galeri")?></th>
                                        <th><?=__c("İşlemler")?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($paketsor as $paket) : ?>
                                        <tr>
                                            <td><?= $paket["kategori_idd"] ?></td>
                                            <td><?= __c($paket["ad"]) ?></td>
                                            <td>
                                                <center><a href="foto-galeri.php?kategori_idd=<?php echo $paket['kategori_idd']; ?>"><button class="btn btn-primary btn-xs"><?=__c("Galeri İşlemleri")?></button></a></center>
                                            </td>
                                            <td>
                                                <a href="../baglan/islem.php?kategori_idd=<?php echo $paket['kategori_idd']; ?>&albumsil=ok"><button class="btn btn-danger btn-xs"><?=__c("Sil")?></button></a>
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