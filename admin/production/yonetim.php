<?php
include("header.php");
include("sidebar.php");
$user = $db->prepare("SELECT * FROM kullanici WHERE kullanici_id=?");
$user->execute(array($_SESSION["kullanici_id"]));
$sor = $db->prepare("SELECT * FROM logs order by id DESC");
$sor->execute();
?>
<div class="right_col" role="main">
  <div class="">
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th><?= __c("Sıra") ?></th>
                  <th><?= __c("Olay") ?></th>
                  <th><?= __c("Detay") ?></th>
                  <th><?= __c("Zaman") ?></th>
                  <th><?= __c("Yapan") ?></th>
                  <th>IP</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $say = 0;
                while ($cek = $sor->fetch(PDO::FETCH_ASSOC)) {
                  $say++ ?>
                  <tr>
                    <td width="20"><?php echo $say ?></td>
                    <td><?php echo __c($cek['transaction']) ?></td>
                    <td><?php echo __c($cek['detail']) ?></td>
                    <td><?php echo $cek['created_at'] ?></td>                   
                    <td><?php echo $cek['kullanici_id'] ?></td>
                    <td><?php $ip_address = $_SERVER['REMOTE_ADDR'];
                        echo $ip_address; ?></td>
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