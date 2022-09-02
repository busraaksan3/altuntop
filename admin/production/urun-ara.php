<?php
include("header.php");
include("sidebar.php");
if (isset($_POST['arama'])) {
    $aranan = $_POST['aranan'];
    $urunsor = $db->prepare("SELECT * FROM urun where urun_ad LIKE ?");
    $urunsor->execute(array("%$aranan%"));
    $say = $urunsor->rowCount();
} else {
    Header("Location:index.php?durum=bos");
}
if ($say == 0) {
    echo "Bu kategoride ürün bulunamadı";
} ?>
<div class="right_col" role="main">
    <div class="">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Ürün Arama </h2>
                        <div class="clearfix"></div>
                        <div align="right">
                            <a href="kategori.php">
                                <button class="btn btn-warning btn-xs"> Kategori Ayarları</button>
                            </a>
                            <a href="urun-ekle.php">
                                <button class="btn btn-success btn-xs"> Yeni Ürün Ekle</button>
                            </a>
                        </div>
                        <div class="x_content">
                            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Ad</th>
                                        <th>Kod</th>
                                        <th>İçerik</th>
                                        <th>Galeri</th>
                                        <th>Ayar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                   
                                    foreach ($urunsor as $uruncek) : ?>
                                        <tr>
                                            <td><?= $uruncek["urun_id"] ?></td>
                                            <td><?= $uruncek["urun_ad"] ?></td>
                                            <td><?= $uruncek["urun_kod"] ?></td>
                                            <td><?= substr($uruncek["urun_aciklama"], 0, 90) ?></td>
                                            <td>
                                                <center><a href="urun-galeri.php?urun_id=<?php echo $uruncek['urun_id']; ?>"><button class="btn btn-primary btn-xs">Galeri İşlemleri</button></a></center>
                                            </td>
                                            <td><a href="urun-duzenle.php?urun_id=<?php echo $uruncek['urun_id']; ?>"><button class="btn btn-primary btn-xs">Düzenle</button></a>
                                                <a href="../baglan/islem.php?urun_id=<?php echo $uruncek['urun_id']; ?>&urunsil=ok"><button class="btn btn-danger btn-xs">Sil</button></a>
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