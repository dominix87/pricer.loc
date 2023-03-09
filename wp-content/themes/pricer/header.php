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
  <?php $translations = pll_the_languages( array( 'raw' => 1 ) ); ?>

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>


<header class="white">
  <div class="siteWidth">
    <div class="innerWrapper">
      <a class="logo" href="<?php echo home_url('/');?>">
        <img src="<?php the_field('header_logo', 'option')?>" alt="">
      </a>
      <nav class="navigation" id="mobMenu">
        <div class="menuWrapper">
          <ul class="mainMenu">
          <?php
          if( has_nav_menu( 'header_menu' ) ) :

          $locations = get_nav_menu_locations();
          $menuId = $locations['header_menu'];

          $header_menu_items = wp_get_nav_menu_items( $menuId, [
          'output_key'  => 'menu_order',
          ] );

          $header_menu = [];

          foreach ( $header_menu_items as $item ) {
          $header_menu[] = [
            'title' => $item->title,
            'url' => $item->url,
            ];
          }

          $markup = null;

          if(have_rows('item_template_markup', 'option')):
            while(have_rows('item_template_markup','option')): the_row();
              $markup[] = get_sub_field('markup');
            endwhile;
          endif;

          $counter = 0;
          foreach ( $header_menu as $menu_item ) {
            if($menu_item['url'] === '#'):?>
              <?php if($markup[$counter]):?>
                <li class="parent">
                  <span class="menuSwitcher" data-menuid="sub_menu_<?php echo $counter; ?>"><?php echo $menu_item['title']; ?></span>
                  <div class="subMenu" id="sub_menu_<?php echo $counter; ?>">
                    <div class="subMenuWrapper">
                      <?php echo $markup[$counter];?>
                    </div>
                  </div>
                </li>
              <?php else:?>
                <li><span><?php echo $menu_item['title']; ?></span></li>
              <?php endif;?>
            <?php else: ?>
              <li><a href="<?php echo $menu_item['url']; ?>"><?php echo $menu_item['title']; ?></a></li>
            <?php endif;
            $counter++;
          }
          endif;
          ?>
          </ul>
          <div class="socialsBlock">
            <ul>
              <li>
                <a href="#">
                  <img src="<?php echo get_template_directory_uri()?>/assets/img/facebook_icon.png" alt="">
                </a>
              </li>
              <li>
                <a href="#">
                  <img src="<?php echo get_template_directory_uri()?>/assets/img/linekdin_icon.png" alt="">
                </a>
              </li>
              <li>
                <a href="#">
                  <img src="<?php echo get_template_directory_uri()?>/assets/img/telegram_icon.png" alt="">
                </a>
              </li>
              <li>
                <a href="#">
                  <img src="<?php echo get_template_directory_uri()?>/assets/img/youtube_icon.png" alt="">
                </a>
              </li>
            </ul>
          </div>
          <div class="bottomBtnBlock">
          <a href="#mainForm" class="logInBtn">Log in</a>
          <a href="#mainForm" class="requestDemoBtn" onclick="Index.changeSubject('Получить демо')" data-fancybox><?php pll_e('Получить демо')?></a>
        </div>
        </div>
      </nav>
      <div class="additionalBtns">
        <div class="langBlock">
          <?php foreach($translations as $lang):
            if ($lang['current_lang'] == $lang): ?>
              <button><?php echo $lang['slug']; ?></button>
            <?php endif;
            endforeach; ?>
              <div class="langList">
            <?php foreach($translations as $lang):
              if ($lang['current_lang'] != $lang): ?>
              <a href="<?php echo $lang['url'] ?>"><?php echo $lang['slug']; ?></a>
            <?php else: ?>
              <span class="active"><?php echo $lang['slug']?></span>
            <?php endif;
            endforeach; ?>
          </div>
        </div>
        <a href="#mainForm" class="logInBtn">Log in</a>
        <a href="#mainForm" class="requestDemoBtn" onclick="Index.changeSubject('Получить демо')" data-fancybox><?php pll_e('Получить демо')?></a>
        <button class="toggleMenu" onclick="Index.toggleMenu(this)">
          <span></span>
        </button>
      </div>
    </div>
  </div>
</header>
<main>
