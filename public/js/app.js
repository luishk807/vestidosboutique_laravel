$(document).ready(function() {
    var slideTimeout = null;
    function setSlider(){
        if(!slideTimeout){
            slideTimeout = setInterval(function () {
                    $.fn.fullpage.moveSlideRight();
            },5000);
        }
    }
    var isReponsive =false;
    function initialization(){
        $('#fullpage').fullpage({
            // scrollOverflow: true,
            navigation: true,
            responsiveWidth: 900,
            menu: '.navbar',
            afterRender: function () {
                //on page load, start the slideshow
                setSlider();
            },
            afterResponsive: function(isResponsivex){
                isReponsive = isResponsivex;
                if(isResponsivex){
                    $('#top_middle_sec_row #top_middle_img1,#top_middle_sec_row #top_middle_img2,#top_middle_sec_row #top_middle_img3').removeClass('active');
                    $("#home_main_slider .main_slider_btn").removeClass("col").addClass("col-md-4")
                    $('.brands_txt > div').css("margin-left","auto");
                    $(".quince_thumb").addClass("active");
                }else{
                    $(".vestidos-main-nav-top").removeClass("show");
                }
            },
            afterLoad: function(anchorLink, index){
                //set slider when in slide 1
                if (index == '1' && !slideTimeout) {
                    setSlider();
                }
                if(index == 2 && !isReponsive){
                    $('#top_middle_sec_row #top_middle_img1,#top_middle_sec_row #top_middle_img2,#top_middle_sec_row #top_middle_img3').addClass('active');
                }
                if(index == 3 && !isReponsive){
                    $('.brands_txt > div').addClass('active');
                }
                if(index == 5 && !isReponsive){
                    $('#quince_thumb_1').addClass('active');
                    var divs = $('.quince_thumb');
                    var index = 1;
                    var delay = setInterval( function(){
                        if ( index <= divs.length ){
                            $( divs[index] ).addClass('active');
                            index += 1;
                        }else{
                            clearInterval( delay );
                        }
                    },300);
                }
            },
            onLeave: function (index, direction) {
                //remove slider when leaving
                if (index == '1') {
                    clearInterval(slideTimeout);
                    slideTimeout =null;
                }
                
            }
        });
    }
    initialization();
    $(window).on("resize",function() {
        $(".submenu-panel").removeClass("open");
        $('#vesti-main-nav-btn').removeClass('open');
    });
    $("#main_slider_arrow_cont .vesti-down-arrow").click(function(e){
        e.preventDefault();
        $.fn.fullpage.moveSectionDown();
    });
});

/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));

const app = new Vue({
    el: '#app'
});