document.addEventListener("DOMContentLoaded", function(t) {
    if (bricksIsFrontend) {
        bu_testimonial_slider();
    }
});

function bu_testimonial_slider(){
    const ts = bricksQuerySelectorAll(document, '.brxe-wpvbu-testimonial-slider ');
    ts.forEach((element) => {

        const collection = element.querySelector('.bultr-ts-collection');
        
       

        swiperdata = collection.getAttribute('data-script-args');

        new SwiperBase(element,collection, swiperdata);
        

function handle_breakpoint() {
    const data = element.querySelector('.bultr-ts-container ');
    const imgElements = element.querySelectorAll('.bultr-ts-image'); 
    const contentElements = element.querySelectorAll('.bultr-ts-content-section');
    const breakpoints = parseInt(data.getAttribute('data-stacked'));
    const currentWindowWidth = window.innerWidth;
    
    if(currentWindowWidth <= breakpoints) {
        imgElements.forEach(img => {
            img.style.display = 'none';
            contentElements.forEach(content => {
                content.style.padding = '50px';
                
            });
        });
    }
    else {
        imgElements.forEach(img => {
            img.style.display = 'flex';
        });
    }
}
    handle_breakpoint(); 

    window.addEventListener('resize', handle_breakpoint); 
    });
}
