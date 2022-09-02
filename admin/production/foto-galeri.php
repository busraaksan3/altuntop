<?php
include("header.php");
include("sidebar.php");
?>
<div class="right_col" role="main">
    <div class="">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2><?=__c("Galeri")?> <small>
                                <?php
                                if (@$_GET['durum'] == "ok") { ?>
                                    <b style="color:green;"><?= __c("İşlem Başarılı...") ?></b>
                                <?php } elseif (@$_GET['durum'] == "no") { ?>
                                    <b style="color:red;"><?= __c("İşlem Başarısız...") ?></b>
                                <?php }
                                ?>
                            </small></h2>
                        <form action="../baglan/foto-galeri.php" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="kategori_idd" value="<?php echo $_GET['kategori_idd']; ?>">
                            <div align="right" class="col-md-6">
                                <button type="submit" name="fotogalerisil" class="btn btn-danger "><i class="fa fa-trash" aria-hidden="true"></i> <?=__c("Seçilenleri Sil")?></button>
                                <a class="btn btn-success" href="foto-galeri-yukle.php?kategori_idd=<?php echo $_GET['kategori_idd']; ?>"><i class="fa fa-plus" aria-hidden="true"></i><?=__c("Fotoğraf Yükle")?></a>
                            </div>
                            <div class="clearfix"></div>
                    </div>


                    <div class="x_content">


                        <?php

                        $sayfada = 25; // sayfada gösterilecek içerik miktarını belirtiyoruz.


                        $sorgu = $db->prepare("select * from foto_galeri");
                        $sorgu->execute();
                        $toplam_urunfoto = $sorgu->rowCount();

                        $toplam_sayfa = ceil($toplam_urunfoto / $sayfada);

                        // eğer sayfa girilmemişse 1 varsayalım.
                        $sayfa = isset($_GET['sayfa']) ? (int) $_GET['sayfa'] : 1;

                        // eğer 1'den küçük bir sayfa sayısı girildiyse 1 yapalım.
                        if ($sayfa < 1) $sayfa = 1;

                        // toplam sayfa sayımızdan fazla yazılırsa en son sayfayı varsayalım.
                        if ($sayfa > $toplam_sayfa) $sayfa = $toplam_sayfa;

                        $limit = ($sayfa - 1) * $sayfada;

                        $urunfotosor = $db->prepare("select * from foto_galeri where kategori_idd=:kategori_idd order by foto_id DESC limit $limit,$sayfada");
                        $urunfotosor->execute(array(
                            'kategori_idd' => $_GET['kategori_idd']
                        ));

                        while ($urunfotocek = $urunfotosor->fetch(PDO::FETCH_ASSOC)) { ?>



                            <div class="col-md-55">
                                <label>
                                    <div class="image view view-first">
                                        <img style="width: 250px; height: 100px; display: block;" src="../../<?php echo $urunfotocek['foto']; ?>" alt="image" />
                                        <div class="mask">
                                            <p><?php echo $urunfotocek['foto_id']; ?></p>
                                            <div class="tools tools-bottom">

                                                <!--<a href="#"><i class="fa fa-times"></i></a>-->

                                            </div>

                                        </div>

                                    </div>

                                    <?php @array("$urunfotosec"); ?>


                                    <input type="checkbox" name="urunfotosec[]" value="<?php echo $urunfotocek['foto_id']; ?>"> Seç
                                </label>


                            </div>

                        <?php } ?>

                        <div align="right" class="col-md-12">
                            <ul class="pagination">

                                <?php

                                $s = 0;

                                while ($s < $toplam_sayfa) {

                                    $s++; ?>

                                    <?php

                                    if ($s == $sayfa) { ?>

                                        <li class="active">

                                            <a href="foto-galeri.php?sayfa=<?php echo $s; ?>"><?php echo $s; ?></a>

                                        </li>

                                    <?php } else { ?>


                                        <li>

                                            <a href="foto-galeri.php?sayfa=<?php echo $s; ?>"><?php echo $s; ?></a>

                                        </li>

                                <?php   }
                                }

                                ?>

                            </ul>
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