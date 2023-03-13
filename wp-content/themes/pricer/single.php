<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package pricer
 */

get_header(); ?>
<section class="articlePage_section1">
  <div class="siteWidth">
    <?php
    if ( function_exists('yoast_breadcrumb') ) {
      yoast_breadcrumb( '<p id="breadcrumbs">','</p>' );
    }
    ?>
    <div class="innerWrapper">
      <div class="mainContentWrapper">
        <div class="metaBlock">
          <div class="categories">
            <?php foreach (get_the_category() as $category ): ?>
              <?php $bgColor = get_field('color',$category->taxonomy . '_' . $category->term_id); ?>
              <span class="category" style="background-color: <?php echo $bgColor; ?>"><?php echo $category->name; ?></span>
            <?php endforeach;?>
          </div>
          <div class="date">
            <img src="<?php echo get_template_directory_uri()?>/assets/img/svg/calendar_grey.svg" alt="">
            <span><?php the_time('j.m.Y')?></span>
          </div>
          <?php if(function_exists('the_views')):?>
          <div class="views">
            <img src="<?php echo get_template_directory_uri()?>/assets/img/svg/eye.svg" alt="">
            <span><?php the_views(); ?></span>
          </div>
          <?php endif;?>
        </div>
        <h1><?php the_title(); ?></h1>
        <div class="articleContent">
          <?php the_content();?>
        </div>
        <div class="postContentFormBlock">
          <h4>Слідкуйте за оновленнями</h4>
          <div class="description">Submit your application to see the demo</div>
          <form action="">
            <div class="inputWrapper">
              <input type="email" placeholder="Enter your email " />
              <button class="btn">Підписаться</button>
            </div>
          </form>
        </div>
        <div class="ctaBlock">
          <div class="title">Take a consultation</div>
          <ul>
            <li>Sales funnel</li>
            <li>Automation</li>
            <li>Mailing email</li>
          </ul>
          <div class="btnWrap">
            <a href="#">Request a demo</a>
          </div>
        </div>
        <div class="recommendPosts">
          <h4>Recommended posts</h4>
          <div class="contentWrapper">
            <?php
            $args = array(
              'post_type' => 'post',
              'orderby'   => 'rand',
              'posts_per_page' => 3
            );

            $the_query = new WP_Query($args);

            if($the_query->have_posts()):?>
              <?php while($the_query->have_posts()):
                $the_query->the_post();?>
                <?php get_template_part('/includes/post'); ?>
              <?php endwhile; ?>
            <?php endif; ?>
          </div>
        </div>
      </div>

      <div class="sideBarBlock">
        <div class="stickyWrapper">
          <div class="ctaHiddenBlock">
            <div class="title">Take a consultation</div>
            <ul>
              <li>Sales funnel</li>
              <li>Automation</li>
              <li>Mailing email</li>
            </ul>
            <div class="btnWrap">
              <a href="#">Request a demo</a>
            </div>
          </div>
          <div class="socialsBlock">
            <div class="title">Share it:</div>
            <a href="#" onclick="Index.facebookShare()">
              <img src="<?php echo get_template_directory_uri()?>/assets/img/share_facebook.png" alt="">
            </a>
            <a href="https://www.linkedin.com/sharing/share-offsite/?url=https://pricer.loc<?php echo $_SERVER['REQUEST_URI']?>" target="_blank">
              <img src="<?php echo get_template_directory_uri()?>/assets/img/share_linkedin.png" alt="">
            </a>
            <a href="#" onclick="Index.twitterShare()">
              <img src="<?php echo get_template_directory_uri()?>/assets/img/share_twitter.png" alt="">
            </a>
            <a href="https://telegram.me/share/url?url=https://pricer.loc<?php echo $_SERVER['REQUEST_URI']?>&text=<?php the_title();?>" target="_blank"">
              <img src="<?php echo get_template_directory_uri()?>/assets/img/share_telegram.png" alt="">
            </a>
          </div>
        </div>

      </div>
    </div>

  </div>
</section>

<?php get_footer(); ?>
