<?php
include ("header.php");
include ("sidebar.php");
$ceviriler = $db->query("SELECT * FROM ceviriler")->fetchAll();
$diller = $db->query("SELECT * FROM diller")->fetchAll();
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
                        <table class="table myDataTable table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th><?=__c("Çeviri Metni")?></th>
                                <?php foreach ($diller as $dil){ ?>
                                    <th>
                                        <img src="../../<?= $dil['lang_icon'] ?>" style="width: 32px !important;">
                                        <?= $dil['lang_name'] ?> [<?= $dil['lang_code'] ?>]
                                    </th>
                                <?php } ?>
                                <th><?=__c("İşlemler")?></th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($ceviriler as $ceviri){ ?>
                                    <tr>
                                   
                                        <td><?= $ceviri['ceviri_id'] ?></td>
                                        <td><?= substr($ceviri['string_key'],0,30) ?></td>
                                        <?php foreach ($diller as $dil){ ?>
                                            <?php
                                                $getTranslate = $db->query("SELECT * FROM translates WHERE ceviri_id = '{$ceviri['ceviri_id']}' AND lang_id = '{$dil['id']}' order by id DESC")->fetch(PDO::FETCH_ASSOC);
                                            ?>
                                            <th style="height:100px">
                                                <?php if(@$getTranslate['translate'] == null){
                                                    echo '<span class="badge badge-danger">Çeviri girilmemiş.</span>';
                                                }else{
                                                    echo substr($getTranslate['translate'],0,30);
                                                } ?>
                                            </th>
                                        <?php } ?>
                                        <td>
                                            <a href="translates_edit.php?ceviri_id=<?= $ceviri['ceviri_id'] ?>" class="btn btn-sm btn-primary"><?=__c("Düzenle")?></a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include ("footer.php");?>
