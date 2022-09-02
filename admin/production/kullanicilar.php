<?php
include("header.php");
include("sidebar.php");
$kullanicisor = $db->prepare("SELECT * FROM kullanici order by kullanici_id DESC");
$kullanicisor->execute();

$user = $db->prepare("SELECT * FROM kullanici WHERE kullanici_id=?");
$user->execute(array($_SESSION["kullanici_id"]));
?>
<div class="right_col" role="main">
  <div class="">
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2><?=__c("Kullanıcılar")?> <small>
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
              <a href="kullanici-ekle.php"><button class="btn btn-success btn-xs"> <?=__c("Yeni Ekle")?></button></a>
            </div>
          </div>
          <div class="x_content">
            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>ID</th>
                  <th><?=__c("Kullanıcı adı")?></th>
                  <th><?=__c("İsim")?></th>
                  <th><?=__c("Soyisim")?></th>
                  <th><?=__c("E-posta")?> </th>
                  <th><?=__c("Telefon")?> </th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <?php
                while ($kullanicicek = $kullanicisor->fetch(PDO::FETCH_ASSOC)) { ?>
                  <tr>
                    <td><?php echo $kullanicicek['kullanici_id'] ?></td>
                    <td><?php echo $kullanicicek['kullanici_ad'] ?></td>
                    <td><?php echo $kullanicicek['kullanici_isim'] ?></td>
                    <td><?php echo $kullanicicek['kullanici_soyisim'] ?></td>
                    <td><?php echo $kullanicicek['kullanici_mail'] ?></td>
                    <td><?php echo $kullanicicek['kullanici_gsm'] ?></td>


                    <td>
                      <center><a href="kullanici-duzenle.php?kullanici_id=<?php echo $kullanicicek['kullanici_id']; ?>"><button class="btn btn-primary btn-xs"><?=__c("Düzenle")?></button></a></center>
                      <center><a href="../baglan/islem.php?kullanici_id=<?php echo $kullanicicek['kullanici_id']; ?>&kullanicisil=ok"><button class="btn btn-danger btn-xs"><?=__c("Sil")?></button></a></center>
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