<?php
include "header.php";
$menusor = $db->prepare("SELECT * FROM menu where menu_id=:id");
$menusor->execute(array("id" => $_GET['menu_id']));
$menucek = $menusor->fetch(PDO::FETCH_ASSOC); ?>
<!--Page Title-->
<section class="page-title centred" style="background-image: url(assets/images/background/page-title.jpg);">
    <div class="auto-container">
        <div class="content-box clearfix">
            <h1><?php echo __c($menucek['menu_ad']) ?></h1>
            <ul class="bread-crumb clearfix">
            <li><a href="index"><?= __c("Anasayfa")?></a></li>
                <li><?php echo __c($menucek['menu_ad']) ?></li>
            </ul>
        </div>
    </div>
</section>

<?php if ($menucek['menu_url'] == "urunler") { ?>
    <section class="feature-section">
        <div class="auto-container">
            <div class="col-lg-12 col-md-12 col-sm-12 content-column">
                <div id="content_block_three">
                    <div class="content-box"><br><br>

                        <div class="feature-section">

                            <div class="row clearfix">
                                
                                <?php $kategorisor = $db->prepare("SELECT * FROM kategori order by kategori_id ASC");
                                $kategorisor->execute();
                                while ($kategoricek = $kategorisor->fetch(PDO::FETCH_ASSOC)) { ?>
                                    <div class="col-lg-4 col-md-6 col-sm-12 feature-block">
                                        <div class="feature-block-one wow fadeInUp animated animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                                            <div class="inner-box">
                                                <figure class="image-box"> <a href="kategori-<?= $kategoricek['kategori_seourl'] . '-' . $kategoricek["kategori_id"] ?>"><img src="<?php echo $kategoricek['kategori_resim'] ?>" alt=""></a></figure>
                                                <div class="lower-content">
                                                    <div class="inner">
                                                        <h3><?php echo __c($kategoricek['kategori_ad']) ?></h3>
                                                        <a href="kategori-<?= $kategoricek['kategori_seourl'] . '-' . $kategoricek["kategori_id"] ?>"><span><?= __c("Daha Fazla")?></span><i class="fas fa-arrow-right"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
<?php } else if ($menucek['menu_url'] == "galeri") { ?>
    <section class="feature-section">
        <div class="auto-container">
            <div class="col-lg-12 col-md-12 col-sm-12 content-column">
                <div id="content_block_three">
                    <div class="content-box"><br><br>

                        <div class="feature-section">

                            <div class="row clearfix">
                               

                                <?php $kategorisor = $db->prepare("SELECT * FROM gal_kat order by kategori_idd ASC");
                                $kategorisor->execute();
                                while ($kategoricek = $kategorisor->fetch(PDO::FETCH_ASSOC)) { ?>
                                    <div class="col-lg-4 col-md-6 col-sm-12 feature-block">
                                        <div class="feature-block-one wow fadeInUp animated animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                                            <div class="inner-box">
                                                <figure class="image-box"> <a href="galeri-<?= $kategoricek['kat_url'] . '-' . $kategoricek["kategori_idd"] ?>"><img src="<?php echo $kategoricek['kategori_resim'] ?>" alt=""></a></figure>
                                                <div class="lower-content">
                                                    <div class="inner">
                                                        <h3><?php echo __c($kategoricek['ad']) ?></h3>
                                                        <a href="galeri-<?= $kategoricek['kat_url'] . '-' . $kategoricek["kategori_idd"] ?>"><span><?= __c("Daha Fazla")?></span><i class="fas fa-arrow-right"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
<?php } else if ($menucek['menu_url'] == "e-katalog") { ?>
    <section class="feature-section">
        <div class="auto-container">
            <div class="col-lg-12 col-md-12 col-sm-12 content-column">
                <div id="content_block_three">
                    <div class="content-box"><br><br>

                        <div class="feature-section">

                            <div class="row clearfix">
                                <?php
                                    $katalogsor = $db->prepare("SELECT * FROM katalog order by id ASC");
                                    $katalogsor->execute();
                                    ?> 
                                    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th><?= __c("Ad")?></th>
                                            <th><?= __c("Zaman")?></th>
                                            <th> </th>
                                           
                                           
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        while ($katalogcek = $katalogsor->fetch(PDO::FETCH_ASSOC)) { ?>
                                            <tr>
                                                <td><?php echo __c($katalogcek['ad']) ?></td>
                                                <td><?php echo $katalogcek['zaman'] ?></td>
                                                <td><a target="_blank" href="<?php echo $katalogcek['url'] ?>"><?= __c("Kataloğa Git")?> </a></td>
                                               

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
        </div>
    </section>
<?php } else if ($menucek['menu_url'] == "kariyer") { ?>
    <section class="contact-style-two">
        <div class="auto-container">
            <div class="row">
                <div class="col-xl-8 col-lg-12 col-md-12 inner-column">
                    <div class="sec-title right">
                        <h5 style="color:#666666!important;"><?= __c("İnsan Kaynakları Formu")?></h5>
                    </div>
                    <?php if (@$_GET['message']) { ?>
                        <?= showAlert(@$_GET['type'], $_GET['message']) ?>
                    <?php } ?>
                    <form method="post" action="mail.php" id="contact-form" class="default-form">
                        <input type="hidden" name="mail_type" value="kariyer">
                        <div class="row clearfix">
                            <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                <input type="text" name="name" placeholder="<?= __c("Adınız/Soyadınız")?>" required="">
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                <input type="email" name="email" placeholder="<?= __c("Email adresiniz")?>" required="">
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                <input type="text" name="phone" placeholder="<?= __c("Telefon numaranız")?>" required="">
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                <textarea name="message" placeholder="<?= __c("Varsa Mesajınız")?>"></textarea>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 form-group message-btn">
                                <button class="theme-btn style-one" type="submit" name="submit-form"><?= __c("gönder")?></button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-xl-4 col-lg-12 col-md-12">
                    <figure class="image"><img src="<?php echo $menucek['menu_resim']; ?>" alt=""></figure>
                </div>
            </div>
        </div>
    </section>
<?php } else {  ?>
    <section class="about-style-two about-page-1 bg-color-1">
        <div class="auto-container">
            <div class="row clearfix">
                <div class="col-lg-7 col-md-12 col-sm-12 content-column">
                    <div id="content_block_three">
                        <div class="content-box">
                            <div class="sec-title right">
                                <h5><?php echo __c($menucek['menu_ad']) ?></h5>
                            </div>
                            <div class="text">
                                <p> <?php echo __c($menucek['menu_icerik']) ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 col-md-12 col-sm-12 image-column">
                    <div id="image_block_two">
                        <div class="image-box">
                            <div class="pattern-layer" style="background-image: url(assets/images/shape/shape-25.png);"></div>
                            <figure class="image" style="height: 100%;"><img src="<?php echo $menucek['menu_resim']; ?>" alt=""></figure>
                        </div>
                    </div>
                </div>
            </div>
        </div><?php } ?>
    </section>
    <!-- about-style-two end -->
    <?php include "footer.php"; ?>