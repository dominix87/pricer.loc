<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package pricer
 */

get_header();
?>

<?php /* ?>
	<main id="primary" class="site-main">
        <?php /* */ ?>
        <section class="section1" id="section1">
            <div class="siteWidth">
                <?php
                while ( have_posts() ) :
                    the_post();

                    get_template_part( 'template-parts/content', get_post_type() );
/*
                    the_post_navigation(
                        array(
                            'prev_text' => '<span class="nav-subtitle">' . esc_html__( 'Previous:', 'pricer' ) . '</span> <span class="nav-title">%title</span>',
                            'next_text' => '<span class="nav-subtitle">' . esc_html__( 'Next:', 'pricer' ) . '</span> <span class="nav-title">%title</span>',
                        )
                    );

                    // If comments are open or we have at least one comment, load up the comment template.
                    if ( comments_open() || get_comments_number() ) :
                        comments_template();
                    endif;
*/
                endwhile; // End of the loop.

                ?>

            </div>
        </section>
<?php /*  ?>
	</main><!-- #main -->
<?php /* */ ?>
<?php
// get_sidebar();
get_footer();
