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
            <?php $categories = get_categories(); ?>
            <ul>
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
        <div class="currentSearchQueryBlock">
          <div class="textWrap">Searching for: "<?php echo get_search_query(); ?>"</div>
        </div>
        <div class="restContentBlock">
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
