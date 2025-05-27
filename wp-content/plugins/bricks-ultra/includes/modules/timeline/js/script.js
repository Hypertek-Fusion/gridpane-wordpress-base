function bricksUltraTimeline(){
    const timelines = bricksQuerySelectorAll(document, '.bultr-timeline');
    if (timelines.length) {
      timelines.forEach((timeline) => {
        new TimeLine(timeline);
      });
    }
}
  document.addEventListener('DOMContentLoaded', function (t) {
    bricksIsFrontend && bricksUltraTimeline();
  });