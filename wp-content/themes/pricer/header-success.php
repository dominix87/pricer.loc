<?php
/**
 * The header for our theme ver 2.0
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package pricer
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="profile" href="https://gmpg.org/xfn/11">
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="successHeader">
  <div class="siteWidth container-fluid">
    <div class="innerWrapper"><a class="logo" href="<?php echo home_url('/');?>">
        <svg class="icon icon-logo ">
          <use xlink:href="<?php echo get_template_directory_uri()?>/assets/img/svg/sprite.svg#logo"></use>
        </svg></a></div>
  </div>
</header>