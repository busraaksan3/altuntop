<?php
include("header.php");
include("sidebar.php");

$ulkesor = $db->prepare("SELECT * FROM ulkeler order by name ASC");
$ulkesor->execute();

$kullanicigetir = $db->prepare("SELECT * FROM kullanici");
$kullanicigetir->execute();

if (@$_GET['ulke_id']) {
    $ulketouser_get = $db->query("SELECT * FROM ulke_to_user WHERE ulke_id = '{$_GET['ulke_id']}'");
}

?>
<div class="right_col" role="main">
    <div class="">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2><?= __c("Ülkelere sorumlu çalışan atama işlemleri") ?></h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <p><?= __c("Hizmet verilen ülkelere atanacak kullanıcıların yönetimini aşağıdan sağlayabilirsiniz.. <br>
                            (Örn. Türkiye den gelen fiyat teklif formu hangi kullanıcılara gönderilmeli?)") ?>
                        </p> <br><br>
                        <?php if (@$_GET['message']) { ?>
                            <div class="row">
                                <div class="col-md-12">
                                    <?= showAlert(@$_GET['type'], $_GET['message']) ?>
                                </div>
                            </div>
                        <?php } ?>

                        <div class="row">
                            <div class="col-md-6">

                                <form method="GET">
                                    <div class="col-md-8">

                                        <div class="form-group">
                                            <span><?= __c("Ülkeler") ?></span> <br>
                                            <select name="ulke_id" class="form-control">
                                                <option value=""><?= __c("Seçiniz...") ?></option>
                                                <?php foreach ($ulkesor as $ulkecek) { ?>
                                                    <option value="<?= $ulkecek['ulke_id'] ?>" <?php if (@$_GET['ulke_id'] == $ulkecek['ulke_id']) {
                                                                                                    echo 'selected';
                                                                                                } ?>>
                                                        <?= $ulkecek['name'] ?>
                                                        (<?= getCountCountryForUser($db, $ulkecek['ulke_id']) ?>)
                                                    </option>
                                                <?php } ?>
                                            </select>
                                        </div>

                                    </div>
                                    <div class="col-md-4">
                                        <span></span> <br>
                                        <button type="submit" class="btn btn-primary" style="width: 100%;"><?= __c("SEÇ") ?></button>
                                    </div>
                                </form>

                            </div>
                            <?php if (@$_GET['ulke_id']) { ?>
                                <div class="col-md-6">

                                    <form action="../baglan/islem.php" method="POST">
                                        <input type="hidden" name="ulke_id" value="<?= @$_GET['ulke_id'] ?>">
                                        <div class="col-md-8">

                                            <div class="form-group">
                                                <span><?= __c("Kullanıcılar") ?></span> <br>
                                                <select name="kullanici_id" class="form-control">
                                                    <option value=""><?= __c("Seçiniz...") ?></option>
                                                    <?php foreach ($kullanicigetir as $v) { ?>
                                                        <option value="<?= $v['kullanici_id'] ?>">
                                                            @<?= $v['kullanici_ad'] ?>
                                                            <?= $v['kullanici_isim'] ?>
                                                            <?= $v['kullanici_soyisim'] ?>
                                                            [<?= $v['kullanici_mail'] ?>]
                                                        </option>
                                                    <?php } ?>
                                                </select>
                                            </div>

                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <span></span> <br>
                                                <button type="submit" name="ulke_to_user_add" style="width: 100%;" class="btn btn-success"><?= __c("EKLE") ?></button>
                                            </div>
                                        </div>
                                    </form>

                                    <?php if ($ulketouser_get) { ?>
                                        <table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                            <tr>
                                                <td><?= __c("Kullanıcı Adı") ?></td>
                                                <td><?= __c("İsim") ?></td>
                                                <td><?= __c("Soyisim") ?></td>
                                                <td><?= __c("E-posta") ?></td>
                                                <td><?= __c("İşlemler") ?></td>
                                            </tr>
                                            <?php foreach ($ulketouser_get as $item) { ?>
                                                <tr>
                                                    <td><?= getUser($db, $item['kullanici_id'])['kullanici_ad'] ?></td>
                                                    <td><?= getUser($db, $item['kullanici_id'])['kullanici_isim'] ?></td>
                                                    <td><?= getUser($db, $item['kullanici_id'])['kullanici_soyisim'] ?></td>
                                                    <td><?= getUser($db, $item['kullanici_id'])['kullanici_mail'] ?></td>
                                                    <td>
                                                        <a href="../baglan/islem.php?ulke_id=<?= $_GET['ulke_id'] ?>&delete_id=<?= $item['id'] ?>&ulke_to_user_sil=ok" class="btn btn-danger">
                                                            <?= __c("Sil") ?>
                                                        </a>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </table>
                                    <?php } ?>

                                </div>
                            <?php } ?>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include("footer.php"); ?>