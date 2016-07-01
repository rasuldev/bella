jQuery(document).ready(function(){

	/*********BIG SLIDER ON HOME PAGE****************/
    var glide = $('.slider').glide().data('api_glide');
    $(window).on('keyup', function (key) {
        if (key.keyCode === 13) {glide.jump(3, console.log('Wooo!'));}
    });
    $('.slider-arrow').on('click', function() {console.log(glide.current());});

    /**********SIDER POPULAR PRODUCT**************/
    $('.bxslider').bxSlider({
        minSlides: 1,
        maxSlides: 4,
        slideWidth: 1170,
        slideMargin: 10
    });

    /**********SLIDER PARTNER***********/
    $('.slider1').bxSlider({
        slideWidth: 200,
        minSlides: 1,
        maxSlides: 5,
        slideMargin: 10
    });

    /*********STARS ON PROD*********/
    $(".ico_star").hover(function(){
        $(this).prevAll().andSelf().css({'color':'#F7941D'});
    },
    function(){
        $(".ico_star").css({'color':'inherit'});
    });


    /*********MODAL WINDOW***********/
    $("#modal_window").fadeOut(); // hide modal form
    $(".close_win, .ico_close").click(function(){
        $("#modal_window").fadeOut();
    }); // close modal form

    $("#modal_window h4").delegate('i', 'click', function(){
        $("#modal_window").fadeOut();
    });// close modal form

    $("#auth, #auth_form_show").click(function(){
        $("#modal_window h4").html('Авторизация' + '<i class="ico_close"></i>');
        $("#registr_form").fadeOut(function(){
            $("#modal_window, #auth_form").css({"opacity":"1"}).fadeIn();
        });
    }); // show auth

    $("#registr, #registr_form_show").click(function(){
        $("#modal_window h4").html('Регистрация' + '<i class="ico_close"></i>');
        $("#auth_form").fadeOut(function(){
            $("#modal_window, #registr_form").css({"opacity":"1"}).fadeIn();
        });
    }); // show registr


    /**********AX SLIDER*************/
    var listImg = $(".mini_slide ul li"); // блок мини картинок
    var wMiniSlide = listImg.outerWidth(true); // узнаем ширину 1го мини слайда
    var countMiniSlide = listImg.length; //сколько всего картинок
    var wList  = $(".mini_slide ul").width(wMiniSlide * countMiniSlide); // это зачение будет шириной блока чтоб все блоки были в один список
    var wSlider = $("#ax_slider").width();

    /*при клике меняем картинку*/
    listImg.children("a").click(function(){
        listImg.children("a").removeClass("active");
        $(this).addClass("active");

        var getImgLink = $(this).attr("href");
        $(".ax_slide_img img")
            .fadeOut()
            .attr("src",getImgLink)
            .fadeIn();

        return false;

    });

    /*переключение мини слайдера*/
    $(".ax_nav_left").click(function(){
        var posNow = $(".mini_slide ul").css("left");//Какая позиция сейчас
        var posLeft =  (Math.abs(parseInt(posNow)) + wMiniSlide);

        if(posLeft < wSlider){
            $(".mini_slide ul").css({ "left": '-' + posLeft + 'px' });
        }

    });//left

    $(".ax_nav_right").click(function(){

        var posNow = $(".mini_slide ul").css("left");//Какая позиция сейчас
        var posRight =  (Math.abs(parseInt(posNow)) - wMiniSlide);
        $(".mini_slide ul").css({ "left": '-' + posRight + 'px' });

    });//right

    /****TABS*****/
    $(".tab_link a").click(function(){
        var thisTab = $(this);

        $(".tab_link a").removeClass("tab_act");
        thisTab.addClass("tab_act");

        $('.tab_link ~ div[id^="tab"]').fadeOut(function(){
            $(thisTab.attr("href")).fadeOut().fadeIn();
        });

        return false;
    });


    /*SCROLL TOP*/
    jQuery(window).scroll(function () {
        if(jQuery(this).scrollTop() > 600) {
            jQuery('a.but_top').fadeIn();
        } else {
            jQuery('a.but_top').fadeOut();
        }
    });
    jQuery('a.but_top').click(function () {
        jQuery('body,html').animate({scrollTop: 0}, 400); return false;
    });


    // AUTOLOAD CODE BLOCK (MAY BE CHANGED OR REMOVED)
    if (!/android|iphone|ipod|series60|symbian|windows ce|blackberry/i.test(navigator.userAgent)) {
        jQuery(function($) {
            // $("a[rel^='lightbox']").slimbox({/* Put custom options here */}, null, function(el) {
                // return (this == el) || ((this.rel.length > 8) && (this.rel == el.rel));
            // });
        });
    }

    /*show search*/
    $(".click_search").click(function(){
        $(this).hide();
        $("header .search form ").animate({"width":"252"},1000);
    });

    /*show menu*/
    $("header .burger_menu").click(function(){
        $(".menu_home_page").slideToggle();
    });

    /*show filter*/
    $(".sidebar .burger_menu").click(function(){
        $(".sidebar .filtr_prod , .sidebar .price_filter").slideToggle();
    });

    /**********PRICE SLIDER***********/

    $("#slider-range").slider({
        range: true,
        min: parseInt($("#min_price_range").val()),
        max: parseInt($("#max_price_range").val()),
        values: [ parseInt($("#min_price_start").val()), parseInt($("#max_price_start").val()) ],
        slide: function( event, ui ) {
            $( "#min_price" ).val(ui.values[ 0 ]);
            $( "#max_price" ).val(ui.values[ 1 ]);
        }
    });
    $( "#min_price" ).val($( "#slider-range" ).slider( "values", 0 ) + "₽");
    $( "#max_price" ).val($( "#slider-range" ).slider( "values", 1 ) + "₽");


});/*end Ready*/


$(document).ready(function(){
    //Examples of how to assign the Colorbox event to elements
    $(".group1").colorbox({rel:'group1'});
    $(".group2").colorbox({rel:'group2', transition:"fade"});
    $(".group3").colorbox({rel:'group3', transition:"none", width:"75%", height:"75%"});
    $(".group4").colorbox({rel:'group4', slideshow:true});
    $(".ajax").colorbox();
    $(".youtube").colorbox({iframe:true, innerWidth:640, innerHeight:390});
    $(".vimeo").colorbox({iframe:true, innerWidth:500, innerHeight:409});
    $(".iframe").colorbox({iframe:true, width:"80%", height:"80%"});
    $(".inline").colorbox({inline:true, width:"50%"});
    $(".callbacks").colorbox({
        onOpen:function(){ alert('onOpen: colorbox is about to open'); },
        onLoad:function(){ alert('onLoad: colorbox has started to load the targeted content'); },
        onComplete:function(){ alert('onComplete: colorbox has displayed the loaded content'); },
        onCleanup:function(){ alert('onCleanup: colorbox has begun the close process'); },
        onClosed:function(){ alert('onClosed: colorbox has completely closed'); }
    });

    $('.non-retina').colorbox({rel:'group5', transition:'none'})
    $('.retina').colorbox({rel:'group5', transition:'none', retinaImage:true, retinaUrl:true});

    //Example of preserving a JavaScript event for inline calls.
    $("#click").click(function(){
        $('#click').css({"background-color":"#f00", "color":"#fff", "cursor":"inherit"}).text("Open this window again and this message will still be here.");
        return false;
    });
});