<?php
/**
 * Plugin Name: Изменяем стилей и добавление новых
 * Description: Дополнительные стили оформления
 * Plugin URI: http://goodsite.com.ua/
 * Author: Valeriy Baev
 * Version: 1.0
 * Author URI: http://goodsite.com.ua/
 *
 * Text Domain: gs-theme-style
 */


// Подключаем новый стиль
add_action('wp_enqueue_scripts','gs_theme_modify_style',10000);

function gs_theme_modify_style() {
//    wp_register_style( 'gs_theme_modify_style', plugins_url( 'css/style.css', __FILE__ ), false, "1.1" );
    wp_register_style( 'gs_theme_modify_style', plugins_url( 'css/style.css', __FILE__ ), false, rand(1,999999999999999) );
    wp_enqueue_style( 'gs_theme_modify_style' );

//    wp_register_script( 'gs_theme_modify_script', plugins_url( 'js/scripts.js', __FILE__ ), false, "1.0" );
//    wp_enqueue_script( 'gs_theme_modify_script' );
}

// Подключаем новый стиль в админку
//add_action( 'admin_enqueue_scripts', 'gs_admin_style',10000 );

function gs_admin_style() {
    wp_register_style( 'gs_admin_style', plugins_url( 'css/admin-style.css', __FILE__ ), false, "1.0"  );
    wp_enqueue_style( 'gs_admin_style' );
}


// Добавляем шорт код текущего года
//add_shortcode('year', 'gs_current_year');

function gs_current_year() {
    return date("Y");
}



/* Translated stings */
// PolyLang translation
add_action('init', function() {
    pll_register_string("gs-theme-style", "Sorry, the specified page was not found");
    pll_register_string("gs-theme-style", "Получить консультацию");
    pll_register_string("gs-theme-style", "Posted on %s");
    pll_register_string("gs-theme-style", "by %s");
    pll_register_string("gs-theme-style", "Read more...");
});



if ( ! function_exists( 'gs_pricer_posted_on' ) ) :
    /**
     * Prints HTML with meta information for the current post-date/time.
     */
    function gs_pricer_posted_on() {
        $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

        $time_string = sprintf(
            $time_string,
            esc_attr( get_the_date( DATE_W3C ) ),
            esc_html( get_the_date() )
        );

        $posted_on = sprintf(
        /* translators: %s: post date. */
            esc_html_x( pll__("Posted on %s"), 'post date', 'pricer' ),
            $time_string
        );

        echo '<span class="posted-on">' . $posted_on . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

    }
endif;

if ( ! function_exists( 'gs_pricer_posted_by' ) ) :
    /**
     * Prints HTML with meta information for the current author.
     */
    function gs_pricer_posted_by() {
        $byline = sprintf(
        /* translators: %s: post author. */
            esc_html_x( pll__(' by %s'), 'post author', 'pricer' ),
            '<span class="author vcard">' . esc_html( get_the_author() ) . '</span>'
        );

        echo '<span class="byline"> ' . $byline . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

    }
endif;

if (!function_exists("gs_content_modify")) {
    function gs_content_modify($html)
    {
        $html = preg_replace_callback('#((<[^>]*)(id="[^"]*")([^>]*>))#si', 'gs_content_replace', $html);
        return $html;
    }
}

if (!function_exists("gs_content_replace")) {
    function gs_content_replace($matches)
    {
        return "<span class=\"content-anchor\" " . $matches[3] . "></span>" . trim($matches[2]) . trim($matches[4]);
    }
}

/* Add axcerpt to pages */

add_post_type_support( 'page', 'excerpt' );

add_filter( 'excerpt_more', 'new_excerpt_more' );
function new_excerpt_more( $more ){
    global $post;
    return "...";
//    return ' <a href="'. get_permalink($post) . '">'.pll__("Read more...").'</a>';
}

/* Add image size */
add_image_size( 'card', 600, 400, true );

/* Добавляем иконку к меню */
add_filter( 'wp_nav_menu_objects', function ( $items, $args ){
//    var_dump($args);
    if ((preg_match("'53'si",$args->menu))|(preg_match("'54'si",$args->menu))) {
        foreach ($items as &$item) {
            if ($img = get_field("image", $item->ID)) {
                if ($img["id"] > 0) {

                    $image = $img = wp_get_attachment_image( $img["id"], 'full' );
                    $item->title = $image . "<span>" . $item->title . "</span>";
                }
            }
        }
    }

    return $items;
}, 10, 2 );

/* Add form validate */
// add_filter('wpcf7_form_novalidate',function() { return false; });
// En redirect

add_filter( 'parse_request', function($request) {
//    var_dump(strtolower($request->request));
    if (preg_match("'en/(.*)'si",strtolower($request->request),$regs)) {
//        var_dump($regs);
//        wp_redirect( "/".$regs[1],301, "Theme Language En redirect");
        header("Location: /".$regs[1], true, 301);
        exit();
    }
} );