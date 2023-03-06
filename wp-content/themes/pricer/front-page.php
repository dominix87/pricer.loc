<?php get_header(); ?>
<!--Begin Section1-->
<section class="section1" id="section1">
  <div class="siteWidth">
    <h1 class="title"><?php the_field('block1_title')?></h1>
    <div class="content_text"><?php the_field('block1_subtitle')?></div>
    <div class="btnWrap">
      <a class="orange btn" href="#mainForm" onclick="Index.changeSubject('<?php pll_e('Запрос демо')?>')" data-fancybox><?php pll_e('Запрос демо')?></a>
      <a class="btn" href="#section4" onclick="Index.go_to(this, event)"><?php pll_e('Все возможности')?></a>
    </div>
    <div class="imgWrap">
      <img src="<?php echo get_template_directory_uri()?>/assets/img/svg/success_bg.svg" alt="">
      <a class="playBtn" data-fancybox href="<?php the_field('block1_playBtn_link')?>">
        <svg class="icon icon-playBtn ">
          <use xlink:href="<?php echo get_template_directory_uri()?>/assets/img/svg/sprite.svg#playBtn"></use>
        </svg>
        <span><?php pll_e('Текст кнопки play') ?></span>
      </a>
    </div>
    <h5 class="title"><?php the_field('block1_title2')?></h5>
    <div class="partnerBlock">
      <?php if(have_rows('block1_clients')) :
        while(have_rows('block1_clients')) : the_row() ?>
          <div class="partner"><img src="<?php the_sub_field('image'); ?>" alt=""></div>
      <?php endwhile;
      endif;
      ?>
    </div>
  </div>
</section>
<!--End Section-->
<!--Begin Section2-->
<section class="section2" id="section2">
  <div class="siteWidth">
    <h2 class="title"><?php the_field('block2_title')?></h2>
    <div class="contentWrapper">
      <?php if(have_rows('block2_tasks')) :
        while(have_rows('block2_tasks')) : the_row() ?>
          <div class="contentItem">
            <div class="imgWrap">
              <img src="<?php the_sub_field('image')?>" alt="">
            </div>
            <div class="title"><?php the_sub_field('title')?></div>
            <div class="text content_text"><?php the_field('text')?></div>
          </div>
        <?php endwhile;
      endif;
      ?>
    </div>
  </div>
</section>
<!--End Section-->
<!--Begin Section3-->
<section class="section3" id="section3">
  <div class="siteWidth">
    <h2 class="title"><?php the_field('block3_title')?></h2>
    <div class="content_text"><?php the_field('block3_subtitle')?></div>
    <div class="imgWrap">
      <img src="<?php the_field('block3_bigImg')?>" alt="">
      <?php if(have_rows('block3_tooltips')) :
        while(have_rows('block3_tooltips')) : the_row() ?>
          <div class="tooltip">
            <svg class="icon icon-info ">
              <use xlink:href="<?php echo get_template_directory_uri()?>/assets/img/svg/sprite.svg#info"></use>
            </svg>
            <span><?php the_sub_field('text')?></span>
          </div>
        <?php endwhile;
      endif;
      ?>
    </div>
  </div>
</section>
<!--End Section-->
<!--Begin Section4-->
<section class="section4" id="section4">
  <div class="siteWidth">
    <h2 class="title"><?php the_field('block4_title')?></h2>
    <div class="tabsBlock">
      <div class="tabsWrap">
        <?php if(have_rows('block4_possibilities')) :
          while(have_rows('block4_possibilities')) : the_row() ?>
            <?php if(get_row_index() == 1):?>
              <button class="tab active"><?php the_sub_field('title')?></button>
            <?php else :?>
              <button class="tab"><?php the_sub_field('title')?></button>
            <?php endif; ?>
        <?php endwhile;
        endif;
        ?>
      </div>
      <div class="tabsContentWrap">
        <?php if(have_rows('block4_possibilities')) :
          while(have_rows('block4_possibilities')) : the_row() ?>
            <?php if(get_row_index() == 1):?>
              <div class="tabContent active">
                <div class="contentWrapper">
                  <div class="leftSide">
                    <div class="imgWrap">
                      <img src="<?php the_sub_field('image')?>" alt="">
