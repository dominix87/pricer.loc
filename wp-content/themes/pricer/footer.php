<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package pricer
 */

?>
</main>
<footer>
  <div class="footerTop">
    <div class="siteWidth">
      <div class="innerWrapper">
        <div class="logoBlock">
          <a href="<?php echo home_url('/');?>">
            <img src="<?php the_field('footer_logo', 'option')?>" alt="">
          </a>
            <?php
            echo do_shortcode('[cf7form cf7key="subscribe-form"]');
            ?>

            <?php /*  ?>
          <div class="phoneBlock">
            <a href="tel:<?php echo str_replace(array(' ',')','('), array('','',''), get_field('phone', 'option'))?>"><?php the_field('phone', 'option')?></a>
            <a class="spec" href="#mainForm" data-fancybox onclick="Index.changeSubject('<?php pll_e('Перезвоните мне'); ?>')"><?php pll_e('Перезвоните мне')?></a></div>
          <div class="socialsBlock">
            <?php if(get_field('telegram_link', 'option')) : ?>
            <a class="telegram" href="<?php the_field('telegram_link', 'option')?>" rel="nofollow" target="_blank">
              <svg class="icon icon-telegram ">
                <use xlink:href="<?php echo get_template_directory_uri()?>/assets/img/svg/sprite.svg#telegram"></use>
              </svg>
            </a>
            <?php endif;?>
            <?php if(get_field('viber_link', 'option')) : ?>
            <a class="viber" href="<?php the_field('viber_link', 'option')?>" rel="nofollow" target="_blank">
              <svg class="icon icon-viber ">
                <use xlink:href="<?php echo get_template_directory_uri()?>/assets/img/svg/sprite.svg#viber"></use>
              </svg>
            </a>
            <?php endif;?>
            <?php if(get_field('messenger_link', 'option')) : ?>
            <a class="messenger" href="<?php the_field('messenger_link', 'option')?>" rel="nofollow" target="_blank">
              <svg class="icon icon-messenger ">
                <use xlink:href="<?php echo get_template_directory_uri()?>/assets/img/svg/sprite.svg#messenger"></use>
              </svg>
            </a>
            <?php endif;?>
          </div>
            <?php /* */ ?>
        </div>
        <div class="footerElement menuBlock">
          <div class="listTitle"><?php pll_e('Заголовок 1'); ?></div>
          <ul>
            <?php
            if( has_nav_menu( 'footer_menu_column1' ) ) :

              $locations = get_nav_menu_locations();
              $menuId = $locations['footer_menu_column1'];

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

              $curr_link = get_permalink();
              foreach ( $header_menu as $menu_item ) {
                $active = ( $curr_link == $menu_item['url'] ) ? 'active' : '';
                echo '<li class="' . $active . '"><a href="' . $menu_item['url'] . '" ' . $active . '">' . $menu_item['title'] . '</a></li>';
              }
            endif;
            ?>
          </ul>
        </div>
        <div class="footerElement decisionBlock">
          <div class="listTitle"><?php pll_e('Заголовок 2'); ?></div>
          <ul>
            <?php
            if( has_nav_menu( 'footer_menu_column2' ) ) :

              $locations = get_nav_menu_locations();
              $menuId = $locations['footer_menu_column2'];

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

              $curr_link = get_permalink();
              foreach ( $header_menu as $menu_item ) {
                $active = ( $curr_link == $menu_item['url'] ) ? 'active' : '';
                echo '<li class="' . $active . '"><a href="' . $menu_item['url'] . '" ' . $active . '">' . $menu_item['title'] . '</a></li>';
              }
            endif;
            ?>
          </ul>
        </div>
        <div class="footerElement politicsBlock">
          <div class="listTitle"><?php pll_e('Заголовок 3'); ?></div>
          <ul>
            <?php
            if( has_nav_menu( 'footer_menu_column3' ) ) :

              $locations = get_nav_menu_locations();
              $menuId = $locations['footer_menu_column3'];

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

              $curr_link = get_permalink();
              foreach ( $header_menu as $menu_item ) {
                $active = ( $curr_link == $menu_item['url'] ) ? 'active' : '';
                echo '<li class="' . $active . '"><a href="' . $menu_item['url'] . '" ' . $active . '">' . $menu_item['title'] . '</a></li>';
              }
            endif;
            ?>

          </ul>
            <?php
            $lang = pll_current_language('slug');
            if ($lang == "en") {
                wp_nav_menu( [
                    'menu'            => '53',
                    'menu_class'           => 'footer_phones'
                ] );
            }
            else {
                wp_nav_menu( [
                    'menu'            => '54',
                    'menu_class'           => 'footer_phones'
                ] );
            }

            ?>
        </div>
      </div>
    </div>
  </div>
  <div class="footerBottom">
    <div class="siteWidth">
      <div class="innerWrapper">
        <div class="copyright"><?php the_field('copyright', 'option')?></div>
        <ul class="politicsList">
          <?php if(have_rows('politics', 'option')) :
            while(have_rows('politics', 'option')) : the_row() ?>
              <li><a href="#modalPolitics<?php the_row_index();?>" data-fancybox><?php the_sub_field('title')?></a></li>
            <?php endwhile;
          endif;
          ?>
        </ul>
        <div class="rezartLogoBlock">
          <a href="https://rezart.agency" target="_blank">
            <svg class="icon icon-rezart_logo ">
              <use xlink:href="<?php echo get_template_directory_uri()?>/assets/img/svg/sprite.svg#rezart_logo"></use>
            </svg>
          </a>
        </div>
      </div>
    </div>
  </div>
</footer>

<div class="hiddenBlock">
  <div class="orderPanel" id="mainForm">
    <div class="wrapper">
      <p class="title"><?php the_field('popup_form_title', 'option')?></p>
      <p class="text"><?php the_field('popup_form_text', 'option')?></p>
      <?php echo do_shortcode('[cf7form cf7key="kontaktnaya-forma-1"]')?>
    </div>
  </div>

  <?php if(have_rows('politics', 'option')) :
    while(have_rows('politics', 'option')) : the_row() ?>
      <div class="modalPolitics" id="modalPolitics<?php the_row_index();?>">
        <div class="title">
          <h2><?php the_sub_field('title')?></h2>
        </div>
        <div class="content"><?php the_sub_field('text')?></div>
      </div>
    <?php endwhile;
  endif;
  ?>
</div>

<?php wp_footer(); ?>

</body>
</html>
