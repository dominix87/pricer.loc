<?php
/*
Template Name: Шаблон для Страницы РРС и анализ Ассортимента
Template Post Type: page
*/
get_header(); ?>

<!--Begin Section11-->
<section class="section11" id="section11">
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
<!--Begin Section12-->
<section class="section12" id="section12">
  <div class="siteWidth">
    <h2 class="title"><?php the_field('block2_title')?></h2>
    <div class="innerWrapper">
      <div class="sliderBlockFirst">
        <?php if(have_rows('block2_tasks')) :
          while(have_rows('block2_tasks')) : the_row() ?>
            <div class="sliderItem">
              <img src="<?php the_field('block2_imageBG')?>" class="BGImg" alt="">
              <div class="trueImgWrap">
                <img src="<?php the_sub_field('image')?>" class="trueImg" alt="">
              </div></div>
          <?php endwhile;
        endif;
        ?>
      </div>
      <div class="rightSide">
        <div class="countBlock"></div>
        <div class="sliderInfoBlock">
          <?php if(have_rows('block2_tasks')) :
            while(have_rows('block2_tasks')) : the_row() ?>
              <?php if(get_row_index() == 1):?>
              <div class="infoItem active">
              <?php else: ?>
                <div class="infoItem">
              <?php endif; ?>
                <div class="title"><?php the_sub_field('title')?></div>
                <div class="text content_text"><?php the_sub_field('text')?></div>
              </div>
            <?php endwhile;
          endif;
          ?>
        </div>
        <div class="controlBlock">
          <button class="arrow__left">
            <svg class="icon icon-arrow_left ">
              <use xlink:href="<?php echo get_template_directory_uri()?>/assets/img/svg/sprite.svg#arrow_left"></use>
            </svg>
            <span><?php pll_e('Пред')?></span>
          </button>
          <div class="hiddenBlock"><span class="title"></span><span class="countBlock"></span></div>
          <button class="arrow__right">
            <span><?php pll_e('След')?></span>
            <svg class="icon icon-arrow_right ">
              <use xlink:href="<?php echo get_template_directory_uri()?>/assets/img/svg/sprite.svg#arrow_right"></use>
            </svg>
          </button>
        </div>
      </div>
      <div class="mobileSliderBlock">
        <div class="controlBlock">
          <button class="arrow__left">
            <svg class="icon icon-arrow_left ">
              <use xlink:href="<?php echo get_template_directory_uri()?>/assets/img/svg/sprite.svg#arrow_left"></use>
            </svg>
          </button>
          <div class="hiddenBlock"><span class="title"></span><span class="countBlock"></span></div>
          <button class="arrow__right">
            <svg class="icon icon-arrow_right ">
              <use xlink:href="<?php echo get_template_directory_uri()?>/assets/img/svg/sprite.svg#arrow_right"></use>
            </svg>
          </button>
        </div>
        <div class="sliderBlockSecond">
          <?php if(have_rows('block2_tasks')) :
          while(have_rows('block2_tasks')) : the_row() ?>
            <div class="sliderItem">
              <div class="imgWrap">
                <img src="<?php the_field('block2_imageBG')?>" class="BGImg" alt="">
                <div class="trueImgWrap">
                  <img src="<?php the_sub_field('image')?>" class="trueImg" alt="">
                </div>
              </div>
              <div class="textWrap">
                <div class="title"><?php the_sub_field('title')?></div>
                <div class="text content_text"><?php the_sub_field('text')?></div>
              </div>
            </div>
            <?php endwhile;
            endif;
            ?>
        </div>
      </div>
    </div>
  </div>
</section>
<!--End Section-->
<!--Begin Section13-->
<section class="section13">
  <div class="siteWidth">
    <h2 class="title"><?php the_field('block3_title')?></h2>
    <?php if(have_rows('block3_steps')) :
      while(have_rows('block3_steps')) : the_row() ?>
        <div class="elementFloor">
          <div class="textWrap">
            <h3 class="title"><?php the_sub_field('title')?></h3>
            <div class="content_text"><?php the_sub_field('text')?></div>
          </div>
          <div class="imgWrap"><img src="<?php the_sub_field('image')?>" alt=""></div>
        </div>
      <?php endwhile;
    endif;
    ?>
    <div class="btnWrap"><a class="btn orange" href="#mainForm" data-fancybox>Запрос демо</a></div>
  </div>
</section>
<!--End Section-->

<?php echo get_template_part ('includes/form')?>
<?php echo get_template_part ('includes/peculiarities')?>



<?php get_footer(); ?>
