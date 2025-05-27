InfoCircle = null;

(function () {
  document.addEventListener("DOMContentLoaded", function (t) {
    bricksIsFrontend && InfoCircle();
  });
  var angle = 0;
  let autoplayDuration = 0;
  InfoCircle = () => {
    const ab_elements = bricksQuerySelectorAll(
      document,
      ".brxe-wpvbu-info-circle"
    );
    ab_elements.forEach((element) => {
      var timer = null;
      const autoplay =
        element.querySelector(".bultr-info-circle").dataset.autoplay;
      set_icon_mobile(element, angle, autoplay);

      clearInterval(timer);

      if (document.body.classList.contains("bricks-is-frontend")) {
        if (autoplay !== "no") {
          autoplayDuration =
            element.querySelector(".bultr-info-circle").dataset.delay;
          startSetInterval(element, autoplayDuration);
        }
      }

      if (element.querySelectorAll(".bultr-info-circle-item").length > 0) {
        console.log('Elemnt', element
        .querySelectorAll(".bultr-info-circle-item")[0]);
        element
          .querySelectorAll(".bultr-info-circle-item")[0]
          .classList.add("bultr-active");
      }
    });
  };

  function set_icon_mobile(element, angle, autoplay) {
    const icons = element.querySelectorAll(".bultr-ic-icon-wrap");
    if (window.innerWidth < 767) {
      icons.forEach((icon) => {
        icon.style.top = icon.getBoundingClientRect().height / 2 + 8 + "px";
        icon.nextElementSibling.style.paddingTop =
          icon.getBoundingClientRect().height / 2 + 8 + "px";
      });
    } else {
      icons.forEach((icon) => {
        icon.style.marginLeft =
          icon.getBoundingClientRect().width * -0.5 + "px";
        icon.style.marginTop =
          icon.getBoundingClientRect().height * -0.5 + "px";
        const a = arc_to_coords(angle);
        const b = 360 / icons.length;
        icon.style.left = a.x + "%";
        icon.style.top = a.y + "%";
        angle = angle + b;

        if (autoplay === "no" || !document.body.classList.contains("bricks-is-frontend")) {
          icon.addEventListener("click", function () {
            remove_active_all(element);
            set_active(icon);
          });

          if (
            element.querySelector(".bultr-info-circle").dataset.mouseenter ==
            "1" && document.body.classList.contains("bricks-is-frontend")
          ) {
            icon.addEventListener("mouseenter", () => {
              remove_active_all(element);
              set_active(icon);
            });
          }
          
        }
      });
    }
  }
  function set_active(icon) {
    icon.parentElement.classList.add("bultr-active");
  }

  function remove_active_all(element) {
    element.querySelectorAll(".bultr-info-circle-item").forEach((item) => {
      item.classList.remove("bultr-active");
    });
  }
  function arc_to_coords(angle) {
    angle = ((angle - 90) * Math.PI) / 180;

    return {
      x: 50 + 45 * Math.cos(angle),
      y: 50 + 45 * Math.sin(angle),
    };
  }
  function startSetInterval(element, autoplayDuration) {
    if (element.querySelector(".bultr-info-circle").dataset.autoplay == "1") {
      timer = setInterval(() => showDiv(element), autoplayDuration);
    }
  }

  function showDiv(element) {
    if (element?.querySelectorAll(".bultr-active").length > 0) {
      const activeElement = element.querySelector(".bultr-active");
      remove_active_all(element);
      if (activeElement?.nextElementSibling) {
        activeElement?.nextElementSibling?.classList.add("bultr-active");
      } else {
        element
          .querySelector(".bultr-info-circle-item")
          .classList.add("bultr-active");
      }
    } else {
      element
        .querySelector(".bultr-info-circle-item")
        .classList.add("bultr-active");
    }
  }
})();
