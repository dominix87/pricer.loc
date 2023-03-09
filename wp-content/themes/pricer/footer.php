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
  <div class="firstLevel">
    <div class="siteWidth">
      <div class="textBlock">
        <h3>Get <span>expert</span> advice</h3>
        <div class="description">Submit your application to see the demo and make sure that the service fits your needs</div>
        <div class="btnWrap">
          <a href="#mainForm" class="btn" onclick="Index.changeSubject('Получить демо')" data-fancybox><?php pll_e('Получить демо')?></a>
        </div>
      </div>
    </div>
  </div>
  <div class="secondLevel">
    <div class="siteWidth">
      <div class="innerWrapper">
        <div class="gloryText">🇺🇦 Glory To Ukraine!</div>
        <div class="footerColumn">
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
        <div class="footerColumn">
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
        <div class="footerColumn">
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
        </div>
        <div class="footerColumn contactsColumn">
          <div class="listTitle"><?php pll_e('Заголовок 4'); ?></div>
          <div class="socialsBlock">
            <a href="#">
              <img src="<?php echo get_template_directory_uri()?>/assets/img/facebook_footer_icon.png" alt="">
              <span>Facebook</span>
            </a>
            <a href="#">
              <img src="<?php echo get_template_directory_uri()?>/assets/img/linkedin_footer_icon.png" alt="">
              <span>LinkedIn</span>
            </a>
          </div>
          <div class="listTitle"><?php pll_e('Заголовок 5'); ?></div>
          <div class="emailBlock">
            <a href="mailto:hello@pricer24.com">hello@pricer24.com</a>
          </div>
          <div class="listTitle"><?php pll_e('Заголовок 6'); ?></div>
          <div class="phoneBlock">
            <a href=""></a>
            <a href="tel:+442038070277">+44 203 807 0277</a>
            <a href="tel:+380442994839">+380 44 299 4839</a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="thirdLevel">
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
