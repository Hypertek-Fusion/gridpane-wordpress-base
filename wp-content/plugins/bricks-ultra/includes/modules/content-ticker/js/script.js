document.addEventListener("DOMContentLoaded", function (t) {
	bricksIsFrontend && bricksUltraContentTicker();
});
function bricksUltraContentTicker(){
	const contentTickers = bricksQuerySelectorAll(document, '.brxe-wpvbu-content-ticker');
	contentTickers.forEach((contentTicker) => {
		const mainSlider = contentTicker.querySelector('.bultr-slider');
		if (mainSlider) {
			if (mainSlider.classList.contains("bultr-slider")) {
			  mainSlider.classList.add("splide");
			  let content_ticker = new Splide(mainSlider);
			  content_ticker.mount();
			}
		}	  
	})
}