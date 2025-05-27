document.addEventListener("DOMContentLoaded", function(t) {
  bricksIsFrontend && ExecuteAfterBefore();
});
function ExecuteAfterBefore() {
  const ab_elements = document.querySelectorAll('.bultr-ic-wrapper');
  if (ab_elements.length) {
  new imagesLoaded(ab_elements, () => {
    ab_elements.forEach((element) => {
      const datasets = element.dataset;
      let id = datasets.icId;

      new BeforeAfter({
        className: 'bultr-ic-' + id,
        beforeText: datasets.beforeText,
        afterText: datasets.afterText,
        orientation: datasets.orientation,
        defaultSliderOffset: datasets.sliderOffset / 100,
        moveSliderOnHover: datasets.slideMove === 'hover',
        defaultSeparatorPosition: datasets.separatorOffset,
        clickToMove: datasets?.moveClick || false,
      });
    })
  });
  }
}

