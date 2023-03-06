<?php
/*
Template Name: Шаблон для Страницы Отчеты и дашборды
Template Post Type: page
*/
get_header(); ?>
<!--Begin Section11-->
<section class="section11 Reports1" id="section11">
  <div class="siteWidth">
    <div class="innerWrapper">
      <div class="leftSide">
        <div class="imgWrap"><img src="<?php the_field('block1_image')?>" alt=""></div>
      </div>
      <div class="rightSide">
        <div class="textWrap">
          <h1 class="title"><?php the_field('block1_title')?></h1>
          <div class="content_text"><?php the_field('block1_subtitle')?></div>
          <div class="btnWrap"><a class="btn orange" href="#mainForm" data-fancybox onclick="Index.changeSubject('Запросить демо(<?php the_field('block1_title')?>)')" ><?php pll_e('Запрос демо')?></a></div>
        </div>
      </div>
    </div>
  </div>
</section>
<!--End Section-->
<!--Begin Reports2-->
<section class="Reports2">
  <div class="siteWidth">
    <h2 class="title"><?php the_field('block2_title')?></h2>
    <div class="contentWrapper">
      <?php if(have_rows('block2_content')):
          while(have_rows('block2_content')): the_row()?>
            <div class="contentItem">
              <div class="title"><?php the_sub_field('title');?></div>
              <div class="imgWrap">
                <img src="<?php the_sub_field('image');?>" alt="">
              </div>
              <div class="content_text"><?php the_sub_field('text');?></div>
            </div>
      <?php endwhile;
        endif; ?>
    </div>
  </div>
</section>
<!--End Section-->
<!--Begin Reports3-->
<section class="Reports3">
  <div class="siteWidth">
    <h2 class="title"><?php the_field('block3_title')?></h2>
    <div class="description content_text"><?php the_field('block3_subtitle')?></div>
    <?php if(have_rows('block3_content')):
      while(have_rows('block3_content')): the_row()?>
        <div class="levelBlock">
          <div class="textWrap">
            <div class="title"><?php the_sub_field('title');?></div>
            <div class="text content_text"><?php the_sub_field('text');?></div>
          </div>
          <div class="imgWrap">
            <img src="<?php the_sub_field('image');?>" alt="">
          </div>
        </div>
      <?php endwhile;
    endif; ?>
  </div>
</section>
<!--End Section-->
<!--Begin Reports4-->
<section class="Reports4">
  <div class="siteWidth">
    <h2 class="title"><?php the_field('block4_title')?></h2>
    <div class="contentWrapper">
      <?php if(have_rows('block4_content')):
        while(have_rows('block4_content')): the_row()?>
          <div class="contentItem">
            <div class="imgWrap">
              <img src="<?php the_sub_field('image')?>" alt="">
            </div>
            <div class="text content_text"><?php the_sub_field('text')?></div>
          </div>
        <?php endwhile;
      endif; ?>
    </div>
  </div>
</section>
<!--End Section-->
<!--Begin Reports5-->
<section class="Reports5">
  <div class="siteWidth">
    <h2 class="title"><?php the_field('block5_title')?></h2>
    <div class="innerWrapper">
      <?php if(have_rows('block5_content')):
        while(have_rows('block5_content')): the_row()?>
          <div class="innerItem">
            <div class="iconWrap">
              <img src="<?php the_sub_field('icon')?>" alt="">
            </div>
            <div class="textWrap content_text"><?php the_sub_field('text')?></div>
          </div>
        <?php endwhile;
      endif; ?>
    </div>
    <div class="imgWrap">
      <img src="<?php the_field('block5_image')?>" alt="">
      <div class="tooltip">
        <svg class="icon icon-info ">
          <use xlink:href="<?php echo get_template_directory_uri()?>/assets/img/svg/sprite.svg#info"></use>
        </svg>
        <span><?php the_field('block5_tooltip1')?></span>
      </div>
      <div class="tooltip">
        <svg class="icon icon-info ">
          <use xlink:href="<?php echo get_template_directory_uri()?>/assets/img/svg/sprite.svg#info"></use>
        </svg>
        <span><?php the_field('block5_tooltip2')?></span>
      </div>
    </div>
  </div>
</section>
<!--End Section-->
<?php echo get_template_part ('includes/form')?>
<?php echo get_template_part ('includes/peculiarities')?>


<?php get_footer(); ?>
