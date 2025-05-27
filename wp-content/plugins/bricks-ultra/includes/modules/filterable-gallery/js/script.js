function bricksUltraFilterableGallery() {
    bricksQuerySelectorAll(document, ".brxe-wpvbu-filterable-gallery").forEach((function (item) {
		var currentItem = item;
		var gallery = item.querySelector('.bultr-filters-image');
		var layout = gallery.dataset.layout;
		var defautTab = gallery.dataset.dtab;
		
		var gutterMargin = '';
		const filters = currentItem.querySelectorAll(".bultr-filter-title");
		const images = currentItem.querySelectorAll(".bultr-layout-item");
		const galleryWrapper = item.querySelector('.bultr-gallery');
		var itemSelector = '';
		let selectedFilter = '';

		
		if(layout === 'masonry' ){
			if(defautTab !== 'all'){
				selectedFilter = "."+defautTab;
				itemSelector = "."+defautTab;
			}else{
				selectedFilter = ".all";
				itemSelector = ".bultr-layout-item"
			}
			gutterMargin = parseInt(gallery.dataset.gutter);
			
			arrangeImages(itemSelector);
		}else{
			arrangeImages(defautTab);
		}	
			
		
		filters.forEach((filter) => {
            filter.addEventListener("click", (function (item) {
                selectedFilter = this.dataset.filter;
				var activeFilter = Array.from(filters).filter(node => node.classList.contains('active'))[0];
                var activeFilterFilter = activeFilter.dataset.filter;
                if (activeFilterFilter !== selectedFilter) {
                    activeFilter.classList.remove("active");
                    this.classList.add("active");
					arrangeImages(selectedFilter);
                }
			}))
		})		

		function arrangeImages(currentFilter){
			currentFilter = currentFilter.replace('.', '');
			images.forEach((image) =>{
					image.classList.add('transit-in');
						setTimeout(hideImage,500,image)
			});
			images.forEach((image) =>{
				if(image.classList.contains(currentFilter)){
					image.classList.add('transit-out');
					 setTimeout(showImage,500,image)	
				}
			});
			if (layout === 'masonry') {
				setTimeout(() => {
					triggerMasonry();
				}, 500)
			}
	
		}

		if (galleryWrapper.hasAttribute('data-settings')) {
			if (galleryWrapper.hasAttribute('data-settings')) {
				settings = JSON.parse(galleryWrapper.dataset.settings);
			}
            if (settings.tilt) {
                setTilt(currentItem, settings);
            }
            if (settings.hoverAware) {
                const overlaySpeed = settings.overlaySpeed;
                jQuery(currentItem).find('.bultr-layout-item').hoverdir({
                    speed: 300,
                    hoverElem: '.bultr-overlay',
                });
            }

        }
		
		function hideImage(image){
			image.style.display = "none";
			image.classList.remove('transit-in');	
		}

		function triggerMasonry(){
			let isotope = undefined;
			if(typeof isotope != "undefined"){
				isotope.destroy();
			}
			isotope = new Masonry(galleryWrapper, {
				itemSelector: selectedFilter,
				gutter: gutterMargin,
			});
		}

		function showImage(image){
			if (layout === 'masonry') {
				image.style.display = "block";
				image.classList.remove('transit-out');
			}else{
				image.style.display = "block";
				image.classList.remove('transit-out');
			}
		}

      
	}))
}	
function setTilt(item, settings) {
    const images = item.querySelectorAll('.bultr-tilt');
    
    images.forEach(image => {
        options = {
            maxTilt:            settings.tiltMax,
            startX:             0,      // the starting tilt on the X axis, in degrees.
            startY:             0,  
            perspective:        settings.tiltPerspective, // Transform perspective, the lower the more extreme the tilt gets.
            scale:              1, // 2 = 200%, 1.5 = 150%, etc..
            speed:              settings.tiltSpeed, // Speed of the enter/exit transition.
            transition:         true, // Set a transition on enter/exit.
            axis:               settings.tiltAxis,
            reset:              true, // If the tilt effect has to be reset on exit.
            //easing:             "cubic-bezier(.03,.98,.52,.99)",   // Easing on enter/exit.
            easing:             "linear",
            glare:              settings.tiltGlare, // Enables glare effect
            'max-glare':        settings.tiltMaxGlare, // From 0 - 1.
            gyroscope:          true,   // Boolean to enable/disable device orientation detection,
            gyroscopeMinAngleX: -45,    // This is the bottom limit of the device angle on X axis, meaning that a device rotated at this angle would tilt the element as if the mouse was on the left border of the element;
            gyroscopeMaxAngleX: 45,     // This is the top limit of the device angle on X axis, meaning that a device rotated at this angle would tilt the element as if the mouse was on the right border of the element;
            gyroscopeMinAngleY: -45,    // This is the bottom limit of the device angle on Y axis, meaning that a device rotated at this angle would tilt the element as if the mouse was on the top border of the element;
            gyroscopeMaxAngleY: 45,     // This is the top limit of the device angle on Y axis, meaning that a device rotated at this angle would tilt the element as if the mouse was on the bottom border of the element;
        };
        new VanillaTilt(image, options);

    });
}

document.addEventListener("DOMContentLoaded", function(t) {
	bricksIsFrontend && bricksUltraFilterableGallery()
});