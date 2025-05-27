document.addEventListener("DOMContentLoaded", function(t) {
	bricksIsFrontend && bu_instagram_feed();
});
 
window.addEventListener('resize', function(){
    bu_instagram_feed();
})
function bu_instagram_feed(){
    const instaFeed = bricksQuerySelectorAll(document, '.brxe-wpvbu-instagram-feed');
    instaFeed.forEach((element) => {
        const elementId = element.getAttribute('id');
        const container = element.querySelector('.bultr-insta-container');
        const collection = element.querySelector('.bultr-insta-collection');
        if(collection.classList.contains('bultr-islightbox')){
            checkLightbox();
        }
        function checkLightbox(){
            if(!collection.classList.contains('bultr-islightbox')){
                return;
            }
            var selector = collection.querySelector('.bultr-insta-link');
            var data = collection.getAttribute('data-insta-lightgallery');
            var lightboxSettings = JSON.parse(data);
            $plugins = [
                lgVideo,
                lgShare,
                lgZoom,
                lgHash,
                lgRotate,
                lgFullscreen,
                lgThumbnail
            ];

            let lightboxObject = {
                'selector' : '.bultr-insta-link',
                'plugins'  : $plugins,
            };
            lightboxObject = {...lightboxObject, ...lightboxSettings};
            lightGallery(element,lightboxObject);
        }
        if(container.classList.contains('bultr-iscarousel')){
            checkCarousel()
        }
        function checkCarousel(){
            if(!container.classList.contains('bultr-iscarousel')){
                return;
            }

            swiperdata = collection.getAttribute('data-script-args');
            new SwiperBase(element,collection, swiperdata);
        }
      
        if(container.classList.contains("bultr-insta-layout-masonry")){
            
            createMasonry();
        }
        function createMasonry(){
            var items = collection.querySelectorAll('.bultr-insta-items:not(.bultr-load-hide)');

            items.forEach(function (item, index){
                item.style.marginTop = 0;
            });

			const heights = [];
			var distanceFromTop = 0;
            distanceFromTop = collection.getBoundingClientRect().top;
            
            var gridColumns     = getComputedStyle(collection).gridTemplateColumns;

            var coulmnCount     = gridColumns.split(' ').length;

            var rowgap          = parseInt(getComputedStyle(collection).rowGap);

			distanceFromTop += parseInt(getComputedStyle(collection).marginTop, 10);



            items.forEach(function (item, index){

                const row = Math.floor(index/coulmnCount);

                const itemHeight = item.getBoundingClientRect().height + rowgap;
                
                if(row){
                    const itemPosition = item.getBoundingClientRect();

                    const indexAtRow = index % coulmnCount;

                    let pullHeight = itemPosition.top - distanceFromTop - heights[indexAtRow];

                    pullHeight *= -1;
                    item.style.marginTop = pullHeight + 'px';
                    heights[indexAtRow] += itemHeight;
                }
                else {
                    // for first row
                    heights.push(itemHeight);
                    item.style.marginTop = '0';
                  }
              
                  item.style.visibility = 'visible';
            })
           
        }
 
        
    });
    

}

// refresh cache buttton

const card = jQuery(document).on('click', ".bultr-refresh-cache-btn", function () {
	transient_key = 'bultr_insta_fetched_data';
	jQuery.ajax({
		url: bricksUltra.ajaxurl,
		dataType: 'json',
		method: 'post',
		data: {
			action: 'bultr_refresh_insta_cache',
			transient_key: transient_key,
		},
		success: function (res) {
			if (res.data) {
				view.container.renderer.view.container.renderer.render();
			} else {
				console.log('Refresh Cache:', res.data);
			}
			
		}
	});
});