<!--                      --><?php //if(have_rows('tooltips')) :
//                        while(have_rows('tooltips')) : the_row() ?>
<!--                          <div class="tooltip">-->
<!--                            <svg class="icon icon-info ">-->
<!--                              <use xlink:href="--><?php //echo get_template_directory_uri()?><!--/assets/img/svg/sprite.svg#info"></use>-->
<!--                            </svg>-->
<!--                            <span>--><?php //the_sub_field('text')?><!--</span>-->
<!--                          </div>-->
<!--                        --><?php //endwhile;
//                        endif;?>
                    </div>
                  </div>
                  <div class="rightSide">
                    <h3 class="title"><?php the_sub_field('title')?></h3>
                    <div class="content_text"><?php the_sub_field('text')?></div>
                    <?php if(get_sub_field('page_link')):?>
                      <div class="btnWrap">
                        <a href="<?php the_sub_field('page_link')?>" class="btn orange"><?php pll_e('Подробнее')?></a>
                      </div>
                    <?php endif;?>
                  </div>
                </div>
              </div>
            <?php else :?>
              <div class="tabContent">
                <div class="contentWrapper">
                  <div class="leftSide">
                    <div class="imgWrap">
                      <img src="<?php the_sub_field('image')?>" alt=""></div>
                  </div>
                  <div class="rightSide">
                    <h3 class="title"><?php the_sub_field('title')?></h3>
                    <div class="content_text"><?php the_sub_field('text')?></div>
                    <?php if(get_sub_field('page_link')):?>
                      <div class="btnWrap">
                        <a href="<?php the_sub_field('page_link')?>" class="btn orange"><?php pll_e('Подробнее')?></a>
                      </div>
                    <?php endif;?>
                  </div>
                </div>
              </div>
            <?php endif; ?>
          <?php endwhile;
        endif;
        ?>
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
      <div class="sliderBlock">

        <?php if(have_rows('block4_possibilities')) :
          while(have_rows('block4_possibilities')) : the_row() ?>
            <?php if(get_row_index() == 1):?>
              <div class="sliderItem">
                <div class="imgWrap"><img src="<?php the_sub_field('image')?>" alt="">
                  <?php if(have_rows('tooltips')) :
                    while(have_rows('tooltips')) : the_row() ?>
                      <div class="tooltip">
                        <svg class="icon icon-info ">
                          <use xlink:href="<?php echo get_template_directory_uri()?>/assets/img/svg/sprite.svg#info"></use>
                        </svg>
                        <span><?php the_sub_field('text')?>></span>
                      </div>
                    <?php endwhile;
                  endif;?>
                </div>
                <div class="textWrap">
                  <div class="title"><?php the_sub_field('title')?></div>
                  <div class="content_text text"><?php the_sub_field('text')?></div>
                  <?php if(get_sub_field('page_link')):?>
                    <div class="btnWrap">
                      <a href="<?php the_sub_field('page_link')?>" class="btn orange"><?php the_field('block4_btnText')?></a>
                    </div>
                  <?php endif;?>
                </div>
              </div>
            <?php else :?>
              <div class="sliderItem">
                <div class="imgWrap"><img src="<?php the_sub_field('image')?>" alt=""></div>
                <div class="textWrap">
                  <div class="title"><?php the_sub_field('title')?></div>
                  <div class="content_text text"><?php the_sub_field('text')?></div>
                  <?php if(get_sub_field('page_link')):?>
                    <div class="btnWrap">
                      <a href="<?php the_sub_field('page_link')?>" class="btn orange"><?php the_field('block4_btnText')?></a>
                    </div>
                  <?php endif;?>
                </div>
              </div>
            <?php endif; ?>
          <?php endwhile;
        endif;
        ?>
      </div>
    </div>
  </div>
