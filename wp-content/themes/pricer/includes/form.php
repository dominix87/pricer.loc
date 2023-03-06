<!--Begin Section9-->
<section class="section9" id="section9">
  <div class="siteWidth">
    <div class="innerWrapper">
  <!--    <div class="specImage"><img src="--><?php //the_field('form_image', 'option')?><!--" alt=""></div>-->
      <h2 class="title"><?php the_field('form_title', 'option')?></h2>
      <div class="content_text"><?php the_field('form_subtitle', 'option')?></div>
        <div class="btnWrap">
          <a class="btn btn-padding" href="#mainForm" onclick="Index.changeSubject('<?php pll_e("Получить консультацию"); ?>')" data-fancybox=""><?php pll_e("Получить консультацию"); ?></a>
        </div>
      <?php // echo do_shortcode('[cf7form cf7key="kontaktnaya-forma-1"]')?>
    </div>
  </div>
</section>
<!--End Section-->