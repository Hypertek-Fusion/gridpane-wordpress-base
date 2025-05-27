
function bricksUltraSwiperslider(){
    const wooWrapper = bricksQuerySelectorAll( document,".bultr-woo-wrapper");

    wooWrapper.forEach((element)=>{
        // slider

        const mainSlider = element.querySelector(".bultr-products");
        const device = window.bultra.buGetBreakpoints();
    
        window.addEventListener('resize', () => {
				onResize();
		});
        function onResize() {
			let deviceFun = window.bultra.buGetBreakpoints();
        }    
        //getting the smallest device
        var devicearr = window.bultra.buGetDevices();
        var devicelen = devicearr.length;
        var smallestdevice = devicearr[devicelen-1];

        element.classList.remove( ...window.bultra.buGetDevices() );
        element.classList.add(device);
        window.bricksUltra[element.id]?.destroy();
 

        if(mainSlider){
            if(mainSlider.classList.contains('bultr-layout-slider')){
                mainSlider.classList.add('bricks-swiper-container');
                swiperJson = mainSlider.getAttribute('data-script-args');
                slide_data =  JSON.parse(swiperJson);
                //getting slide_data into variables
                slideEffect = slide_data.effect;
                perView     = slide_data.hasOwnProperty('sliderPerView') ? parseInt(slide_data.sliderPerView) : 3;
                perGroup    = slide_data.hasOwnProperty('slidesPerGroup') ? parseInt(slide_data.slidesPerGroup): 1;
                spaceBtw    = slide_data.hasOwnProperty('spaceBetween') ?  parseInt(slide_data.spaceBetween) : 10;
                center      = slide_data.centeredSlides;
                slideSpeed  = slide_data.speed;
                auto        = slide_data.autoheight;
                loop        = slide_data.loop;
                grab        = slide_data.grabCursor;
                
                // assigning variables to swiperdata
                var swiperData = {
                    effect          : slideEffect,
                    slidesPerView   : perView,
                    slidesPerGroup  : perGroup,
                    spaceBetween    : spaceBtw,
                    loop            : loop,
                    speed           : slideSpeed,
                    centeredSlides  : center,
                    autoHeight      : auto,
                    grabCursor      : true,
                    
                };

                //Breakpoints
                if(slide_data.hasOwnProperty('breakpoints') && slide_data.breakpoints !== ''){
                    breakpointData = slide_data.breakpoints;
                    breakpoints = slide_data.breakpoints;
                    for(const key in breakpoints ){
                        const dd= breakpoints[key].deviceLabel;
                        //deleting smallest device array from breakpoints and getting its data to set for default
                        if(dd === smallestdevice){
                            smallDeviceKey= breakpoints[key];
                            swiperData.slidesPerView = smallDeviceKey.slidesPerView;
                            swiperData.slidesPerGroup = parseInt(smallDeviceKey.slidesPerGroup);                            
                            delete breakpointData[key];
                        }
                    }
                    //removing device label from object
                    for(const key in breakpointData){
                        delete breakpointData[key].deviceLabel;
                    }
                    swiperData.breakpoints = breakpointData;

                } 

                //navigation
                if(slide_data.hasOwnProperty('navigation') && slide_data.navigation !== ''){
                    arrownav = slide_data.navigation;

                    if(arrownav.hasOwnProperty('nextEl')&& arrownav.nextEl !== '' ){
                        nextel = arrownav.nextEl;
                    }
                    if(arrownav.hasOwnProperty('prevEl')&& arrownav.prevEl !== '' ){
                        prevel = arrownav.prevEl;
                    }

                    swiperData.navigation = {
                        nextEl: nextel,
                        prevEl: prevel,
                    };


                }

                //pagination
                if(slide_data.hasOwnProperty('pagination') && slide_data.pagination !== ''){
                    pagenav = slide_data.pagination;
                    if(pagenav.hasOwnProperty('el')&& pagenav.el !== '' ){
                        pagination_class = pagenav.el;
                    }
                    if(pagenav.hasOwnProperty('clickable')&& pagenav.clickable !== '' ){
                        dotClick = pagenav.clickable;
                    }
                    if(pagenav.hasOwnProperty('dynamicBullets')&& pagenav.dynamicBullets !== '' ){
                        dotDynamic = pagenav.dynamicBullets;
                    }
                    if(pagenav.hasOwnProperty('type') && pagenav.type !== '' ){
                        dotType = pagenav.type;
                    }

                    swiperData.pagination = {
                        el: pagination_class,
                        type: dotType,
                        clickable : dotClick,
                        dynamicBullets: dotDynamic,
                    };


                }
                //autoplay
                
                if(slide_data.hasOwnProperty('autoplay') && slide_data.autoplay !== ''){
                    autoplay = slide_data.autoplay;

                    if (autoplay.hasOwnProperty('delay') && slide_data.autoplay.delay !== '' && slide_data.autoplay.delay !== null && slide_data.autoplay.delay !== undefined) {
                        delay  = slide_data.autoplay.delay;
                    }
                    if (autoplay.hasOwnProperty('pauseOnMouseEnter') && slide_data.autoplay.pauseOnMouseEnter !== '' && slide_data.autoplay.pauseOnMouseEnter !== null && slide_data.autoplay.pauseOnMouseEnter !== undefined) {
                        pauseHover  = slide_data.autoplay.pauseOnMouseEnter;
                    }
                    if (autoplay.hasOwnProperty('stopOnLastSlide') && slide_data.autoplay.stopOnLastSlide !== '' && slide_data.autoplay.stopOnLastSlide !== null && slide_data.autoplay.stopOnLastSlide !== undefined) {
                        lastSlide  = slide_data.autoplay.stopOnLastSlide;
                    }
                    if (autoplay.hasOwnProperty('disableOnInteraction') && slide_data.autoplay.disableOnInteraction !== '' && slide_data.autoplay.disableOnInteraction !== null && slide_data.autoplay.disableOnInteraction !== undefined) {
                        disableinteraction = slide_data.autoplay.disableOnInteraction;
                    }
                    swiperData.autoplay = {
                        delay : delay,
                        pauseOnMouseEnter: pauseHover,
                        stopOnLastSlide : lastSlide,
                        disableOnInteraction	: disableinteraction,
                    };
                }
                //effects coverflow , cube effect parameters
                switch (swiperData.effect){
                    case "coverflow" : 
                        if (slide_data.hasOwnProperty('coverflowEffect') && slide_data.coverflowEffect !== '' && slide_data.coverflowEffect !== null && slide_data.coverflowEffect !== undefined) {
                            coverEffect  = slide_data.coverflowEffect;

                            if (coverEffect.hasOwnProperty('slideshadow') && slide_data.coverflowEffect.slideshadow !== '' && slide_data.coverflowEffect.slideshadow !== null && slide_data.coverflowEffect.slideshadow !== undefined) {
                                cshadow = slide_data.coverflowEffect.slideshadow;
                            }
                            swiperData.coverflowEffect = {
                                slideShadows: cshadow,
                            };
                        }
                        break;
                    case "cube" :
                        if(slide_data.hasOwnProperty("cubeEffect") && slide_data.cubeEffect !== '' && slide_data.cubeEffect !== null && slide_data.cubeEffect !== undefined ){
                            cubeeffect = slide_data.cubeEffect;
                            if (cubeeffect.hasOwnProperty('slideshadow') && slide_data.cubeEffect.slideshadow !== '' && slide_data.cubeEffect.slideshadow !== null && slide_data.cubeEffect.slideshadow !== undefined) {
                                cslideshadow = slide_data.cubeEffect.slideshadow;
                            }
                            if (cubeeffect.hasOwnProperty('shadow') && slide_data.cubeEffect.shadow !== '' && slide_data.cubeEffect.shadow !== null && slide_data.cubeEffect.shadow !== undefined) {
                                ccshadow = slide_data.cubeEffect.shadow;
                            }
                            if (cubeeffect.hasOwnProperty('shadowOffset') && slide_data.cubeEffect.shadowOffset !== '' && slide_data.cubeEffect.shadowOffset !== null && slide_data.cubeEffect.shadowOffset !== undefined) {
                                coffset = slide_data.cubeEffect.shadowOffset;
                            }
                            if (cubeeffect.hasOwnProperty('shadowScale') && slide_data.cubeEffect.shadowScale !== '' && slide_data.cubeEffect.shadowScale !== null && slide_data.cubeEffect.shadowScale !== undefined) {
                                cscale = slide_data.cubeEffect.shadowScale;
                            }
                            
                            swiperData.cubeEffect =  {
                                slideShadows: cslideshadow,
                                shadow: ccshadow,
                                shadowOffset : coffset,
                                shadowScale : cscale,
                            };
                        }
                        
                        break;
                

                }
                const wooSlider = new Swiper(mainSlider, swiperData);
                window.bricksUltra[element.id] = wooSlider;
               
            }
        }


        // popup
        
        cards = jQuery('.open-popup-link');

        popup = jQuery('.open-popup-link').magnificPopup({
            type:'inline',
            midClick: true,
            mainClass: "bultr-woo-popup bultr-woo-box-" + jQuery('.open-popup-link').data('qvid'),
        
            overflowY: 'hidden',
          
            alignTop: false,
        
              callbacks:{
                open: function(){
                     jQuery( '.woocommerce-product-gallery' ).each( function() {
                        jQuery( this ).wc_product_gallery();
                    } );
                    // trigger window.resize event
                    jQuery(window).trigger("resize"); 
                },
                
              }
        });
  
        modalButton = element.querySelector('.bultr-woo-quickBtn');


        // -----------------buy now button-----------------
        
        buyNowBtn = element.querySelectorAll('.bultr-woo-buy-now');
        buyNowBtn.forEach(function(btn){
            btn.addEventListener('click',function(e){
                e.preventDefault();
                var productId = btn.getAttribute('data-product-id');
                var quantity = btn.getAttribute('data-quantity');
                const checkout=bricksUltra.checkout_url;
                const params = new URLSearchParams();
            
                //pass parameters to php
                params.append('action', 'bu_add_to_cart' );
                params.append('product_id', productId );
                params.append('quantity', quantity );
                params.append('bu_nonce', bricksUltra.nonce );
                //send ajax request to php
                fetch(bricksUltra.ajaxurl, {
                    method: 'post',
                    credentials: 'same-origin',
                    body :params,
                })
                .then((response) => response.json())
                .then((data) => {
                    //redirect to checkout page
                    window.location.href = checkout;
                })
                .catch((error) => {
                    console.error('Error:', error);
                });


            });
        });
     
     });
      
}

document.addEventListener("DOMContentLoaded", function (t) {
    bricksIsFrontend && bricksUltraSwiperslider();
});

