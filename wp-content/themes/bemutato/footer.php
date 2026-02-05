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
        <a href="<?php echo esc_url( __( 'https://wordpress.org/', 'bemutato' ) ); ?>">
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