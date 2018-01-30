/*
CAROSEL FOR FEATURED JOB POST
*/

(function($){

  $.fn.featuredPostCarosel = function(options){

    var $this = $(this);

    // check first if there are posts
    if($this.find('.post-item').length == 0)
    {
      $this.find('.post-container').html('<h3 style="position:absolute; top:50%; left:50%; transform:translateY(-50%) translateX(-50%)">No hiring posts.</h3>');
      return false;
    }

    // vars
    var post_item_width = $this.find('.post-item').width();
    var post_item_margin_left = $this.find('.post-item').css('margin-right').replace('px','');
    var currentIndex = 1;
    var ran = Math.random();
    var mouse_over = false;

    $(this).find('.wing').css({'left':'50%'});

    // default settings
    var settings = $.extend({
      interval:3000
    });

    // trigger auto slide
    autoSlide(ran);

    function resetAutoSlide(){

      // change ran value so that other pending autoSlides will be cancelled
      ran = Math.random();

      var _ran = ran;
      setTimeout(function(){
        autoSlide(_ran);
      },settings.interval);

    }

    function autoSlide(_ran){

      // check _ran matches current ran
      if(_ran == ran && !mouse_over){
        if(currentIndex < 4){
          currentIndex++;
        }
        else
        {
          currentIndex = 0;
        }

        goSlide(currentIndex);

        setTimeout(function(){
            autoSlide(_ran);
        }, settings.interval);
      }

    };

    // left navigation
    $this.find('.left').click(function(){
      if(currentIndex > 0){
        goSlide(currentIndex - 1);
      }
      else
      {
        goSlide(4);
      }
      resetAutoSlide();
    });

    // right navigation
    $this.find('.right').click(function(){
      if(currentIndex < 4){
        goSlide(currentIndex + 1);
      }
      else
      {
        goSlide(0);
      }
      resetAutoSlide();
    });

    // indecator navigate event
    $this.find('.indicators li').click(function(){
      var index = $this.find('.indicators li').index(this);

      goSlide(index);
      resetAutoSlide();
    });

    // stop animation when mouse on top
    $this.mouseenter(function(){
      mouse_over = true;
    });

    // stop animation when mouse leaves
    $this.mouseleave(function(){
      mouse_over = false;
      resetAutoSlide();
    });


    // trigger a slide with ---index--- parameter
    function goSlide(index){

      currentIndex = index;
      var margin = (currentIndex * post_item_margin_left) + (currentIndex * 3) + (currentIndex * post_item_width) + (post_item_width / 2) + 0;
      $this.find('.post-item').removeClass('active');
      $this.find('.post-item').eq(currentIndex).addClass('active');

      // ellipsis other post
      // $this.find('.post-item').each(function(){
      //   var text = $(this).find('.requirements').data('requirements');
      //   var max_description = 50;
      //   var _result = '';

      //   for(var i = 0; i < max_description; i++){
      //     if(i < text.length){
      //       _result += text.charAt(i);
      //     }
      //   }

      //   $(this).find('.requirements').html(_result+'...');

      // });

      // remove ellipsis for active element
      var text = $this.find('.post-item').eq(currentIndex).find('.requirements').data('requirements');
      $this.find('.post-item').eq(currentIndex).find('.requirements').html(text);

      // make active element center by adjusting it's left margin
      $this.find('.wing').css({'margin-left':-margin});

      // trigger indicator update
      updateIndicator(index);

    }

    function updateIndicator(index){

      // remove active class for indicator list items
      $this.find('.indicators li').removeClass('active');

      // add active class for active list item
      $this.find('.indicators li').eq(index).addClass('active');
    }


    return this;
  };

}) (jQuery);
