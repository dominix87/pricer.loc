<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package pricer
 */

get_header();
?>
	<main id="primary">
		<section class="error-404 not-found error_page_section">

            <div class="error-header">
                <h1>404</h1>
                <p><?php echo pll__("Sorry, the specified page was not found"); ?></p>
            </div>
            <div class="error-image">
                <img src="/wp-content/themes/pricer/assets/img/svg/404.svg">
            </div>

		</section><!-- .error-404 -->

	</main><!-- #main -->

<?php
get_footer();
