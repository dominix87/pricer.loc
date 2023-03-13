$(function()
{
  Index.init();
});
var Index =
  {
    init:function()
    {

      $.get("https://ipinfo.io", function(response) {
        $('input[name=city]').val(response.city);
        $('input[name=region]').val(response.region + ', ' + response.country);
        $('input[name=country]').val(response.country);
      }, "jsonp");

      const observer = lozad();
      observer.observe();

      $("[data-fancybox]").fancybox({
        beforeShow: function(){
          var inputWrapper = $('.inputWrapper', 'form');

          $(inputWrapper).each(function(){
            if($(this).hasClass('error')){
              $(this).removeClass('error');
              $(this).find('.allert').remove();
            }
          })
        }
      });

      $('input[name=phone]').mask('+38(099)999-99-99');

      $('.tabContent','.tabsBlock').not(':first').slideUp('slow');

      $('.accordionItem','.accordionBlock').not(':first').find('.itemText').slideUp('slow');


      if($(window).width() > 576){
        $(window).resize(function() {
          location.reload();
        });
      }



      Index.crutch();
      Index.tinyAnimation();
      Index.tabsInit();
      Index.accordionInit();
      Index.sliderInit();
      Index.typeItText();
      Index.initRRCSlider();
      Index.initTabsSlider();
      Index.specialAccordionInit();
      Index.menuToggler();
      Index.langSwitcher();
      Index.newMainSlider();
      if($(window).width() < 769){
        Index.initRRCMobileSlider();
      }
    },

     facebookShare: function(){
        event.preventDefault();
        windowLocation = window.location.href.replace(window.location.hash, '');

        window.open( 'https://www.facebook.com/sharer/sharer.php?u='+windowLocation, "facebookWindow", "height=380,width=660,resizable=0,toolbar=0,menubar=0,status=0,location=0,scrollbars=0" )
        return false;
      },
      twitterShare: function(){
        event.preventDefault();
        windowLocation = window.location.href.replace(window.location.hash, '');
        if($(".section-title h1").length > 0) {
          var $pageTitle = encodeURIComponent($(".section-title h1").text());
        } else {
          var $pageTitle = encodeURIComponent($(document).find("title").text());
        }
        window.open( 'http://twitter.com/intent/tweet?text='+$pageTitle +' '+windowLocation, "twitterWindow", "height=380,width=660,resizable=0,toolbar=0,menubar=0,status=0,location=0,scrollbars=0" )
        return false;
      },


    newMainSlider: function(){
      let slider = $('.sliderBlock','.indexSection5');
      $(slider).slick({
        slidesToShow: 3,
        centerMode: true,
        focusOnSelect: true,
        centerPadding: '0px',
        prevArrow: '<button class="slick-arrow arrowPrev" type="button"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M15 19.9201L8.48003 13.4001C7.71003 12.6301 7.71003 11.3701 8.48003 10.6001L15 4.08008" stroke="white" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/></svg></button>',
        nextArrow: '<button class="slick-arrow arrowNext" type="button"><svg width="24" style="transform: rotate(180deg)" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M15 19.9201L8.48003 13.4001C7.71003 12.6301 7.71003 11.3701 8.48003 10.6001L15 4.08008" stroke="white" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/></svg></button>'
      })


    },

    menuToggler: function(){
      if($(window).width() < 991) {
        let btn = $('.menuSwitcher');

        $(btn).on('click', (el) => {
          let menuID = $(el.currentTarget).data('menuid');
          let parent = $(el.currentTarget).parent();

          if($('#' + menuID).hasClass('active')){
            $('.subMenu').removeClass('active');
            $(parent).removeClass('active');
          } else{
            $('.menuSwitcher').parent().removeClass('active');
            $(parent).addClass('active');
            $('.subMenu').removeClass('active');
            $('#' + menuID).addClass('active');
          }
        });

        $(document).mouseup(function (e) {
          let div = $('#mobMenu');
          if (!div.is(e.target) && div.has(e.target).length === 0) {
            $('.subMenu').removeClass('active');

          }
        });
      }
    },
    langSwitcher: function(){
      let langParent = $('.langBlock', 'header');
      let langBtn = $('button', '.langBlock');
      if($(window).width() > 991) {
        $(langParent).on('mouseenter', function () {
          $('.langList', 'header').addClass('active');
        })
        $(langParent).on('mouseleave', function () {
          $('.langList', 'header').removeClass('active');
        })
      } else {
        $(langBtn).on('click', function(){
          $('.langList', 'header').toggleClass('active');
        })
        $(document).mouseup(function(e){
          let div = $(langParent);
          if(!div.is(e.target) && div.has(e.target).length === 0){
            $('.langList', 'header').removeClass('active');
          }
        });
      }
    },

    changeSubject: function(fThis){
      var mainForm = $('#mainForm')

      $(mainForm).find('[name=emailSubject]').val(fThis);
    },

    specialAccordionInit: function(){
      var accordion = $('.SpecialAccordionBlock');
      var item = $('.accordionItem',accordion);

      $(item).on('click', function(){
        $(item).not(this).removeClass('active');
        $(this).addClass('active');
      })
    },

    initTabsSlider: function(){
      var slider = $('.sliderBlock', '.section4');
      var countBlock = $('.countBlock','.section4');
      var controlBlock = $('.controlBlock', '.section4');
      var left = $('.arrow__left','.section4');
      var right = $('.arrow__right','.section4');


      $(slider).on('init', function(event, slick){
        var title = $('.sliderItem.slick-current', slider).find('.title').text();
        $(countBlock).text('1\u00A0/\u00A0' + slick.slideCount);
        $(controlBlock).find('.title').text(title);
        $(controlBlock).find('.countBlock').text('1\u00A0/\u00A0' + slick.slideCount);
        console.log(controlBlock);
      })

      $(slider).slick({

      });

      $(left).on('click', function(){
        $(slider).slick('slickPrev')
      })
      $(right).on('click', function(){
        $(slider).slick('slickNext')
      })

      $(slider).on('afterChange', function(e, slick, currentSlide){
        var current = currentSlide + 1;
        var title = $('.sliderItem.slick-current', slider).find('.title').text();

        $(controlBlock).find('.title').text(title);
        $(controlBlock).find('.countBlock').text(current + '\u00A0/\u00A0' + slick.slideCount);
      });

    },

    initRRCMobileSlider: function(){
      var slider = $('.sliderBlockSecond', '.section12');
      var countBlock = $('.countBlock','.mobileSliderBlock');
      var controlBlock = $('.controlBlock', '.mobileSliderBlock');
      var left = $('.arrow__left','.mobileSliderBlock');
      var right = $('.arrow__right','.mobileSliderBlock');


      $(slider).on('init', function(event, slick){
        var title = $('.sliderItem.slick-current', slider).find('.title').text();
        $(countBlock).text('1\u00A0/\u00A0' + slick.slideCount);
        $(controlBlock).find('.title').text(title);
        $(controlBlock).find('.countBlock').text('1\u00A0/\u00A0' + slick.slideCount);
      })

      $(slider).slick({

      });

      $(left).on('click', function(){
        $(slider).slick('slickPrev')
      })
      $(right).on('click', function(){
        $(slider).slick('slickNext')
      })

      $(slider).on('afterChange', function(e, slick, currentSlide){
        var current = currentSlide + 1;
        var title = $('.sliderItem.slick-current', slider).find('.title').text();

        // if($(window).width() < 576){
        //   if(title.length > 33){
        //     title = title.substr(0, 33);
        //     title = title + '...';
        //   }
        // }

        $(controlBlock).find('.title').text(title);
        $(controlBlock).find('.countBlock').text(current + '\u00A0/\u00A0' + slick.slideCount);
      });
    },

    initRRCSlider: function(){
     var slider = $('.sliderBlockFirst', '.section12');
     var countBlock = $('.rightSide .countBlock','.section12');
     var infoBlock = $('.rightSide .sliderInfoBlock','.section12');
     var controlBlock = $('.rightSide .controlBlock', '.section12');
     var left = $('.rightSide .arrow__left','.section12');
     var right = $('.rightSide .arrow__right','.section12');


      $(slider).on('init', function(event, slick){
        var title = $('.infoItem.active', infoBlock).find('.title').text();
        $(countBlock).text('1\u00A0/\u00A0' + slick.slideCount);
        $(controlBlock).find('.title').text(title);
        $(controlBlock).find('.countBlock').text('1\u00A0/\u00A0' + slick.slideCount);
        console.log(controlBlock);
      })

     $(slider).slick({
        responsive:[
          {
            breakpoint: 769,
            settings: "unslick"
          }
        ]
     });

    $(left).on('click', function(){
      $(slider).slick('slickPrev')
    })
    $(right).on('click', function(){
      $(slider).slick('slickNext')
    })
      $(slider).on('beforeChange', function(e, slick, currentSlide, nextSlide){

        $('.infoItem',infoBlock).removeClass('active');
        $('.infoItem',infoBlock).eq(nextSlide).addClass('active');
      })


     $(slider).on('afterChange', function(e, slick, currentSlide){
       var current = currentSlide + 1;

       $(countBlock).text(current + '\u00A0/\u00A0' + slick.slideCount)
       var title = $('.infoItem.active', infoBlock).find('.title').text();

       $(controlBlock).find('.title').text(title);
       $(controlBlock).find('.countBlock').text(current + '\u00A0/\u00A0' + slick.slideCount);
     });

    },



    typeItText:function(){
      if (document.getElementById("typeMe")){
        new Typed('#typeMe', {
          strings: ['понятной аналитики', 'анализа рынка', 'мониторинга РРЦ', 'анализа конкурентов'],
          showCursor: false,
          typeSpeed: 75,
          loop: true,
          fadeOut: true
        })
      }
      if (document.getElementById("typeMeEng")){
        new Typed('#typeMeEng', {
          strings: ['clear analytics', 'market analysis', 'competitor analysis', 'MSRP monitoring'],
          showCursor: false,
          typeSpeed: 75,
          loop: true,
          fadeOut: true
        })
      }
      if (document.getElementById("typeMeUkr")){
        new Typed('#typeMeUkr', {
          strings: ['аналізу конкурентів', 'зрозумілої аналітики', 'аналізу ринку', 'моніторингу РРЦ'],
          showCursor: false,
          typeSpeed: 75,
          loop: true,
          fadeOut: true
        })
      }
    },

    // toggleLang: function(){
    //   $('header').find('.langList').toggleClass('active');
    // },

    accordionInit: function(){
      let item = $('.accordionItem', '.accordionBlock');
      let title = $('.itemTitle', item);
      let switcher = $('.switcher', item);
      $(title).on('click', function(){
        if($(this).parent().hasClass('active')){
          $(title).parent().removeClass('active');
          $(title).nextAll('.itemText').slideUp('slow');
        }
        else{
          $(title).parent().removeClass('active');
          $(title).nextAll('.itemText').slideUp('slow');

          $(this).parent().addClass('active');
          $(this).nextAll('.itemText').slideDown('slow');
        }
      });
      $(switcher).on('click', function(){
        if($(this).parent().hasClass('active')){
          $(title).parent().removeClass('active');
          $(title).nextAll('.itemText').slideUp('slow');
        }
        else{
          $(title).parent().removeClass('active');
          $(title).nextAll('.itemText').slideUp('slow');

          $(this).parent().addClass('active');
          $(this).nextAll('.itemText').slideDown('slow');
        }
      })
    },

    sliderInit: function(){
      let slider = $('.sliderBlock', '.section8');

      $(slider).slick({
        prevArrow: '<button class="slick-arrow arrow__prev"><svg viewBox="0 0 24 16" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M23 9C23.5523 9 24 8.55228 24 8C24 7.44772 23.5523 7 23 7L23 9ZM0.292892 7.2929C-0.0976315 7.68342 -0.0976314 8.31658 0.292893 8.70711L6.65686 15.0711C7.04738 15.4616 7.68054 15.4616 8.07107 15.0711C8.46159 14.6805 8.46159 14.0474 8.07107 13.6569L2.41421 8L8.07107 2.34315C8.46159 1.95262 8.46159 1.31946 8.07107 0.928933C7.68054 0.538409 7.04738 0.538409 6.65685 0.928934L0.292892 7.2929ZM23 7L1 7L1 9L23 9L23 7Z" fill="white"/></svg></button>',
        nextArrow: '<button class="slick-arrow arrow__next"><svg viewBox="0 0 24 16" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1 7C0.447715 7 0 7.44772 0 8C0 8.55228 0.447715 9 1 9L1 7ZM23.7071 8.70711C24.0976 8.31658 24.0976 7.68342 23.7071 7.29289L17.3431 0.928932C16.9526 0.538408 16.3195 0.538408 15.9289 0.928932C15.5384 1.31946 15.5384 1.95262 15.9289 2.34315L21.5858 8L15.9289 13.6569C15.5384 14.0474 15.5384 14.6805 15.9289 15.0711C16.3195 15.4616 16.9526 15.4616 17.3431 15.0711L23.7071 8.70711ZM1 9L23 9L23 7L1 7L1 9Z" fill="white"/></svg></button>'
      })
    },


    tabsInit: function(){
      let tab = $('.tab','.tabsBlock');
      let tabContent = $('.tabContent','.tabsBlock');

      $(tab).on('click', function(){
        $(tab).removeClass('active');
        $(tabContent).removeClass('active').hide();

        $(this).addClass('active');
        $(tabContent).eq($(this).index()).addClass('active').fadeIn('slow');
      })
    },

    crutch: function(){
      $('.openMenu', 'header').click(function () {
        $('img[data-src]').each(function () {
          $(this).attr('src', $(this).data('src'));
        })
      });

      $('#mobMenu').hover(function () {
        $('img[data-src]').each(function () {
          $(this).attr('src', $(this).data('src'));

        })
      });
    },

    tinyAnimation: function(){
      $('.empty','.section1').addClass('run');
      setTimeout(function(){
        $('.animated','.section1').addClass('visible fadeInUp');
      }, 1500);
      $('svg', '.section3').viewportChecker({
        classToAdd: 'run',
        offset: 100,
      });
    },


    //Инициализация прокрутки
    go_to:function(fThis, e, topOffset){

      var topOffset = (topOffset === undefined) ? 0 : topOffset;


      if($(window).width() < 991){
        $('.closeMenu','#mobMenu').click();
      }

      e.preventDefault();
      var id = $(fThis).attr('href');
      if( $(id).length != 0)
      {
        $('html, body').animate({scrollTop: ($(id).offset().top) - topOffset}, 1500);
      }
    },

    sendInit: function (fThis){

      var warning_ico = '<svg version="1.1" class="warning_ico" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 292.805 292.805" xml:space="preserve"><path style="fill:#ff0000" d="M137.583,18.265L1.709,259.709c-4.933,8.767,1.402,19.601,11.462,19.599c57.413-0.01,208.901-0.037,266.469-0.047c10.059-0.002,16.388-10.833,11.454-19.598c-44.565-79.158-135.89-241.399-135.89-241.399C151.62,11.907,141.167,11.907,137.583,18.265z M145.761,248.714c-10.028,0-18.162-8.136-18.162-18.163c0-10.029,8.134-18.165,18.162-18.165c10.03,0,18.165,8.136,18.165,18.165C163.926,240.578,155.791,248.714,145.761,248.714zM160.925,98.708c0.023,0.487,0.02,0.992,0,1.471l-5.05,104.048c-3.149-1.214-6.539-1.948-10.114-1.948c-3.572,0-6.963,0.734-10.112,1.948l-5.05-104.048c-0.402-8.376,6.051-15.493,14.428-15.898C153.403,83.876,160.52,90.332,160.925,98.708z"/></svg>';
      var error_mess_1 = '<div class="allert"><span>поле обязательное к заполнению</span>' + warning_ico + '</div>';
      var error_mess_2 = '<div class="allert"><span>Введите корректное имя</span>' + warning_ico + '</div>';
      var error_mess_3 = '<div class="allert"><span>Введите корректный e-mail</span>' + warning_ico + '</div>';
      var error_mess_4 = '<div class="allert"><span>Введите коректний номер телефону</span>' + warning_ico + '</div>';


      $('.inputWrapper').each(function(){
        $(this).removeClass('error');
      });
      $(':input.error').removeClass('error');
      $('.allert').remove();


      var sbmBtn = $(fThis).find('.btn'),
        ref = $(fThis).find('[required]'),
        formData = $(fThis).serializeArray(),
        error = 0;

      $(ref).each(function() {
        if ($(this).val() == '') {
          var errorfield = $(this);
          $(this).closest('.inputWrapper').addClass('error').append(error_mess_1);
          error = 1;
          $(':input.error:first').focus();
          return;
        }
        else {
          if ($(this).attr('type') == 'text') {
            var thisValueL = $(this).val().length;
            if (thisValueL < 3) {
              var errorfield = $(this);
              $(this).closest('.inputWrapper').addClass('error').append(error_mess_2);
              error = 1;
              $(':input.error:first').focus();
            }
          }
          // if ($(this).attr('type') == 'tel') {
          //   if ($(this).hasClass('is-complete')) {
          //   } else {
          //     error = 1;
          //     $(':input.error:first').focus();
          //     $(this).closest('.inputWrapper').addClass('error').append(error_mess_4);
          //   }
          // }
          if($(this).attr('type') == 'email'){
            console.log($(this).val());
            var pattern =/^[a-z0-9_-]+@[a-z0-9-]+\.([a-z]{1,6}\.)?[a-z]{2,6}$/i;
            if(pattern.test($(this).val())){
            }
            else{
              error = 1;
              $(':input.error:first').focus();
              $(this).closest('.inputWrapper').addClass('error').append(error_mess_3);
            }
          }
        }
      });

      if(error == 0)
      {
        $(sbmBtn).attr('disabled','disabled');
        $(fThis).trigger('reset');
        $(location).attr('href', '../success.html')
        // setTimeout(function(){
        //   $(location).attr('href', 'success.html')
        // }, 5000);
        // $.ajax(
        //     {
        //       url: "db/registration.php",
        //       cache: false,
        //       type: "POST",
        //       data: formData,
        //       dataType: "json",
        //       success: function(data){
        //         if(data.status == 'ok'){
        //           $(location).attr('href', '/success.html');
        //         }
        //       },
        //       error: function(){
        //         console.log('ALARM ERROR');
        //       }
        //     }
        // );
      }
      else{
        console.log('error')
      }
    },


    toggleMenu: function(fThis){
      $(fThis).toggleClass('active');
      $('#mobMenu').toggleClass('active');
      $('body').toggleClass('menuActive');
    },

    openMenu:function(){
      $('#mobMenu').css('left', 0);
      $('body').addClass('menuActive');
    },

    closeMenu:function(){
      $('#mobMenu').css('left', '-100%');
      $('body').removeClass('menuActive');
    },

    openYoutube:function(fThis){
      var e = "https://www.youtube.com/embed/" + fThis.id + "?autoplay=1&autohide=1&border=0&wmode=opaque&enablejsapi=1";
      $(fThis).find('.playBtn').hide();
      $(fThis).data("params") && (e += "&" + $(fThis).data("params"));
      var a = $("<iframe/>", {class:"el", frameborder: "0", src: e, width: $(fThis).width(), height: $(fThis).height()});
      $(fThis).replaceWith(a)
    },


    svgLength: function(){
      var path = document.querySelector('#testSVG'),
        len = Math.round( path.getTotalLength() );
      alert('длина ' + len);
    }

  };