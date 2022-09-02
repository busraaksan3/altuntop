<?php 
include 'header.php';
include ("sidebar.php");
$galerisor=$db->prepare("SELECT * FROM topluresim where urun_id=urun_id");
$galerisor->execute(array('urun_id' => $_GET['urun_id']));
$galericek=$galerisor->fetch(PDO::FETCH_ASSOC);
?>

<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
    </div>
    <div class="col-md-12">
      <div class="title_right">     
                  
              <a href="urun-galeri.php?urun_id=<?=$_GET['urun_id'];?> "><input type="button" class="btn btn-primary btn-xs" value="-">  </a>         
                
      </div>
    </div>


    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
            <div class="x_title">

              <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <div class="x_panel">
                    <div class="x_title">
                      <h2><?=__c("Çoklu resim yükleme işlemleri")?></h2>

                      <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                      <p><?=__c("Yüklenecek resimlerin bulunduğu klasöre giderek tamamını tek seferde seçerek yükleyebilirsiniz.")?></p>
                      <form action="../baglan/urun-galeri.php" class="dropzone">                        
                      <input type="hidden" name="urun_id" value="<?=$_GET['urun_id'];?>">
                      </form>
                     

                    </div>
                  </div>
                </div>
              </div>
            </div>



          </div>
        </div>
      </div>

    </div>
  </div>
</div>
</div>
<!-- /page content -->



<?php include 'footer.php'; ?>
