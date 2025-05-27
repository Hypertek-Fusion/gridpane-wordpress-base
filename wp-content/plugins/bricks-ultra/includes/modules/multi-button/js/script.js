function getLayoutValue(key) {
  if (key === "column") {
    return "vertical";
  }
  return "horizontal";
}

document.addEventListener("DOMContentLoaded", function (t) {
  bricksIsFrontend && MultiButtons();
});

function MultiButtons() {
  const mb_elements = bricksQuerySelectorAll(
    document,
    ".brxe-wpvbu-multi-button"
  );


  mb_elements.forEach((element) => {
    const current_device = window.bultra.buGetBreakpoints();
    const container = element.querySelector(".bultr-multi-button-container");

    container.classList.add(current_device);
    let settings = JSON.parse(container.dataset.settings);

    const layout = getLayoutValue(settings[current_device]);
    container.classList.remove(
      "bultr-btn-layout-horizontal",
      "bultr-btn-layout-vertical"
    );
    container.classList.add("bultr-btn-layout-" + layout);

    window.addEventListener("resize", (e) => {
      settings = JSON.parse(container.dataset.settings);
      const device = window.bultra.buGetBreakpoints();
      const layout = getLayoutValue(settings[device]);

      container.classList.remove(
        "bultr-btn-layout-horizontal",
        "bultr-btn-layout-vertical"
      );
      container.classList.add("bultr-btn-layout-" + layout);
      container.classList.remove(...window.bultra.buGetDevices());

      container.classList.add(device);
    });
  });
}
