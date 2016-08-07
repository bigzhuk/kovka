<script src="js/jcarousel.js"></script>
<style type="text/css">

#over_slider {
    background: rgba(255, 255, 255, 0.85) none repeat scroll 0 0;
    border-radius: 5px;
    color: #C42034;
    font-size: 35px;
    font-style: italic;
    height: 50px;
    line-height: 0;
    margin-left: 50px;
    margin-top: 100px;
    padding-top: 50px;
    position: absolute;
    text-shadow: 0 0 4px white;
    width: 1100px;
    z-index: 3;
    box-shadow: 0 0 5px rgba(0,0,0,0.5);
    font-weight: 900;   
}
.container {
    /*margin: 0 auto;*/
}
.slideshow_wrapper{
    width: 100%;    
    background: white;
    /*overflow: hidden;*/
    /*border: 2px solid #fff;*/
    border-left: 0;
    border-right: 0;
    height: 300px; 
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.75);
    margin-bottom: 30px;    
}
.slideshow {
    position: absolute;
    overflow: visible;
    padding: 0;
    width: 1200px !important; 
    padding: 0; 
    height: 300px;     
}
.slides {
    position: absolute;
    z-index: 1;
    margin: 0;
    padding: 0;
    list-style-type: none;
}
.slide {
    float: left;
    width: 1200px;
    height: 300px;
}
.slide>div{
    color: #fff;
    font-size: 27px;
    font-style: italic;
    font-weight: 400;
    margin-top: 160px;
    position: absolute;
    text-align: center;
    text-shadow: 0 0 5px black;
    width: 1200px;
}

code {
    background: #ccc;
    display: inline-block;
    vertical-align: middle;
    padding: 5px;
}

.prev,.next{
    /*background: rgba(255,255,255,.5);*/
    height: 300px;  
    position: absolute;
    width: 200px;
    z-index: 2;
    border: 0;
    cursor: pointer;
        
}
/*.prev{
    left: -200px;
    background: linear-gradient(to right, rgba(255,255,255,1), rgba(255,255,255,0.5));
    background: url("style/arrow_left.png") no-repeat center right rgba(255,255,255,0.5);
}
.prev:hover{
    background: url("style/arrow_left_hover.png") no-repeat center right rgba(255,255,255,0.5);
    cursor: pointer;
}
.next{
    left: 1200px;
    background: linear-gradient(to right, rgba(255,255,255,0.5), rgba(255,255,255,1));
    background: url("style/arrow_right.png") no-repeat center left rgba(255,255,255,0.5);
}
.next:hover{
    background: url("style/arrow_right_hover.png") no-repeat center left rgba(255,255,255,0.5);
    cursor: pointer;
}*/
</style>

<script> 
    var carousel1Options = {
        auto: true,
        visible: 2,
        speed: 500,
        pause: true,
        btnPrev: function() {
            return $(this).find('.prev');
        },
        btnNext: function() {
            return $(this).find('.next');
        }
    };   


</script>

<div class="slideshow_wrapper"> 

    <div id="over_slider"><?php echo $ad_text; ?></div>
    <div class="slideshow">

        <a href="#" class="prev"></a>
        <a href="#" class="next"></a>

        <ul class="slides">

            <a class="slide" href="/navesy">
            <img class="main_banner_item" src="images/slider_1.jpg">
            </a>

            <a class="slide" href="/zabory">
            <img class="main_banner_item" src="images/slider_2.jpg">
            </a>

            <a class="slide" href="/lestnicy">
            <img class="main_banner_item" src="images/slider_3.jpg">
            </a>

        </ul>
    </div>
</div>
<div style="clear: both; margin-bottom: 15px"></div>

<script>	

	$(document).ready(function() {
        $('.slideshow').jCarouselLite(carousel1Options);

        $('.prev').width(($(window).width() - $('.slideshow').width())/2);
        $('.prev').css('left', -($(window).width() - $('.slideshow').width())/2);
        $('.next').width(($(window).width() - $('.slideshow').width())/2);

        $('.slideshow').offset({ left: ($(window).width()/2) - $('.slideshow').width()/2});
	});

</script>