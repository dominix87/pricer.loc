<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package pricer
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<?php
		if ( is_singular() ) :
			the_title( '<h1 class="title">', '</h1>' );
		else :
			the_title( '<h2 class="title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;

		if ( 'post' === get_post_type() ) :
			?>
			<div class="entry-meta">
				<?php
				gs_pricer_posted_on();
				gs_pricer_posted_by();
				?>
			</div><!-- .entry-meta -->
		<?php endif; ?>

	<?php // pricer_post_thumbnail(); ?>

	<div class="content_text blog_text">
		<?php

        if (get_post_meta(get_the_ID(), "_elementor_edit_mode", true  )) {
            if (isset($_GET["elementor-preview"])) {
                the_content();
            }
            else {
                echo gs_content_modify(apply_filters( 'the_content', get_the_content()));
            }
        }
        else {
            echo gs_content_modify(apply_filters( 'the_content', get_the_content()));
        }

/*
		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'pricer' ),
				'after'  => '</div>',
			)
		);
*/
		?>
	</div><!-- .entry-content -->
<?php /* ?>
	<footer class="entry-footer">
		<?php pricer_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</php /* */ ?>

</article><!-- #post-<?php the_ID(); ?> -->
