class SwiperBase{
    constructor(wrapper,container,data) {
        
        //checking if swiper wrapper has more than 1 children
        let wrap = container.querySelector(".swiper-wrapper");
        if(wrap.childElementCount <= 1){
             return;
        }
        if (typeof data === "undefined") {
            return false;
        }
        let element = wrapper;
        if(container.classList.contains('bultr-swiper-container')){
           var myContainer = container;
           myContainer.classList.add('bricks-swiper-container');

           
            
        }


        // swiper data
        data = JSON.parse(data);

        effects      = data.hasOwnProperty('effect') ? data.effect : 'slide';
        perView     = data.hasOwnProperty('sliderPerView') ? parseInt(data.sliderPerView) : 3;
        perGroup    = data.hasOwnProperty('slidesPerGroup') ? parseInt(data.slidesPerGroup): 1
        spaceBtw    = data.hasOwnProperty('spaceBetween') ?  parseInt(data.spaceBetween) : 10;
        autoheight  = data.hasOwnProperty('autoheight') ? data.autoheight : false;
        loop        = data.hasOwnProperty('loop') ? data.loop : false;
        speed       = data.hasOwnProperty('speed') ? parseInt(data.speed) : 1000;

        swiperdata = {
            direction       : data.direction,
            effect          : effects,
            autoHeight      : autoheight,
            loop            : loop,
            speed           : speed,
            spaceBetween    : spaceBtw,
            slidesPerView   : perView,
            slidesPerGroup: perGroup,
			on: {
				slideChangeTransitionStart: function(swiper) {
					let $wrapperEl = swiper.$wrapperEl;
					let params = swiper.params;
					$wrapperEl.children(('.' + (params.slideClass) + '.' + (params.slideDuplicateClass) + '.' + (params.slideActiveClass)))
						.each(function () {
							console.log(this);
							let idx = this.getAttribute('data-swiper-slide-index');
							this.innerHTML = $wrapperEl.children('.' + params.slideClass + '[data-swiper-slide-index="' + idx + '"]:not(.' + params.slideDuplicateClass + ')').html();
						});
				}
			}
        };
        // keyboard
        if(data.hasOwnProperty('keyboard') && data.keyboard !== ''){
            swiperdata.keyboard = {
                enabled: data.keyboard,
                onlyInViewport: true,
            };
        }
        // effect fade 
        if(data.effect === "fade"){
            swiperdata.fadeEffect = {
                crossFade : true,
            };
        }
        //Breakpoints
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
        //window.bricksUltra[wid]?.destroy();
        
        if(data.hasOwnProperty('breakpoints') && data.breakpoints !== ''){
            breakpointData = data.breakpoints;
            breakpoints = data.breakpoints;
            for(const key in breakpoints ){
                const dd= breakpoints[key].deviceLabel;
                //deleting smallest device array from breakpoints and getting its data to set for default
                if(dd === smallestdevice){
                    smallDeviceKey= breakpoints[key];
                    swiperdata.slidesPerView = parseInt(smallDeviceKey.slidesPerView);
                    swiperdata.slidesPerGroup = parseInt(smallDeviceKey.slidesPerGroup);                            
                    delete breakpointData[key];
                }
            }
            //removing device label from object
            for(const key in breakpointData){
                delete breakpointData[key].deviceLabel;
            }
            swiperdata.breakpoints = breakpointData;

        } 


        // autoplay  
        if(data.hasOwnProperty('autoplay') && data.autoplay !== ''){
            autoplay = data.autoplay;

            if (autoplay.hasOwnProperty('delay') && data.autoplay.delay !== '' && data.autoplay.delay !== null && data.autoplay.delay !== undefined) {
                delay  = data.autoplay.delay;
            }
            if (autoplay.hasOwnProperty('pauseOnMouseEnter') && data.autoplay.pauseOnMouseEnter !== '' && data.autoplay.pauseOnMouseEnter !== null && data.autoplay.pauseOnMouseEnter !== undefined) {
                pauseHover  = data.autoplay.pauseOnMouseEnter;
            }
            if (autoplay.hasOwnProperty('disableOnInteraction') && data.autoplay.disableOnInteraction !== '' && data.autoplay.disableOnInteraction !== null && data.autoplay.disableOnInteraction !== undefined) {
                interaction  = data.autoplay.disableOnInteraction;
            }
            swiperdata.autoplay = {
                disableOnInteraction: interaction,
                delay : delay,
                pauseOnMouseEnter: pauseHover,
            };
        }
        
        // navigation
       
        if(data.hasOwnProperty('navigation') == true  && data.navigation != 'undefined'){
            swiperdata.navigation = {
                nextEl: ' .bultr-swiper-button-next',
                prevEl: ' .bultr-swiper-button-prev',
            };
        }
        
        
        // scrollbar
        swiperdata.scrollbar = {
            el: ' .bultr-swiper-scrollbar',
            hide: true,
        };
        // pagination
        if(data.hasOwnProperty('pagination') && data.pagination.type !== ''){
            type = data.pagination.hasOwnProperty('type') ? data.pagination.type : 'bullets';
            clickable = data.pagination.hasOwnProperty('clickable') ? data.pagination.clickable : true;
            swiperdata.pagination = {
                el: ' .bultr-swiper-pagination',
                type : data.pagination.type,
                clickable : data.pagination.clickable,
               
            };
        }
        
        var slider = new Swiper(myContainer,swiperdata);
       // window.bricksUltra[`{slider-wid}`] = slider;
    }
    
      
}
