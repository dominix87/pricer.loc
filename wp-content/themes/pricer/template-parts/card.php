
<article id="post-<?php the_ID(); ?>" class="post-card">
		<?php
        if ( has_post_thumbnail()) {
            echo "<a href=\"" . esc_url( get_permalink() ) . "\">";
            the_post_thumbnail('card', array('class' => 'card-image'));
            echo "</a>";
        }

		the_title( '<h2 class="title"><a href="' . esc_url( get_permalink() ) . '">', '</a></h2>' );

        echo "<div class=\"card-description\"><a href=\"" . esc_url( get_permalink() ) . "\">";
		the_excerpt();
		echo "</a></div>";

		echo "<div class=\"card-meta\">";
        gs_pricer_posted_on();
        gs_pricer_posted_by();
        echo "</div>";
		?>

</article><!-- #post-<?php the_ID(); ?> -->