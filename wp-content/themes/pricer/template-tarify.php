<?php
/*
Template Name: Шаблон для Страницы Тарифы
Template Post Type: page
*/
get_header(); ?>
<section class="tariff_1">
  <div class="siteWidth">
    <h1 class="title"><?php the_field('block1_title')?></h1>
    <?php if(have_rows('block1_elements')):?>
    <div class="contentWrapper">
      <?php while(have_rows('block1_elements')): the_row(); ?>
      <?php if(get_row_index() == 1) :?>
      <a href="#firstFloor" onclick="Index.go_to(this, event, 120)" class="contentItem">
      <?php elseif(get_row_index() == 2) :?>
      <a href="#secondFloor" onclick="Index.go_to(this, event, 120)" class="contentItem">
      <?php elseif(get_row_index() == 3) :?>
      <a href="#thirdFloor" onclick="Index.go_to(this, event, 120)" class="contentItem">
      <?php endif;?>

        <div class="iconWrap">
          <img src="<?php the_sub_field('icon')?>" alt="">
        </div>
        <div class="title"><?php the_sub_field('title')?></div>
        <div class="content_text"><?php the_sub_field('text')?></div>
      </a>
      <?php endwhile;
        endif;?>
    </div>
  </div>
</section>

<section class="tariff_2">
  <div class="siteWidth">
    <div class="firstFloor" id="firstFloor">
      <div class="column">
        <h3 class="tariff_title"><?php the_field('lvl1_title')?></h3>
        <ul>
          <?php if(have_rows('lvl1_list')):
            while(have_rows('lvl1_list')): the_row() ?>
              <?php if(get_sub_field('tooltip')):?>
                <li title="<?php the_sub_field('text')?>"><span class="someTXT"><?php the_sub_field('text')?></span>
                  <div class="tooltip tooltip2">
                    <svg class="icon icon-info ">
                      <use xlink:href="<?php echo get_template_directory_uri()?>/assets/img/svg/sprite.svg#info"></use>
                    </svg>
                    <span><?php the_sub_field('tooltip')?></span>
                  </div>
                </li>
              <?php else: ?>
                <li title="<?php the_sub_field('text')?>"><span class="someTXT"><?php the_sub_field('text')?></span></li>
              <?php endif; ?>
          <?php endwhile;
            endif; ?>
        </ul>
      </div>
      <?php if(have_rows('lvl1_tariffPlans')):
        while(have_rows('lvl1_tariffPlans')): the_row();?>
      <div class="column">
        <div class="columnInfo">
          <div class="name"><?php the_sub_field('title')?></div>
          <div class="price"><?php the_sub_field('price')?></div>
          <div class="term"><?php the_sub_field('term')?></div>
        </div>
        <ul>
          <?php if(have_rows('list')):
            $left_list = get_field('lvl1_list');
            while(have_rows('list')): the_row();
              if(get_sub_field('icon')):?>
                <li><span class="hidden"><?php echo $left_list[get_row_index() - 1]['text']?></span><img src="<?php echo get_template_directory_uri()?>/assets/img/svg/<?php the_sub_field('ikonka');?>.svg" alt=""></li>
              <?php else :?>
                <li><span class="hidden"><?php echo $left_list[get_row_index() - 1]['text']?></span><span class="show"><?php the_sub_field('text')?></span></li>
              <?php endif;?>
          <?php endwhile;
            endif; ?>
        </ul>
      </div>
      <?php endwhile;
        endif; ?>
    </div>
    <div class="secondFloor" id="secondFloor">
      <div class="iconWrap">
        <img src="<?php the_field('lvl2_icon')?>" alt="">
      </div>
      <h3 class="tariff_title"><?php the_field('lvl2_title')?></h3>
      <div class="content_text"><?php the_field('lvl2_text')?></div>
    </div>
    <div class="thirdFloor" id="thirdFloor">
      <h3 class="tariff_title"><?php the_field('lvl3_title')?></h3>
      <div class="tariffWrapper">
        <?php if(have_rows('lvl3_services')):
          while(have_rows('lvl3_services')): the_row();?>
            <div class="tariffItem">
              <div class="iconWrap"><img src="<?php the_sub_field('icon')?>" alt=""></div>
              <div class="title"><?php the_sub_field('title')?></div>
              <div class="priceBlock"><?php the_sub_field('price')?> <span>/ <?php the_sub_field('term')?></span></div>
            </div>
        <?php endwhile;
          endif;?>
      </div>
    </div>
  </div>
</section>


<?php echo get_template_part ('includes/form')?>
<?php get_footer(); ?>
