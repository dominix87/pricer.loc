<?php get_header();?>
<section class="blogPage_section1">
  <div class="siteWidth">
    <?php
    if ( function_exists('yoast_breadcrumb') ) {
      yoast_breadcrumb( '<p id="breadcrumbs">','</p>' );
    }
    ?>
    <div class="innerWrapper">
      <div class="sideBarBlock">
        <div class="categoryWrapperBlock">
          <div class="searchBlock">
            <form action="<?php echo esc_url( home_url( '/' ) ); ?>">
              <div class="searchWrapper">
                <input type="text" value="<?php echo get_search_query(); ?>" name="s" id="s" placeholder="Search">
              </div>
            </form>
          </div>
          <div class="categoryBlock">
            <button class="categoryListToggler" onclick="Index.categoryListToggler(this)">
              <img src="<?php echo get_template_directory_uri(); ?>/assets/img/allCatsIcon.png" alt="">
              <span>All categories</span>
            </button>
            <?php $categories = get_categories(); ?>
            <ul class="categoryList">
              <?php foreach($categories as $category):?>
                <?php
                $iconPth = get_field('icon',$category->taxonomy . '_' . $category->term_id);
                $bgColor = get_field('color',$category->taxonomy . '_' . $category->term_id); ?>
                <?php if ($iconPth):?>
                  <li>
                    <a href="<?php echo get_category_link($category->term_id)?>" class="catLink">
                      <img src="<?php echo $iconPth; ?>" alt="">
                      <span><?php echo $category->name; ?></span>
                      <span class="bg" style="background-color:<?php echo $bgColor; ?>"></span>
                    </a>
                  </li>
                <?php endif;?>
              <?php endforeach; ?>
            </ul>
          </div>
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
        </div>
      </div>
      <div class="mainContentBlock">
        <div class="mainArticleBlock">
          <a href="#" style="background-image: url(<?php echo get_template_directory_uri()?>/assets/img/mainArticleImage.jpg)">
            <span class="category">Кейсы</span>
            <span class="textWrap">
              <span class="title">Як Telemart.ua впровадив продуктову аналітику Pricer24 і збільшив прибуток на 25%</span>
              <span class="description">У 2020 році, під час зростання популярності майнінгу, ми зробили інтеграцію звітів для парсингу та сегментації ринку відеокарт...</span>
              <span class="date">
                <img src="<?php echo get_template_directory_uri()?>/assets/img/svg/calendar.svg" alt="">
                <span>20.05.2022</span>
              </span>
            </span>
          </a>
        </div>
        <div class="restContentBlock">
          <div class="someTitle">Hot 🔥</div>
          <?php if(have_posts()):?>
            <div class="contentWrapper">
              <?php while(have_posts()): ?>
                <?php the_post();
                get_template_part('/includes/post');
              endwhile; ?>
            </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</section>


<?php get_footer(); ?>
