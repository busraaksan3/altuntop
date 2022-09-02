<?php

function checkHizmetForUser($hizmet_id, $hizmet)
{

    $coz = json_decode($hizmet);

    if (@in_array($hizmet_id, $coz)) {
        return true;
    } else {
        return false;
    }
}

$sidebar_menu = array(
    array(
        "id" => 2,
        "name" => "Genel ayarlar",
        "icon" => "fa fa-cog",
        "subs" => array(
            array(
                "id" => 5,
                "name" => "Site ayarları",
                "url" => "site-ayar.php",
            ),
            array(
                "id" => 6,
                "name" => "Sosyal Medya",
                "url" => "sosyal-ayar.php",
            ),
            array(
                "id" => 7,
                "name" => "İletişim",
                "url" => "iletisim-ayarlar.php",
            ),
            array(
                "id" => 18,
                "name" => "Eposta Ayarları",
                "url" => "eposta-ayar.php",
            ),
            array(
                "id" => 20,
                "name" => "SMTP Ayarları",
                "url" => "smtp-ayar.php",
            ),
            array(
                "id" => 21,
                "name" => "Özel Sabit Site İçeriği",
                "url" => "content-edit.php",
            )
        )
    ),
    array(
        "id" => 3,
        "name" => "Menü",
        "icon" => "fa fa-list",
        "url" => "menu.php"
    ),
    array(
        "id" => 4,
        "name" => "Slider",
        "icon" => "fa fa-file-image-o",
        "url" => "slider.php"
    ),
    array(
        "id" => 9,
        "name" => "Ürünlerimiz",
        "icon" => "fa fa-inbox",
        "url" => "urunlerimiz.php"
    ),
    array(
        "id" => 10,
        "name" => "Sertifikalar",
        "icon" => "fa fa-file",
        "url" => "sertifika.php"
    ),
    array(
        "id" => 11,
        "name" => "Foto Galeri",
        "icon" => "fa fa-image",
        "url" => "fotogalerimiz.php"
    ),
    array(
        "id" => 12,
        "name" => "Log",
        "icon" => "fa fa-cogs",
        "url" => "yonetim.php"
    ),
    array(
        "id" => 13,
        "name" => "Panel Kullanıcıları",
        "icon" => "fa fa-paw",
        "url" => "kullanicilar.php"
    ),
    array(
        "id" => 14,
        "name" => "Dil",
        "icon" => "fa fa-comments-o",
        "url" => "dil.php"
    ),
    array(
        "id" => 15,
        "name" => "Müşteri Yorumları",
        "icon" => "fa fa-group",
        "url" => "musteriyorum.php"

    ),
    array(
        "id" => 16,
        "name" => "Katalog",
        "icon" => "fa fa-newspaper-o",
        "url" => "katalog.php"
    ),
    array(
        "id" => 17,
        "name" => "Ülke",
        "icon" => "fa fa-globe",
        "url" => "ulke.php"
    ),
    array(
        "id" => 18,
        "name" => "Ülke Sorumluları",
        "icon" => "fa fa-group",
        "url" => "ulke_to_user.php"
    ),
    array(
        "id" => 19,
        "name" => "Çeviriler",
        "icon" => "fa fa-comments-o",
        "url" => "translates.php"
    )



    // en son id = 21

);
