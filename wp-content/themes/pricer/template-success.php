<?php
/*
Template Name: Шаблон для Страницы Спасибо
Template Post Type: page
*/
 get_header('success')?>
<section class="success">
  <div class="siteWidth container-fluid">
    <div class="innerWrapper">
      <h2 class="title"><?php the_field('primary_text')?></h2>
      <div class="btnWrap">
        <a class="btn" href="<?php echo home_url('/');?>"><?php the_field('btn_text')?></a></div>
    </div>
  </div>
</section>
<?php get_footer('success')?>
