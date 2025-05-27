{
  document.addEventListener("DOMContentLoaded", function (t) {
  bricksIsFrontend && ThumbnailSlider();
});

var timer = 0;
window.addEventListener("resize", function (t) {
  clearTimeout(timer);
  timer = setTimeout(resizeStoped, 300);
});

function resizeStoped() {
  ThumbnailSlider();
}

function ThumbnailSlider() {
  
  const device = window.bultra.buGetBreakpoints();
  document.querySelectorAll(".bultr-splide").forEach(function (e) {
    
    e.classList.add("splide");
    e.parentElement.classList.remove( ...window.bultra.buGetDevices() );
    e.parentElement.classList.add(device);
  });

  document
    .querySelectorAll(".bultr-thumb-slider-wrapper")
    .forEach(function (e) {
      

      var slider = null;
      var thumbs = null;
      
      const mainSlider = e.querySelector(".bultr-main-slider");
      const thumbSlider = e.querySelector(".bultr-thumb-slider");
      const thumbOptions = JSON.parse(thumbSlider.dataset.splide1);
      thumbOptions.width = thumbOptions.width + "%";

      for (const k in thumbOptions.breakpoints) {
        thumbOptions.breakpoints[k].width =
          thumbOptions.breakpoints[k].width + "%";
        if (k < 768) {
          delete thumbOptions.fixedWidth;
        }
      }


      
      window.bricksUltra[e.parentElement.id]?.destroy();
      

      slider = new Splide(mainSlider);
      thumbs = new Splide(thumbSlider, thumbOptions);
      
      //window.bricksUltra[e.parentElement.id] = slider;
      var bar = e.querySelector(".bultr-slider-progress-bar");
      if (bar) {
        // Update the bar width:
        slider.on("mounted move", function () {
          var end = slider.Components.Controller.getEnd() + 1;
          bar.style.width = String((100 * (slider.index + 1)) / end) + "%";
        });
      }

      slider.sync(thumbs);
      slider.mount();
      thumbs.mount();

      if (bar) {
        e.querySelector(".splide__track").style.height = "unset";
      }
    });
}
}
