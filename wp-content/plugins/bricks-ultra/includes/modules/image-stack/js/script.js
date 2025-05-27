document.addEventListener("DOMContentLoaded", function(t) {
	bricksIsFrontend && buImageStack();
});

function buImageStack(){
    const imgStack = bricksQuerySelectorAll(document, '.brxe-wpvbu-image-stack');
    imgStack.forEach((element) => {
        const items = element.querySelectorAll('.bultr-istk-item');
        let tippy_instance = '';

        items.forEach(function (item, index){
            if(item.hasAttribute('data-tooltip-istk')){
                tooltipText = item.getAttribute('data-tooltip-istk');
                placement = item.getAttribute('data-placement-istk');
                width = parseInt(item.getAttribute('data-width-istk'));
                tippy(item, {
                    content: tooltipText,
                    placement:  placement,
                    appendTo: 'parent',
                    maxWidth: width,
                    followCursor: "horizontal" ,
                });
            }

            const isLink = item.querySelector('.bultr-istk-link');
            if(isLink){
                if(isLink.hasAttribute('data-lightbox')){
                    islightbox = isLink.getAttribute('data-lightbox');
                    if(islightbox === 'true'){
                        $plugins = [
                            lgShare,
                            lgZoom,
                            lgHash,
                            lgFullscreen,
                        ];
                        lightGallery(item,{
                            'selector' : '.bultr-istk-link',
                            'plugins'  : $plugins,
        
                        });
                    } 
                }
            }

            if(item.classList.contains('bultr-istk-lottie')){

                const lottie_ele = item.querySelector('.bultr-lottie');
                if(lottie_ele !== null){
                    const lottie_data = JSON.parse(lottie_ele.getAttribute('data-lottie-settings'));
                    const lottie_id = lottie_ele.getAttribute('data-lottie-id');
                    lottie.destroy(lottie_id);

                    const lottie_animt = lottie.loadAnimation({
                        container: lottie_ele,
                        path: lottie_data.url,
                        renderer: 'svg',
                        loop: lottie_data.loop,
                        autoplay: true,
                        name: lottie_id,
                    });
                    
                    if(lottie_data.direction === true){
                        lottie_animt.setDirection(-1) ;
                    }
                }
            }
           
        });
        
    })
}