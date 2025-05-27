document.addEventListener("DOMContentLoaded", function(t) {
	bricksIsFrontend && progressBar();
});

function progressBar(){
    const progressBars = bricksQuerySelectorAll(document, '.brxe-wpvbu-progress-bar');
	progressBars.forEach((element) => {
		const id = element.getAttribute('id');
        const $wrapper = element.querySelector(".bultr-progress-bar");
        const skill_value = $wrapper.getAttribute("data-value");
        const skin = $wrapper.getAttribute("data-layout");
        const skillELem = $wrapper.querySelector(".bultr-pb-bar-skill");
         const valueELem = $wrapper.querySelector(".bultr-pb-bar-value");
        const prgBar = $wrapper.querySelector(".bultr-pb-bar");
        const prgInner = $wrapper.querySelector(".bultr-pb-bar-inner");
        if (skin === "layout1") {
            prgInner.style.width = skill_value;
        }
        if (skin === "layout2") {
            prgInner.style.width = skill_value;
        }
        if (skin === "layout3") {
            if(valueELem && !valueELem.classList.add("bultr-pb-bar-value--aligned-value")){                   
            valueELem.classList.add("bultr-pb-bar-value--aligned-value");
             valueELem.style.left= skill_value ;  }
            prgInner.style.width = skill_value  ;
        }

        if (skin === "layout4") {
            if(valueELem && !valueELem.classList.add("bultr-pb-bar-value--aligned-value") && !prgBar.classList.add("bultr-pb-bar--no-overflow") ){                   
            valueELem.classList.add("bultr-pb-bar-value--aligned-value");
             prgBar.classList.add("bultr-pb-bar--no-overflow");
             valueELem.style.left= skill_value ; } 
             prgInner.style.width = skill_value  ;
        
          }
          if (skin === "layout5") {
            if(valueELem && !valueELem.classList.add("bultr-pb-bar-value--aligned-value")){                   
            valueELem.classList.add("bultr-pb-bar-value--aligned-value");
             valueELem.style.left= skill_value ;
            }
             prgInner.style.width = skill_value  ;
          
          }

        
        var waypoint = new Waypoint({
            element: $wrapper,
            
            handler: function(direction) {

                if (direction == "down") {

                   
                           
                    if(valueELem && !valueELem.classList.contains("js-animated")){                   
                        valueELem.classList.add("js-animated");
                    }
                    if(prgInner && !prgInner.classList.contains("js-animated")){                   
                        prgInner.classList.add("js-animated");
                    }
                    if(skillELem && !skillELem.classList.contains("js-animated")){                   
                        skillELem.classList.add("js-animated");
                    }
                }    
            },
            offset: "bottom-in-view",
         
        });
    });
};


