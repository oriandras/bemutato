<?php
/**
 * A sablon funkciói és definíciói
 *
 * Ez a fájl úgy működik, mint egy beépített plugin.
 * Minden oldalletöltés előtt lefut, mielőtt a HTML generálódna.
 */

/* -------------------------------------------------------------------------- */
/* 1. ADMIN BAR KORLÁTOZÁS
/* -------------------------------------------------------------------------- */

/**
 * Admin sáv elrejtése mindenki elől, aki NEM Szerkesztő vagy Adminisztrátor.
 * * Miért csináljuk?
 * Mert a mezei látogatónak vagy a feliratkozónak semmi köze a backendhez.
 * Az admin bar "megtöri a negyedik falat", kizökkenti a felhasználót a design élményből.
 */
function sajat_admin_bar_szures( $show ) {
    // A 'edit_others_posts' jogkörrel csak a Szerkesztők és az Adminok rendelkeznek.
    // A Szerzők (Author) és Feliratkozók (Subscriber) nem.
    if ( ! current_user_can( 'edit_others_posts' ) ) {
        return false;
    }

    // Ha admin vagy szerkesztő, visszaadjuk az eredeti beállítást (ami true)
    return $show;
}
add_filter( 'show_admin_bar', 'sajat_admin_bar_szures' );


/* -------------------------------------------------------------------------- */
/* 2. ALAP BEÁLLÍTÁSOK (Setup)
/* -------------------------------------------------------------------------- */

function sajat_sablon_setup() {
    // Engedélyezzük, hogy a WP kezelje a <title> taget a head-ben (SEO alap)
    add_theme_support( 'title-tag' );

    // Engedélyezzük a kiemelt képeket (Post Thumbnails) a bejegyzéseknél
    add_theme_support( 'post-thumbnails' );

    // Regisztráljuk a menü helyét, amit a header.php-ban hívtunk meg ('menu-1')
    register_nav_menus(
        array(
            'menu-1' => 'Fődleges Fejléc Menü',
        )
    );
}
// Ezt az 'after_setup_theme' hook-ra akasztjuk, tehát a téma inicializálása után fut le
add_action( 'after_setup_theme', 'sajat_sablon_setup' );


/* -------------------------------------------------------------------------- */
/* 3. STÍLUSOK ÉS SCRIPTEK BETÖLTÉSE (Enqueue)
/* -------------------------------------------------------------------------- */

function sajat_sablon_stilusok() {
    // A style.css betöltése.
    // A get_stylesheet_uri() automatikusan visszaadja a style.css pontos URL-jét.
    // A 'wp_enqueue_scripts' hook gondoskodik arról, hogy ez a <head>-be kerüljön.
    wp_enqueue_style( 'sajat-alap-style', get_stylesheet_uri() );
}
add_action( 'wp_enqueue_scripts', 'sajat_sablon_stilusok' );

?>