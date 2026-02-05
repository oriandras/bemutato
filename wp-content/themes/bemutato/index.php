<?php
/**
 * A fő sablonfájl (The Main Template File)
 *
 * Ez a legáltalánosabb sablon a WordPress hierarchiában.
 * A style.css mellett ez az EGYETLEN kötelező PHP fájl.
 */

get_header(); // 1. A HTML <head> és a menü betöltése
?>

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
get_footer(); // 3. A lábléc és a záró scriptek betöltése