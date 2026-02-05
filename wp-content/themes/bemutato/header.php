<?php
/**
 * A sablon fejléce (The Header)
 *
 * Ez tartalmazza a <head> részt, a <body> nyitó taget,
 * és a weboldal látható fejlécét (logó + menü).
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php
    // A LEGFONTOSABB SOR: Itt töltődik be minden stílus, script, SEO meta.
    // Ha ezt kihagyod, a pluginok 90%-a nem fog működni!
    wp_head();
    ?>
</head>

<body <?php body_class(); ?>>

<?php
// Modern WP szabvány (v5.2+): Pluginoknak kapu a body elejére (pl. Google Tag Manager)
wp_body_open();
?>

<div id="page" class="site">
    <a class="skip-link screen-reader-text" href="#primary">Ugrás a tartalomra</a>

    <header id="masthead" class="site-header">

        <div class="site-branding">
            <?php
            // Címsor vagy Logó kiírása
            if ( is_front_page() && is_home() ) :
                ?>
                <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
            <?php
            else :
                ?>
                <p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
            <?php
            endif;

            // Alcím (Tagline) megjelenítése
            $description = get_bloginfo( 'description', 'display' );
            if ( $description || is_customize_preview() ) :
                ?>
                <p class="site-description"><?php echo $description; ?></p>
            <?php endif; ?>
        </div><nav id="site-navigation" class="main-navigation">
            <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">Menü</button>
            <?php
            // A menü behúzása (ehhez majd kell a functions.php regisztráció!)
            wp_nav_menu(
                array(
                    'theme_location' => 'menu-1',
                    'menu_id'        => 'primary-menu',
                    'fallback_cb'    => false, // Ha nincs menü, ne jelenítsen meg listát
                )
            );
            ?>
        </nav>
    </header>