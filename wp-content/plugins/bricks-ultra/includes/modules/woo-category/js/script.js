function bricksUltraSwiperCategory(){
    const wooWrapper = bricksQuerySelectorAll( document,".brxe-wpvbu-woo-category");
    wooWrapper.forEach((element)=>{
        const stackDevice = element.getAttribute("data-stack");
        // console.log("stack device",stackDevice);
        const mainSlider = element.querySelector(".bultr-category");
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
            if(mainSlider.classList.contains('bultr-slider-layout')){
                mainSlider.classList.add('bricks-swiper-container');
                swiperJson = mainSlider.getAttribute('data-script-args');
                slide_data =  JSON.parse(swiperJson);
                // console.log("slidedata  ",slide_data);
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
                            swiperData.slidesPerGroup = smallDeviceKey.slidesPerGroup;                            
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
                    case "fade" :
                        swiperData.fadeEffect = {
                            crossFade: true,
                        };
                    case "coverflow" : 
                        if (slide_data.hasOwnProperty('coverflowEffect') && slide_data.coverflowEffect !== '' && slide_data.coverflowEffect !== null && slide_data.coverflowEffect !== undefined) {
                            coverEffect  = slide_data.coverflowEffect;

                            if (coverEffect.hasOwnProperty('slideshadow') && slide_data.coverflowEffect.slideshadow !== '' && slide_data.coverflowEffect.slideshadow !== null && slide_data.coverflowEffect.slideshadow !== undefined) {
                                cshadow = slide_data.coverflowEffect.slideshadow;
                            }
                            swiperData.coverflowEffect = {
                                // rotate: 40,
                                // depth: 100,
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
                // console.log("wooslidercat", wooSlider);

            }
        }

        categoryCard = element.querySelectorAll('.bultr-category-card');
        // console.log("card", categoryCard);

        const index = devicearr.indexOf(stackDevice);
        // console.log('index',index);
        const result = devicearr.slice(index);
        // console.log("result", result);

        if(result !== null && result !== undefined && result.includes(device)){ 
            categoryCard.forEach(card => {
                 card.classList.add('bultr-stack');
            })
            // productCard.classList.add('bultr-stack');
            // console.log("items to be stacked");
        }

    });
}

// var timer = 0;
// window.addEventListener("resize", function (t) {
//   clearTimeout(timer);
//   timer = setTimeout(resizeStoped, 300);
// });

// function resizeStoped() {
//   bricksUltraTeamMember();
// }
document.addEventListener("DOMContentLoaded", function (t) {
    bricksIsFrontend && bricksUltraSwiperCategory();
});




