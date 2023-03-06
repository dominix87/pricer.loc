<?php
/**
 * The header for our theme
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
<!--  <script>-->
<!--    document.addEventListener( 'wpcf7mailsent', function( event ) {-->
<!--      location = 'https://pricer24.com/success/';-->
<!--    }, false );-->
<!--  </script>-->


	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>


<header class="white">
  <div class="siteWidth container-fluid">
    <div class="innerWrapper">
      <a class="logo" href="<?php echo home_url('/');?>">
        <img src="<?php the_field('header_logo', 'option')?>" alt="">
      </a>
      <nav class="navigation" id="mobMenu">
        <ul>
          <li class="mobile">
            <a class="logo" href="<?php echo home_url('/');?>">
              <img src="<?php the_field('header_logo', 'option')?>" alt="">
            </a>
          </li>
          <?php
          if( has_nav_menu( 'header_menu' ) ) :

            $locations = get_nav_menu_locations();
            $menuId = $locations['header_menu'];

            $header_menu_items = wp_get_nav_menu_items( $menuId, [
              'output_key'  => 'menu_order',
            ] );

            $count = 0;
            $submenu = false;

            foreach( $header_menu_items as $item ):

              $link = $item->url;
              $title = $item->title;
              // item does not have a parent so menu_item_parent equals 0 (false)
              if ( !$item->menu_item_parent ):

                // save this id for later comparison with sub-menu items
                $parent_id = $item->ID; ?>


                <li class="parent">
                <?php if($link != '#'): ?>

                  <a href="<?php echo $link; ?>"><?php echo $title; ?></a>
                <?php else: ?>

                  <span class="itemTitle"><?php echo $title; ?></span>
                <?php endif; ?>


              <?php endif; ?>

              <?php if ( $parent_id == $item->menu_item_parent ): ?>

              <?php if ( !$submenu ): $submenu = true; ?>
                <span class="toggleChild"></span>
                <ul class="child">
              <?php endif; ?>
                  <li><a href="<?php echo $link; ?>"><?php echo $title; ?></a></li>
              <?php if ( $header_menu_items[ $count + 1 ]->menu_item_parent != $parent_id && $submenu ): ?>
                </ul>
                <?php $submenu = false; endif; ?>

            <?php endif; ?>

              <?php if ( $header_menu_items[ $count + 1 ]->menu_item_parent != $parent_id ): ?>
              </li>
              <?php $submenu = false; endif; ?>

              <?php $count++; endforeach;
          endif; ?>


          <li class="mobile btnLine">
            <a class="enterBtn"  href="#mainForm" onclick="Index.changeSubject('Получить демо')" data-fancybox><?php the_field('header_btn_text', 'option')?></a>
          </li>
          <li class="mobile">
            <?php $translations = pll_the_languages( array( 'raw' => 1 ) );
            ?>
            <div class="langBlock">
              <?php foreach($translations as $lang):
              if ($lang['current_lang'] == $lang): ?>
              <button><?php echo $lang['name']; ?></button>
              <?php endif;
              endforeach; ?>
              <div class="langList">
                <?php foreach($translations as $lang):
                  if ($lang['current_lang'] != $lang): ?>
                <a href="<?php echo $lang['url'] ?>"><?php echo $lang['name']; ?></a>
                <?php endif;
                endforeach; ?>
              </div>
            </div>
          </li>

        </ul>
        <button class="closeMenu" onclick="Index.closeMenu();">
          <svg class="icon icon-closeModal ">
            <use xlink:href="<?php echo get_template_directory_uri()?>/assets/img/svg/sprite.svg#closeModal"></use>
          </svg>
        </button>
      </nav>
      <div class="additionalBtns">
        <div class="langBlock">
          <?php foreach($translations as $lang):
            if ($lang['current_lang'] == $lang): ?>
              <button><?php echo $lang['name']; ?></button>
            <?php endif;
            endforeach; ?>
              <div class="langList">
            <?php foreach($translations as $lang):
              if ($lang['current_lang'] != $lang): ?>
              <a href="<?php echo $lang['url'] ?>"><?php echo $lang['name']; ?></a>
            <?php endif;
            endforeach; ?>
          </div>
        </div>



        <a class="enterBtn" href="#mainForm" onclick="Index.changeSubject('Получить демо')" data-fancybox><?php pll_e('Получить демо')?></a>
        <button class="openMenu" onclick="Index.openMenu()">
          <svg class="icon icon-menuBurger ">
            <use xlink:href="<?php echo get_template_directory_uri()?>/assets/img/svg/sprite.svg#menuBurger"></use>
          </svg>
        </button>
      </div>
    </div>
  </div>
</header>
<main>
