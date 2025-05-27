function bricksUltraTeamMember() {
  bricksQuerySelectorAll(document, ".brxe-wpvbu-team-member").forEach(function (
    item
  ) {
    const mainSlider = item.querySelector(".bultr-team-members");
    const device = window.bultra.buGetBreakpoints();
    item.classList.remove( ...window.bultra.buGetDevices() );
    item.classList.add(device);
    
    window.bricksUltra[item.id]?.destroy();
    if (mainSlider) {
      if (mainSlider.classList.contains("bultr-slider")) {
        mainSlider.classList.add("splide");
        let teamSlider = new Splide(mainSlider);

        window.bricksUltra[item.id] = teamSlider;
        var bar = item.querySelector(".bultr-slider-progress-bar");
        if (bar) {
          // Update the bar width:
          teamSlider.on("mounted move", function () {
            var end = teamSlider.Components.Controller.getEnd() + 1;
            bar.style.width = String((100 * (teamSlider.index + 1)) / end) + "%";
          });
        }
        teamSlider.mount();
      }
    }
  });
}
var timer = 0;
window.addEventListener("resize", function (t) {
  clearTimeout(timer);
  timer = setTimeout(resizeStoped, 300);
});

function resizeStoped() {
  bricksUltraTeamMember();
}
document.addEventListener("DOMContentLoaded", function (t) {
  bricksIsFrontend && bricksUltraTeamMember();
});
