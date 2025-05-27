class TimeLine {
    timeline;
    items;
    scroll;
    firstItem;
  
    constructor(timeline) {
      this.init.bind(this, timeline)();
    }
  
    init(timeline) {
      let device = this.getCurrentDevice();
      this.timeline = timeline;
      timeline.classList.add(device);
      this.items = timeline.querySelectorAll('.bultr-icon');
      this.scroll = timeline.querySelector('.bultr-pb-inner-line');
      this.firstItem = this.items[0];
      this.setProgressBar();
      this.onScroll();
      // bind events
      document.addEventListener('scroll', () => {
        if (window.requestAnimationFrame) {
          window.requestAnimationFrame(() => {
            this.onScroll();
          });
        } else {
          this.onScroll();
        }
      });
      window.addEventListener('resize', () => {
        this.onResize();
      });
    }
  
    setProgressBar() {
      const timeline = this.timeline;
      const progressBar = timeline.querySelector('.bultr-timeline-progress-bar');
      const items = timeline.querySelectorAll('.bultr-timeline-item');
      const timelineHeight = timeline.getBoundingClientRect().height;
      const first_parent_top = items[0].getBoundingClientRect().top;
      const first_offset = items[0]
        .querySelector('.bultr-tl-icon-wrapper')
        .getBoundingClientRect();
      const first_offset_top = first_offset.bottom;
      const last_offset = items[items.length - 1]
        .querySelector('.bultr-tl-icon-wrapper')
        .getBoundingClientRect();
      const last_offset_top = last_offset.top;
      const timeline_offset_top = timeline.getBoundingClientRect().top;
      progressBar.style.top = first_offset_top - timeline_offset_top + 'px';
      progressBar.style.left =
        items[0].querySelector('.bultr-tl-icon-wrapper').offsetLeft +
        items[0].querySelector('.bultr-tl-icon-wrapper').offsetWidth / 2 +
        'px';
      progressBar.style.bottom =
        timelineHeight - (last_offset_top - first_parent_top) + 'px';
    }
  
    onScroll(e) {
      const timeline = this.timeline;
      const offset = +timeline.dataset.topOffset;
      const wrapperTop = +timeline.getBoundingClientRect().top;
      const scrollTop = Math.abs(window.scrollY + offset);
      const wrapperOffsetTop = this.timeline.offsetTop;
      if (scrollTop < wrapperOffsetTop ) {
        this.scroll.style.height = '0px';
        this.removeFocused(this.firstItem);
        return;
      }
      this.addFocused(this.firstItem);
      
      // const scrollTop = Math.abs(wrapperTop - offset);      
      if (scrollTop > wrapperOffsetTop) {
        this.scroll.style.height = scrollTop - wrapperOffsetTop + 'px';
        this.items.forEach((item) => {
          this.onItemInteraction(item);
        });
      } else {
        this.scroll.style.height = '0px';
      }
    }
  
    onResize() {
      let device = this.getCurrentDevice();
      // implement resize 
      var tl_classes = this.timeline.classList;
      var devices = ['mobile', 'tablet', 'desktop'];
      var current_device = '';
      tl_classes.forEach(function(tl_class){
        if(devices.includes(tl_class)){
          current_device = tl_class;
        }
      });
      this.timeline.classList.remove(current_device);
      this.timeline.classList.add(device);
      // implement resize
      this.setProgressBar();
    }

    getCurrentDevice(){
      const ww = window.innerWidth;
      const buBreakPoints = bricksUltra.breakpoints;
      let $device = '';
      if(ww >= 0 && ww<= buBreakPoints.mobile_landscape){
        $device = 'mobile';
      }else if(ww >= 991 ){
       $device = 'desktop';
      }else{
       $device = 'tablet';
      }
      return $device;
    }
  
    onItemInteraction(item) {
      const rect1 = this.scroll.getBoundingClientRect();
      const rect2 = item.getBoundingClientRect();
  
      if (
        rect2.bottom > rect1.top &&
        rect2.right > rect1.left &&
        rect2.top < rect1.bottom &&
        rect2.left < rect1.right
      ) {
        this.addFocused(item);
      } else {
        if (this.firstItem !== item) {
          this.removeFocused(item);
        }
      }
    }
  
    removeFocused(element) {
      const itemDataId = element.dataset.id;
      const itemData = this.timeline.querySelector(
        `.bultr-timeline-item[data-id="${itemDataId}"]`
      );
  
      if (itemData.classList.contains('bultr-tl-item-focused')) {
        itemData.classList.remove('bultr-tl-item-focused');
      }
    }
  
    addFocused(element) {
      const itemDataId = element.dataset.id;
      const itemData = this.timeline.querySelector(
        `.bultr-timeline-item[data-id="${itemDataId}"]`
      );
  
      if (!itemData.classList.contains('bultr-tl-item-focused')) {
        itemData.classList.add('bultr-tl-item-focused');
      }
    }
  }