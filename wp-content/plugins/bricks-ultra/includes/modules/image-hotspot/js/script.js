
document.addEventListener("DOMContentLoaded", function (t) {
  bricksIsFrontend && ImageHostpot();
});

function ImageHostpot(){
const markerWrapper = bricksQuerySelectorAll( document,".bultr-ih-image-hotspot");
  markerWrapper.forEach((element)=>{

    const markers = element.querySelectorAll(".bultr-ih-marker");
    const tooltips = element.querySelectorAll(".bultr-ih-tooltip");
    const tippy_instance = [];
    const container = element.querySelectorAll(".bultr-ih-image-container");
    const control_settings = JSON.parse(container[0].dataset.settings);
    const tltpAnimation = control_settings['tltp_animation'];
    const animation = 'brx-animate-' + tltpAnimation;
    const preview = element.querySelectorAll(".bultr-ih-tooltip-show");  
    const rep_preview = element.querySelectorAll(".bultr-ih-rep-tooltip-show");

    if(control_settings['trigger'] === 'hover'){
      control_settings['trigger'] = 'mouseenter focus';
    }
   
    markers.forEach(function (marker, index) {
          const tooltipContent = tooltips[index].innerHTML;
         if(preview.length > 0){
          control_settings['trigger'] = 'manual'; 
         }
         if(rep_preview.length > 0){
          control_settings['trigger'] = 'manual'; 
         
         }
          tippy_instance[index] = tippy(marker, {
            content: tooltipContent,
            appendTo: 'parent',
            placement: "auto", 
            allowHTML: true,
            hideOnClick: false,
            arrow: true, 
            maxWidth: 'none',
            trigger:  control_settings['trigger'], 

            onCreate: function(instance) {
              instance.popper.classList.add('bultr-add-tooltip');
              // Check if instance.popper and instance.popper.childNodes exist before adding classes
              if (instance.popper && instance.popper.childNodes) {
                // Add 'brx-animated' class
                instance.popper.childNodes.forEach(function(childNode) {
                  if (childNode.classList) {
                    childNode.classList.add('bultr-ih-animation');
                    childNode.classList.add('brx-animated');
                    childNode.classList.add(animation);
                  }
                });
              }

              const prev_button = instance.popper.querySelector('.bultr-ih-prev-tour');
              if (prev_button) {
                  prev_button.addEventListener('click', function(){
                    const tooltipid = this.getAttribute('data-tooltipid');
                    const tippy_index = tooltipid - 1;
                    tippy_instance[tippy_index].hide();
                    tippy_instance[tippy_index - 1].show();
                  });
                 
                  if(index == 0){
                    prev_button.style.display = 'none';
                  }
              }

              const next_button = instance.popper.querySelector('.bultr-ih-next-tour');
              if (next_button) {
                next_button.addEventListener('click', function(){
                  const tooltipid = this.getAttribute('data-tooltipid');
                  const tippy_index = tooltipid - 1;
                  tippy_instance[tippy_index].hide();
                  tippy_instance[tippy_index + 1].show();
                });

                if(index == markers.length - 1){
                  next_button.style.display = 'none';
                }
              }

              const end_button = instance.popper.querySelector('.bultr-ih-end-tour');
              if(end_button){
                end_button.addEventListener('click', function(){
                  const tooltipid = this.getAttribute('data-tooltipid');
                  const tippy_index = tooltipid - 1;
                  tippy_instance[tippy_index].hide();
                   //preview tooltip
                   if (preview.length > 0) {
                    tippy_instance[0].show();
                  }
                  if (marker.classList.contains("bultr-ih-rep-tooltip-show")) {
                    tippy_instance[index].show();
                  }    
                });  
              }

             //check close button exist
              const close_button = instance.popper.querySelector('.bultr-ih-tooltip-close');
              if(close_button){
                  close_button.addEventListener('click', function(){
                    const tooltipid = this.getAttribute('data-tooltipid');
                    const tippy_index = tooltipid - 1;
                    tippy_instance[tippy_index].hide();
                    //preview tooltip
                    if (preview.length > 0) {
                      tippy_instance[0].show();
                    }
                    if (marker.classList.contains("bultr-ih-rep-tooltip-show")) {
                      tippy_instance[index].show();
                    }    
                  }); 
                }
            },  
          });
        
          marker.addEventListener('click', function () {
            tippy_instance.forEach((instance, i) => {
              if (preview.length > 0) {
                tippy_instance[0].show();
              }
              //preview
              if (rep_preview.length > 0) { 
                const tippy_index = this.getAttribute('data-marker') - 1;
                if(marker.classList.contains('bultr-ih-rep-tooltip-show')){
                  if (tippy_instance[tippy_index]) {
                    tippy_instance[tippy_index].show();
                  } 
                }
              }  
              
              //bricks admin
              if(preview.length == 0 && rep_preview.length == 0){
                if (i !== index) {
                  instance.hide();
                }
              }

              if(bricksData.isAdmin != 1){       
                if (i !== index) {
                  instance.hide();
                }
              }
            });

          });
         
      //lottie animation
          const lottie_ele = marker.querySelector(".bultr-ih-lottie");
          if (lottie_ele !== null) {
            const lottie_data = JSON.parse(lottie_ele.getAttribute("data-lottie-settings"));

            const lottie_id = lottie_ele.getAttribute('data-lottie-id');
            lottie.destroy(lottie_id);
            const lottie_animt = lottie.loadAnimation({
              container: lottie_ele,
              path: lottie_data.url,
              renderer: "svg",
              loop: lottie_data.loop,
              autoplay: true,
              name: lottie_id,
            });

            if (lottie_data.direction === true) {
              lottie_animt.setDirection(-1);
            }
          }
    });

    //tooltip preview   
      if (preview.length > 0) {
        tippy_instance[0].show();
      } 
      //tooltip repeat preview
      if (rep_preview.length > 0) {
        rep_preview.forEach((marker_id) => {
          const tippy_index = marker_id.getAttribute('data-marker') - 1;
          if (tippy_instance[tippy_index]) {
            tippy_instance[tippy_index].show();
          }
        });
      }
  });
}

  