</section>
<!--End Section-->
<!--Begin Section5-->
<section class="section5" id="section5">
  <div class="siteWidth">
    <div class="innerWrapper">
      <h3 class="title"><?php the_field('block5_title')?></h3>
      <div class="content_text"><?php the_field('block5_subtitle')?></div>
        <div class="btnWrap">
            <a class="btn btn-padding" href="#mainForm" onclick="Index.changeSubject('<?php pll_e("Получить консультацию"); ?>')" data-fancybox=""><?php pll_e("Получить консультацию"); ?></a>
        </div>
      <?php // echo do_shortcode('[cf7form cf7key="kontaktnaya-forma-1"]')?>
<!--      <form onsubmit="Index.sendInit(this);return false" novalidate>-->
<!--        <input type="hidden" name="project_name" value="___">-->
<!--        <input type="hidden" name="admin_email" value="">-->
<!--        <input type="hidden" name="registration_type" value="pop-up форма">-->
<!--        <input type="hidden" name="order_type" value="Call request">-->
<!--        <input type="hidden" name="page_url" value="">-->
<!--        <input type="hidden" name="user_agent" value="&lt;?php echo $user_agent?&gt;">-->
<!--        <input type="hidden" name="utm_source" value="&lt;?php echo $data[&quot;utm_source&quot;]?&gt;">-->
<!--        <input type="hidden" name="utm_campaign" value="&lt;?php echo $data[&quot;utm_campaign&quot;]?&gt;">-->
<!--        <input type="hidden" name="utm_medium" value="&lt;?php echo $data[&quot;utm_medium&quot;]?&gt;">-->
<!--        <input type="hidden" name="utm_term" value="&lt;?php echo $data[&quot;utm_term&quot;]?&gt;">-->
<!--        <input type="hidden" name="utm_content" value="&lt;?php echo $data[&quot;utm_content&quot;]?&gt;">-->
<!--        <input type="hidden" name="ref" value="&lt;?php echo $data[&quot;ref&quot;]?&gt;">-->
<!--        <input type="hidden" name="ip_address" value="&lt;?php echo $data[&quot;ip_address&quot;]?&gt;">-->
<!--        <input type="hidden" name="city" value="">-->
<!--        <input type="hidden" name="region" value="">-->
<!--        <input type="hidden" name="country" value="">-->
<!--        <input type="hidden" name="client_id" value="&lt;?php echo $data[&quot;client_id&quot;]?&gt;">-->
<!--        <input type="hidden" name="utmcsr" value="&lt;?php echo $data[&quot;utmcsr&quot;]?&gt;">-->
<!--        <input type="hidden" name="utmccn" value="&lt;?php echo $data[&quot;utmccn&quot;]?&gt;">-->
<!--        <input type="hidden" name="utmcmd" value="&lt;?php echo $data[&quot;utmcmd&quot;]?&gt;">-->
<!--        <input type="hidden" name="click_id" value="&lt;?php echo $data[&quot;click_id&quot;]?&gt;">-->
<!--        <input type="hidden" name="affilliate_id" value="&lt;?php echo $data[&quot;affiliate_id&quot;]?&gt;">-->
<!--        <div class="inputWrapper name">-->
<!--          <input type="text" name="name" placeholder="Имя" required>-->
<!--        </div>-->
<!--        <div class="inputWrapper phone">-->
<!--          <input type="text" name="phone" placeholder="Телефон" required>-->
<!--        </div>-->
<!--        <div class="inputWrapper company">-->
<!--          <input type="text" name="company" placeholder="Компания" required>-->
<!--        </div>-->
<!--        <div class="btnWrap">-->
<!--          <button class="btn">Получить консультацию</button>-->
<!--        </div>-->
<!--      </form>-->
    </div>
  </div>
