<?php
/*
Template Name: Шаблон для Страницы новый анализ рынка
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
          <div class="btnWrap"><a class="btn orange" href="#mainForm" data-fancybox onclick="Index.changeSubject('Получить консультацию(<?php the_field('block1_title')?>)')" ><?php pll_e('Получить консультацию')?></a></div>
        </div>
      </div>
    </div>
  </div>
</section>
<!--End Section-->
<!--Begin Section15-->
<section class="section15">
  <div class="siteWidth">
    <div class="innerWrapper">
      <?php
      $leftColumn = get_field('left_column');
        if($leftColumn): ?>
          <div class="column leftColumn">
            <h4 class="columnTitle"><?php echo $leftColumn['title']?></h4>
            <div class="columnImgWrap">
              <img src="<?php echo $leftColumn['image']?>" alt="">
            </div>
            <div class="columnTextWrap content_text"><?php echo $leftColumn['text']?></div>
          </div>
      <?php endif; ?>
      <?php
      $rightColumn = get_field('right_column');
      if($rightColumn): ?>
        <div class="column rightColumn">
          <h4 class="columnTitle"><?php echo $rightColumn['title']?></h4>
          <div class="columnImgWrap">
            <img src="<?php echo $rightColumn['image']?>" alt="">
          </div>
          <div class="columnTextWrap content_text"><?php echo $rightColumn['text']?></div>
        </div>
      <?php endif; ?>
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
<!--    <div class="btnWrap"><a class="btn orange" href="#mainForm" data-fancybox>Запрос демо</a></div>-->
  </div>
</section>
<!--End Section-->
<?php if(have_rows('block4_content')): ?>
<!--Begin Section16-->
<section class="section16">
  <div class="siteWidth">
    <?php while(have_rows('block4_content')): the_row();?>
    <div class="contentWrapper">
      <div class="textWrap">
        <h2 class="title"><?php the_sub_field('title')?></h2>
        <?php if(get_sub_field('subtitle')):?>
        <div class="subtitle"><?php the_sub_field('subtitle')?></div>
        <?php endif; ?>
        <div class="contentBlock content_text"><?php the_sub_field('content')?></div>
      </div>
      <div class="imgWrap">
        <img src="<?php the_sub_field('image')?>" alt="">
      </div>
    </div>
    <?php endwhile; ?>
  </div>
</section>
<!--End Section-->
<?php endif; ?>
<?php if(have_rows('block5_accordion')): ?>
<!--Begin Section17-->
<section class="section17">
  <div class="siteWidth">
    <h2 class="title"><?php the_field('block5_title')?></h2>
    <div class="SpecialAccordionBlock">
        <?php while(have_rows('block5_accordion')): the_row()?>
        <?php if(get_row_index() == 1):?>
            <div class="accordionItem active">
          <?php else: ?>
            <div class="accordionItem">
          <?php endif;?>
          <div class="textWrap">
            <div class="title"><?php the_sub_field('title')?></div>
            <div class="text"><?php the_sub_field('text')?></div>
          </div>
          <div class="imgWrap">
            <img src="<?php the_field('block5_BGImg')?>" alt="" class="imgBG">
            <img src="<?php the_sub_field('image')?>" alt="" class="primaryImage">
          </div>
        </div>
      <?php endwhile; ?>
      </div>
  </div>
</section>
<?php endif;?>
<!--End Section-->


<?php echo get_template_part ('includes/form')?>

<?php echo get_template_part ('includes/peculiarities')?>



<?php get_footer(); ?>
