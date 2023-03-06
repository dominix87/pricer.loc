<?php
/*
Template Name: Шаблон для Страницы Динамическое ценообразование
Template Post Type: page
*/
get_header(); ?>
<!--Begin Section11-->
<section class="section11 DPrice1" id="section11">
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
<!--Begin DPrice2-->
<section class="DPrice2">
  <div class="siteWidth">
    <h2 class="title"><?php the_field('block2_title')?></h2>
    <div class="contentWrapper">
      <?php if(have_rows('block2_content')):
        while(have_rows('block2_content')): the_row() ?>
          <div class="contentItem">
            <div class="iconWrap">
              <img src="<?php the_sub_field('smile')?>" alt="">
            </div>
            <div class="content_text"><?php the_sub_field('text')?></div>
          </div>
      <?php endwhile;
        endif; ?>
    </div>
    <?php if(get_field('block2_bottomTextBlock')):?>
      <div class="bottomNote"><?php the_field('block2_bottomTextBlock')?></div>
    <?php endif;?>
  </div>
</section>
<!--End Section-->
<!--Begin DPrice3-->
<section class="DPrice3">
  <div class="siteWidth">
    <h2 class="title"><?php the_field('block3_title')?></h2>
    <div class="contentWrapper">
      <?php if(have_rows('block3_levels')):
        while(have_rows('block3_levels')): the_row();?>
          <div class="contentItem">
            <div class="iconWrap">
              <img src="<?php the_sub_field('image')?>" alt="">
            </div>
            <div class="title"><?php the_sub_field('title')?></div>
            <?php if(have_rows('list')):?>
              <ul class="content_text">
                <?php while(have_rows('list')): the_row();?>
                  <li><?php the_sub_field('text')?></li>
                <?php endwhile;?>
              </ul>
            <?php endif;?>
            <div class="bottomBlock">
              <div class="topText"><span><?php the_sub_field('topText')?></span></div>
              <div class="blockText content_text"><?php the_sub_field('bottomText')?></div>
            </div>
          </div>
      <?php endwhile;
        endif; ?>
    </div>
  </div>
</section>
<!--End Section-->

<!--Begin DPrice4-->
<section class="DPrice4">
  <div class="siteWidth">
    <h2 class="title"><?php the_field('block4_title')?></h2>
    <div class="topContent">
      <div class="imgWrap">
        <img src="<?php the_field('block4_top_image')?>" alt="">
      </div>
      <div class="itemsWrap">
        <?php if(have_rows('block4_top_list')):
          while(have_rows('block4_top_list')): the_row()?>
          <div class="contentItem">
            <div class="iconWrap">
              <img src="<?php the_sub_field('icon')?>" alt="">
            </div>
            <div class="content_text"><?php the_sub_field('text')?></div>
          </div>
        <?php endwhile;
        endif; ?>
      </div>
    </div>
    <div class="bottomContent">
      <div class="imgWrap">
        <img src="<?php the_field('block4_bottom_image')?>" alt="">
      </div>
      <div class="itemsWrap">
        <?php if(have_rows('block4_bottom_list')):
          while(have_rows('block4_bottom_list')): the_row()?>
            <div class="contentItem">
              <div class="iconWrap">
                <img src="<?php the_sub_field('icon')?>" alt="">
              </div>
              <div class="content_text"><?php the_sub_field('text')?></div>
            </div>
          <?php endwhile;
        endif; ?>
      </div>
    </div>
  </div>
</section>
<!--End Section-->

<?php echo get_template_part ('includes/form')?>
<?php echo get_template_part ('includes/peculiarities')?>


<?php get_footer(); ?>
