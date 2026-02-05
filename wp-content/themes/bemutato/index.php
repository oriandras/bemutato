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
        </nav></header>

    <main id="primary" class="site-main">

        <?php
        // 2. A híres WordPress LOOP indítása
        if ( have_posts() ) :

            while ( have_posts() ) :
                the_post(); // Beállítja a globális $post változót az aktuális tartalomra
                ?>

                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                    <header class="entry-header">
                        <?php
                        // Ha egyedülálló bejegyzést nézünk, H1 a cím, ha listát, akkor H2 linkkel
                        if ( is_singular() ) :
                            the_title( '<h1 class="entry-title">', '</h1>' );
                        else :
                            the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '">', '</a></h2>' );
                        endif;
                        ?>
                    </header>

                    <div class="entry-content">
                        <?php
                        // A tartalom megjelenítése
                        the_content( 'Tovább olvasom...' );
                        ?>
                    </div>

                </article>

            <?php
            endwhile;

            // Lapozó (opcionális, de ajánlott az alapokhoz is)
            the_posts_navigation();

        else :

            // Fallback: Ha nincs találat (pl. üres keresés)
            echo '<p>Sajnáljuk, nem található tartalom.</p>';

        endif;
        ?>

    </main>

    <?php
    /**
     * A sablon lábléce (The Footer)
     *
     * Bezárja a #content és a #page div-eket,
     * valamint a <body> és a <html> tageket.
     */
    ?>

    <footer id="colophon" class="site-footer">
        <div class="site-info">
            <?php
            /*
             * Automatikus Copyright dátum és az oldal neve.
             * A date('Y') mindig az aktuális évet adja vissza, így nem kell évente átírni.
             */
            ?>
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                &copy; <?php echo date( 'Y' ); ?> <?php bloginfo( 'name' ); ?>
            </a>

            <span class="sep"> | </span>

            <?php
            /*
             * Hagyományos "Powered by" link - fejlesztői etikett meghagyni,
             * de üzleti oldalaknál általában ezt vesszük ki először.
             */
            ?>
            <a href="<?php echo esc_url( __( 'https://wordpress.org/', 'sajat-alap' ) ); ?>">
                Büszkén a WordPress használatával
            </a>
        </div></footer></div><?php
// A MÁSIK LEGFONTOSABB SOR:
// Itt töltődnek be a footerbe szánt scriptek (pl. Google Analytics, egyedi JS fájlok).
// Ez jeleníti meg a felső Admin Bar-t is bejelentkezett felhasználóknak!
wp_footer();
?>

</body>
</html>