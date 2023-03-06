<!--Begin Section14-->
<section class="section2 section14" id="section14">
  <div class="siteWidth">
    <h2 class="title"><?php the_field('peculiarities_title', 'option')?></h2>
    <div class="contentWrapper">
      <?php if(have_rows('peculiarities_points', 'option')) :
        while(have_rows('peculiarities_points', 'option')) : the_row() ?>
          <div class="contentItem">
            <div class="imgWrap">
              <img src="<?php the_sub_field('image')?>" alt="">
            </div>
            <div class="title"><?php the_sub_field('title')?></div>
            <div class="text content_text"><?php the_sub_field('text')?></div>
          </div>
        <?php endwhile;
      endif;
      ?>
    </div>
  </div>
</section>
<!--End Section-->