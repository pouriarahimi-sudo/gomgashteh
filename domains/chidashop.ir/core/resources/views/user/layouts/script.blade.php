<script data-cfasync="false" src="../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
<script type="text/javascript" src="scripts/jquery-2.2.0.min.js"></script>
<script type="text/javascript" src="scripts/mmenu.min.js"></script>
<script type="text/javascript" src="scripts/chosen.min.js"></script>
<script type="text/javascript" src="scripts/slick.min.js"></script>
<script type="text/javascript" src="scripts/rangeslider.min.js"></script>
<script type="text/javascript" src="scripts/magnific-popup.min.js"></script>
<script type="text/javascript" src="scripts/waypoints.min.js"></script>
<script type="text/javascript" src="scripts/counterup.min.js"></script>
<script type="text/javascript" src="scripts/jquery-ui.min.js"></script>
<script type="text/javascript" src="scripts/tooltips.min.js"></script>
<script type="text/javascript" src="scripts/custom.js"></script>




<!-- REVOLUTION SLIDER SCRIPT -->
<script type="text/javascript" src="scripts/themepunch.tools.min.js"></script>
<script type="text/javascript" src="scripts/themepunch.revolution.min.js"></script>

<script type="text/javascript">
    var tpj=jQuery;
    var revapi4;
    tpj(document).ready(function() {
        if(tpj("#rev_slider_4_1").revolution == undefined){
            revslider_showDoubleJqueryError("#rev_slider_4_1");
        }else{
            revapi4 = tpj("#rev_slider_4_1").show().revolution({
                sliderType:"standard",
                jsFileLocation:"scripts/",
                sliderLayout:"auto",
                dottedOverlay:"none",
                delay:9000,
                navigation: {
                    keyboardNavigation:"off",
                    keyboard_direction: "horizontal",
                    mouseScrollNavigation:"off",
                    onHoverStop:"on",
                    touch:{
                        touchenabled:"on",
                        swipe_threshold: 75,
                        swipe_min_touches: 1,
                        swipe_direction: "horizontal",
                        drag_block_vertical: false
                    }
                    ,
                    arrows: {
                        style:"zeus",
                        enable:true,
                        hide_onmobile:true,
                        hide_under:600,
                        hide_onleave:true,
                        hide_delay:200,
                        hide_delay_mobile:1200,
                        tmp:'<div class="tp-title-wrap"></div>',
                        left: {
                            h_align:"left",
                            v_align:"center",
                            h_offset:40,
                            v_offset:0
                        },
                        right: {
                            h_align:"right",
                            v_align:"center",
                            h_offset:40,
                            v_offset:0
                        }
                    }
                    ,
                    bullets: {
                        enable:false,
                        hide_onmobile:true,
                        hide_under:600,
                        style:"hermes",
                        hide_onleave:true,
                        hide_delay:200,
                        hide_delay_mobile:1200,
                        direction:"horizontal",
                        h_align:"center",
                        v_align:"bottom",
                        h_offset:0,
                        v_offset:32,
                        space:5,
                        tmp:''
                    }
                },
                viewPort: {
                    enable:true,
                    outof:"pause",
                    visible_area:"80%"
                },
                responsiveLevels:[1200,992,768,480],
                visibilityLevels:[1200,992,768,480],
                gridwidth:[1180,1024,778,480],
                gridheight:[640,500,400,300],
                lazyType:"none",
                parallax: {
                    type:"mouse",
                    origo:"slidercenter",
                    speed:2000,
                    levels:[2,3,4,5,6,7,12,16,10,25,47,48,49,50,51,55],
                    type:"mouse",
                },
                shadow:0,
                spinner:"off",
                stopLoop:"off",
                stopAfterLoops:-1,
                stopAtSlide:-1,
                shuffle:"off",
                autoHeight:"off",
                hideThumbsOnMobile:"off",
                hideSliderAtLimit:0,
                hideCaptionAtLimit:0,
                hideAllCaptionAtLilmit:0,
                debugMode:false,
                fallbacks: {
                    simplifyAll:"off",
                    nextSlideOnWindowFocus:"off",
                    disableFocusListener:false,
                }
            });
        }
    });	/*ready*/
</script>


<!-- SLIDER REVOLUTION 5.0 EXTENSIONS
	(Load Extensions only on Local File Systems !
	The following part can be removed on Server for On Demand Loading) -->
<script type="text/javascript" src="scripts/extensions/revolution.extension.actions.min.js"></script>
<script type="text/javascript" src="scripts/extensions/revolution.extension.carousel.min.js"></script>
<script type="text/javascript" src="scripts/extensions/revolution.extension.kenburn.min.js"></script>
<script type="text/javascript" src="scripts/extensions/revolution.extension.layeranimation.min.js"></script>
<script type="text/javascript" src="scripts/extensions/revolution.extension.migration.min.js"></script>
<script type="text/javascript" src="scripts/extensions/revolution.extension.navigation.min.js"></script>
<script type="text/javascript" src="scripts/extensions/revolution.extension.parallax.min.js"></script>
<script type="text/javascript" src="scripts/extensions/revolution.extension.slideanims.min.js"></script>
<script type="text/javascript" src="scripts/extensions/revolution.extension.video.min.js"></script>



<!-- Style Switcher
================================================== -->
<script src="scripts/switcher.js"></script>

{{--<div id="style-switcher">--}}
{{--    <h2>تغییر رنگ <a href="#"><i class="sl sl-icon-settings"></i></a></h2>--}}

{{--    <div>--}}
{{--        <ul class="colors" id="color1">--}}
{{--            <li><a href="#" class="main" title="اصلی"></a></li>--}}
{{--            <li><a href="#" class="blue" title="آبی"></a></li>--}}
{{--            <li><a href="#" class="green" title="سبز"></a></li>--}}
{{--            <li><a href="#" class="orange" title="نارنجی"></a></li>--}}
{{--            <li><a href="#" class="navy" title="آبی پررنگ"></a></li>--}}
{{--            <li><a href="#" class="yellow" title="زرد"></a></li>--}}
{{--            <li><a href="#" class="peach" title="هلویی"></a></li>--}}
{{--            <li><a href="#" class="beige" title="بژ"></a></li>--}}
{{--            <li><a href="#" class="purple" title="بنفش"></a></li>--}}
{{--            <li><a href="#" class="celadon" title="سبز کم رنگ"></a></li>--}}
{{--            <li><a href="#" class="red" title="قرمز"></a></li>--}}
{{--            <li><a href="#" class="brown" title="قهوه ای"></a></li>--}}
{{--            <li><a href="#" class="cherry" title="گیلاسی"></a></li>--}}
{{--            <li><a href="#" class="cyan" title="فیروزه ای"></a></li>--}}
{{--            <li><a href="#" class="gray" title="خاکستری"></a></li>--}}
{{--            <li><a href="#" class="olive" title="زیتونی"></a></li>--}}
{{--        </ul>--}}
{{--    </div>--}}

{{--</div>--}}
<!-- Style Switcher / End -->
