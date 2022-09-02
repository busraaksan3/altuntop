<?php include("config/menu.php");
$diller = $db->query("SELECT * FROM diller")->fetchAll(); ?>

<!-- sidebar menu -->
<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
  <div class="menu_section">
    <h3><?= __c("Genel") ?></h3>
    <ul class="nav side-menu">
      <li><a href="index.php"><i class="fa fa-home"></i><?= __c("Anasayfa") ?></a></li>
      <?php foreach ($sidebar_menu as $menu) { ?>
        <?php if (checkHizmetForUser($menu['id'], $_SESSION['hizmet'])) { ?>
          <?php if (@count($menu['subs']) > 0) { ?>
            <li><a><i class="<?php echo $menu['icon']; ?>"></i> <?php echo __c($menu['name']); ?> <span class="fa fa-chevron-down"></span></a>
              <ul class="nav child_menu">
                <?php foreach ($menu['subs'] as $sub) { ?>
                  <li><a href="<?php echo $sub['url']; ?>"><?php echo __c($sub['name']); ?></a></li>
                <?php } ?>
              </ul>
            </li>
          <?php } else { ?>
            <li><a href="<?php echo $menu['url']; ?>"><i class="<?php echo $menu['icon']; ?>"></i> <?php echo __c($menu['name']); ?></a></li>
          <?php } ?>
        <?php } ?>
      <?php } ?>
  </div>
</div>

</div>
</div>
<!-- top navigation -->
<div class="top_nav">
  <div class="nav_menu">
    <nav>
      <div class="nav toggle">
        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
      </div>


      <ul class="nav navbar-nav navbar-right">
        <li class="">
          <a href="logout.php"><?= __c("Çıkış") ?><i class="fa fa-sign-out pull-right"></i></a>
        </li>



        <li class="">
          <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
            <i class="fa fa-globe"></i>
            <span class=" fa fa-angle-down"></span>
          </a>
          <ul class="dropdown-menu dropdown-usermenu pull-right">
            <?php foreach ($diller as $dil) { ?>
              <li><a href="../../dil_degistir.php?lang=<?= $dil['lang_code'] ?>"> <img src="../../<?= $dil['lang_icon'] ?>" style="width: 22px !important;"> <?= __c($dil['lang_name']) ?></a></li>

            <?php } ?>
          </ul>
        </li>
      </ul>
    </nav>
  </div>
</div>
<!-- /top navigation -->