</section>
<!--End Section-->
<!--Begin Section6-->
<section class="section6" id="section6">
  <div class="siteWidth">
    <h2 class="title"><?php the_field('block6_title')?></h2>
    <div class="contentWrapper">
      <?php if(have_rows('block6_steps')) :
        while(have_rows('block6_steps')) : the_row() ?>
          <div class="contentItem">
            <div class="imgWrap">
              <img src="<?php the_sub_field('image')?>" alt="">
            </div>
            <div class="title"><?php the_sub_field('title')?></div>
            <div class="content_text"><?php the_sub_field('text')?></div>
          </div>
        <?php endwhile;
      endif;
      ?>
    </div>
  </div>
</section>
<!--End Section-->
<!--Begin Section7-->
<section class="section7" id="section7">
  <div class="siteWidth">
    <div class="topSide">
      <?php /*<div class="leftSide">
        <div class="imgWrap"><img src="<?php the_field('block7_image')?>" alt=""></div>
      </div>*/ ?>
      <div class="rightSide">
        <h2 class="title"><?php the_field('block7_title')?></h2>
          <div class="home_two_columns">
              <div class="home_two_columns_img"><img src="/wp-content/themes/pricer/assets/img/svg/robot.svg" width="105" height="113"></div>
              <div class="home_two_columns_text"><div class="content_text"><?php the_field('block7_subtitle')?></div></div>
          </div>
        <div class="btnWrap">
            <?php /*  ?>
<!--          <a href="--><?php //the_field('block7_btn_link')?><!--" class="btn">--><?php //pll_e('О нас')?><!--</a>-->
          <a class="btn" data-fancybox href="#mainForm" onclick="Index.changeSubject('<?php the_field('block7_btnText')?>')"><?php the_field('block7_btnText')?></a>
            <?php /* */ ?>
        </div>
      </div>
    </div>
    <div class="bottomSide">
      <?php if(have_rows('block7_info')) :
        while(have_rows('block7_info')) : the_row() ?>
          <div class="contentItem">
            <div class="int"><?php the_sub_field('top')?></div>
            <div class="content_text"><?php the_sub_field('bottom')?></div>
          </div>
        <?php endwhile;
      endif;
      ?>
    </div>
  </div>
</section>
<!--End Section-->
<!--Begin Section8-->
<section class="section8" id="section8">
  <div class="siteWidth">
    <h2 class="title"><?php the_field('block8_title')?></h2>
    <div class="sliderBlock">

      <?php if(have_rows('block8_cases')) :
        while(have_rows('block8_cases')) : the_row() ?>
          <div class="sliderItem">
            <div class="company"><img src="<?php the_sub_field('image')?>" alt=""></div>
            <h4 class="title"><?php the_sub_field('title')?></h4>
            <div class="content_text"><?php the_sub_field('text')?></div>
            <div class="sphere"><?php the_sub_field('sphere')?></div>
            <div class="btnsWrap">
              <a class="btn orange" data-fancybox href="#mainForm" onclick="Index.changeSubject('<?php pll_e('Хотим так же') ?>')"><?php pll_e('Хотим так же')?></a>
              <a href="<?php the_sub_field('rightBtn_link')?>" target="_blank" class="btn transparent"><?php pll_e('Ознакомиться с кейсом')?></a>
            </div>
          </div>
        <?php endwhile;
      endif;
      ?>
    </div>
  </div>
</section>
<!--End Section-->

<?php echo get_template_part ('includes/form')?>









<!--Begin Section10-->
<section class="section10" id="section10">
  <div class="siteWidth">
    <h2 class="title"><?php the_field('block10_title')?></h2>
    <div class="accordionBlock">
      <?php if(have_rows('block10_answers')) :
        while(have_rows('block10_answers')) : the_row() ?>
          <?php if(get_row_index() == 1):?>
          <div class="accordionItem active">
          <?php else :?>
            <div class="accordionItem">
          <?php endif; ?>
            <div class="itemTitle"><?php the_sub_field('title')?></div>
            <div class="switcher"></div>
            <div class="itemText content_text"><?php the_sub_field('text')?></div>
          </div>
        <?php endwhile;
      endif ;?>
    </div>
  </div>
</section>
<!--End Section-->
<?php get_footer(); ?>
