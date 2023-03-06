<footer>
  <div class="footerTopSuccess">
    <div class="siteWidth">
      <div class="innerWrapper"><a class="logo" href="<?php echo home_url('/');?>">
          <svg class="icon icon-bottom_logo ">
            <use xlink:href="<?php echo get_template_directory_uri()?>/assets/img/svg/sprite.svg#bottom_logo"></use>
          </svg></a>
          <?php /*  ?>
        <div class="phoneBlock"><a href="tel:<?php echo str_replace(array(' ',')','('), array('','',''), get_field('phone', 'option'))?>"><?php the_field('phone', 'option')?></a>
          <a class="spec" href="#mainForm" data-fancybox onclick="Index.changeSubject('Перезвоните мне')" ><?php the_field('callbackBtn_text', 'option')?></a>
        </div>
        <?php if(get_field('telegram_link', 'option') && get_field('viber_link', 'option') && get_field('messenger_link', 'option')) : ?>
        <div class="socialsBlock">
          <?php if(get_field('telegram_link', 'option')) : ?>
            <a class="telegram" href="<?php the_field('telegram_link', 'option')?>" rel="nofollow" target="_blank">
              <svg class="icon icon-telegram ">
                <use xlink:href="<?php echo get_template_directory_uri()?>/assets/img/svg/sprite.svg#telegram"></use>
              </svg>
            </a>
          <?php endif;?>
          <?php if(get_field('viber_link', 'option')) : ?>
            <a class="viber" href="<?php the_field('viber_link', 'option')?>" rel="nofollow" target="_blank">
              <svg class="icon icon-viber ">
                <use xlink:href="<?php echo get_template_directory_uri()?>/assets/img/svg/sprite.svg#viber"></use>
              </svg>
            </a>
          <?php endif;?>
          <?php if(get_field('messenger_link', 'option')) : ?>
            <a class="messenger" href="<?php the_field('messenger_link', 'option')?>" rel="nofollow" target="_blank">
              <svg class="icon icon-messenger ">
                <use xlink:href="<?php echo get_template_directory_uri()?>/assets/img/svg/sprite.svg#messenger"></use>
              </svg>
            </a>
          <?php endif;?>
        </div>
        <?php endif; ?>
          <?php /* */ ?>
      </div>
    </div>
  </div>
  <div class="footerBottom">
    <div class="siteWidth">
      <div class="innerWrapper">
        <div class="copyright"><?php the_field('copyright', 'option')?></div>
        <div class="rezartLogoBlock"><a href="https://rezart.agency" target="_blank">
            <svg class="icon icon-rezart_logo ">
              <use xlink:href="<?php echo get_template_directory_uri()?>/assets/img/svg/sprite.svg#rezart_logo"></use>
            </svg></a></div>
      </div>
    </div>
  </div>
</footer>

<div class="hiddenBlock">
  <div class="orderPanel" id="mainForm">
    <div class="wrapper">
      <p class="title"><?php the_field('popup_form_title', 'option')?></p>
      <p class="text"><?php the_field('popup_form_text', 'option')?></p>
      <?php echo do_shortcode('[contact-form-7 id="6" title="Контактная форма основная"]')?>
    </div>
  </div>
</div>



<?php wp_footer(); ?>

</body>
</html>