<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package pricer
 */

get_header();
?>

        <section class="section1" id="section1">
            <div class="siteWidth">


                <?php
                if (is_archive()) {
                    the_archive_title( '<h1 class="title">', '</h1>' );
                    the_archive_description( '<div class="entry-meta">', '</div>' );
                }
                else {
                    echo '<h1 class="title">';
                    echo get_the_title( get_option('page_for_posts', true) );
                    echo "</h1>";

                    if ($excerpt = get_the_excerpt(get_option('page_for_posts', true))) {
                        echo '<div class="entry-meta">';
                        echo $excerpt;
                        echo "</div>";
                    }
                }


                ?>

		<?php if ( have_posts() ) : ?>

			<?php
			/* Start the Loop */

            echo "<div class=\"posts-list\">";
			while ( have_posts() ) :

				the_post();
				/*
				 * Include the Post-Type-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
				 */
				get_template_part( 'template-parts/card' );

			endwhile;
			echo "</div>";


			the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

            </div>
        </section>

<?php
//get_sidebar();
get_footer();
