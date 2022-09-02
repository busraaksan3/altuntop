<?php
include("header.php");
include("sidebar.php");
$slidersor = $db->prepare("SELECT * FROM slider order by slider_sira ASC");
$slidersor->execute();
?>
<div class="right_col" role="main">
  <div class="">
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2><?= __c("Slider Listeleme") ?> <small>
                <?php
                if (@$_GET['durum'] == "ok") { ?>
                  <b style="color:green;"><?= __c("İşlem Başarılı...") ?></b>
                <?php } elseif (@$_GET['durum'] == "no") { ?>
                  <b style="color:red;"><?= __c("İşlem Başarısız...") ?></b>
                <?php } ?>
              </small></h2>
            <div class="clearfix"></div>
            <div align="right">
              <a href="slider-ekle.php"><button class="btn btn-success btn-xs"><?= __c("Yeni Ekle") ?></button></a>
            </div>
          </div>
          <div class="x_content">
            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th><?= __c("Sıra") ?></th>                  
                  <th><?= __c("Başlık") ?></th>
                  <th><?= __c("Küçük Yazı") ?></th>
                  <th><?= __c("Foto") ?></th>

                  <th>Ayar</th>
                </tr>
              </thead>
              <tbody>
                <?php
                while ($slidercek = $slidersor->fetch(PDO::FETCH_ASSOC)) { ?>
                  <tr>
                    <td><?php echo $slidercek['slider_sira'] ?></td>                   
                    <td><?php echo __c($slidercek['slider_h']) ?></td>
                    <td><?php echo __c($slidercek['slider_p']) ?></td>
                    <td><img style="width:175px; height:100px; " src="../../<?php echo $slidercek['slider_resimyol'] ?>"></td>

                    <td>
                      <center><a href="slider-duzenle.php?slider_id=<?php echo $slidercek['slider_id']; ?>"><button class="btn btn-primary btn-xs"><?= __c("Düzenle") ?></button></a></center>
                      <center><a href="../baglan/islem.php?slider_id=<?php echo $slidercek['slider_id']; ?>&slidersil=ok"><button class="btn btn-danger btn-xs"><?= __c("Sil") ?></button></a></center>
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