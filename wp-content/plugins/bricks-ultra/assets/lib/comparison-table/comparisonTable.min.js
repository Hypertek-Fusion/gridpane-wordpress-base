class Table {
  
    table;
    prevBtn;
    nextBtn;
    firstHeaderWidth;
    headers;
    items;
    secondHeaderWidth;
    scroller;
    isMovingByNav = false;
    checkboxes;
    selectedRows = [];
    filterBtn;
    resetBtn;
    isFilterable = '';
    cols='';
    headersWarp = '';
    isTransiting = false;
    current_device = '';
    table_settings = '';
  
    constructor(option) {
      this.table = option.table;
      this.isFilterable = option.isFilterable;
      this.cols = option.cols;
      this.init.bind(this)();
    }
  
    init() {
      this.prevBtn = this.table.querySelector('a.prev');
      this.nextBtn = this.table.querySelector('a.next');
      this.headers = this.table.querySelectorAll('.bultr-scroller .header');
      this.items = this.table.querySelector('.items');
      this.scroller = this.table.querySelector('.bultr-scroller');

      const table_settings_json = this.table.getAttribute('data-settings');
      this.table_settings = JSON.parse(table_settings_json);
      this.current_device = window.bultra.buGetBreakpoints();
      this.setGridCols();
      
      this.firstHeaderWidth = this.headers[0].offsetWidth;
      this.secondHeaderWidth = this.headers[1].offsetWidth;
      this.checkboxes = this.scroller.querySelectorAll('.header .check');
      this.filterBtn = this.table.querySelector('.apply-filter');
      this.resetBtn = this.table.querySelector('.reset-filter');
      this.prevBtn.style.left = `${this.firstHeaderWidth + 15}px`;
      this.headersWarp = this.table.querySelector('.bultr-headers');  
      
      // bind event
      this.nextBtn.addEventListener('click', (e) => this.onNext(e));
      this.prevBtn.addEventListener('click', (e) => this.onPrevious(e));
      this.scroller.addEventListener('scroll', (e) => this.onHeaderScroll(e));
      this.scroller.addEventListener('mouseover', (e) =>
        this.onHeaderMouseMove(e)
      );
    
      this.scroller.addEventListener('touchstart', (e) =>
        this.onHeaderTouchstart(e)
      );
      this.scroller.addEventListener('touchend', (e) => this.onHeaderTouchend(e));
      this.scroller.addEventListener('mouseout', (e) => this.onHeaderMouseOut(e));
      this.items.addEventListener('scroll', (e) => this.onItemsScroll(e));
      this.checkboxes.forEach((checkbox) => {
        checkbox.addEventListener('click', () => this.onCheckboxClick(checkbox));
      });
      if(this.isFilterable){
        this.filterBtn.addEventListener('click', () => this.applyFilter());
        this.resetBtn.addEventListener('click', () => this.resetFilter());
      }
      const imgs = this.table.querySelectorAll('img');
      if(imgs.length > 0){
        imgs[0].addEventListener('transitionstart', () => {
          this.isTransiting = true;
        })
        imgs[0].addEventListener('transitionend', () => {
          this.isTransiting = false;
        })
      }
    window.addEventListener('resize', (e) => {
      this.current_device = window.bultra.buGetBreakpoints();
      this.setGridCols();
    });  

    window.addEventListener('scroll', (e) => {
        if (this.headersWarp.offsetTop > 1) {
          if (!this.table.classList.contains('is-sticky')) {
            this.table.classList.add('is-sticky');
          }
        } else {
          if (this.table.classList.contains('is-sticky') && !this.isTransiting) {
          // if (this.table.classList.contains('is-sticky')){ 
            this.table.classList.remove('is-sticky');
          }
        }
      });
      
    }

    setGridCols() {
      this.scroller.style.gridTemplateColumns = 'minmax(' + this.table_settings.feature_col_width[this.current_device]+'px, 1fr) repeat(' + this.table_settings.table_count +',minmax('+ this.table_settings.table_col_width[this.current_device] +'px, 1fr))';
      this.items.style.gridTemplateColumns = 'minmax(' + this.table_settings.feature_col_width[this.current_device]+'px, 1fr) repeat(' + this.table_settings.table_count +',minmax('+ this.table_settings.table_col_width[this.current_device] +'px, 1fr))';
    }

    getCurrentDevice(){
      const ww = window.innerWidth;
      const buBreakPoints = bricksUltra.breakpoints;
      let $device = '';
      if(ww >=0 && ww <= buBreakPoints.mobile_portrait){
        $device = 'mobile_portrait';
      }else if(ww >= buBreakPoints.mobile_portrait && ww <= buBreakPoints.mobile_landscape){
        $device = 'mobile_landscape';
      }else if(ww >= buBreakPoints.mobile_landscape && ww <= buBreakPoints.tablet_landscape){
        $device = 'tablet_landscape';
      }else{
        $device = 'desktop';
      }
      return $device;
    }
  
    onNext(e) {
      e.preventDefault();
      const scrollLeft = this.items.scrollLeft;
      const left = scrollLeft + this.secondHeaderWidth;
  
      this.items.scroll({
        left: left,
        behavior: 'smooth',
      });
      this.scroller.scroll({
        left: left,
        behavior: 'smooth',
      });
      this.toggleNav(left);
    }
  
    onPrevious(e) {
      e.preventDefault();
      const scrollLeft = this.items.scrollLeft;
      const left = scrollLeft - this.secondHeaderWidth;
  
      this.items.scroll({
        left: left,
        behavior: 'smooth',
      });
      this.scroller.scroll({
        left: left,
        behavior: 'smooth',
      });
  
      this.toggleNav(left);
    }
  
    onHeaderScroll(e) {
      const event = new Event('scroll');
      this.items.dispatchEvent(event);
    }
  
    onHeaderMouseMove() {
      this.isMovingByNav = true;
    }
  
    onHeaderMouseOut() {
      this.isMovingByNav = false;
    }
  
    onHeaderTouchstart() {
      this.isMovingByNav = true;
    }
  
    onHeaderTouchend() {
      this.isMovingByNav = false;
    }
  
    onItemsScroll(e) {
      let scrollLeft = 0;
      if (this.isMovingByNav) {
        scrollLeft = this.scroller.scrollLeft;
        this.items.scrollLeft = scrollLeft;
      } else {
        scrollLeft = this.items.scrollLeft;
        this.scroller.scrollLeft = scrollLeft;
      }
  
      this.toggleNav(scrollLeft);
    }
  
    onCheckboxClick(checkbox) {
      checkbox.classList.toggle('selected');
      const col = parseInt(checkbox.getAttribute('data-cell'));
      if (checkbox.classList.contains('selected')) {
        this.selectedRows.push(col);
      } else {
        this.selectedRows.splice(this.selectedRows.indexOf(col), 1);
      }
      if(this.selectedRows.length > 0){
          this.table.classList.add('active-filter');
      }else{
        this.table.classList.remove('active-filter');
      }
    }
  
    applyFilter() {
      const selectedItems = this.selectedRows.length;
      if (selectedItems <= 0) return;
  
      this.headers.forEach((header, index) => {
        const check = header.querySelector('.check');
        if (check) {
          const dataId = +check.getAttribute('data-cell');
          if (index !== 0 && !this.selectedRows.includes(dataId)) {
            header.style.display = 'none';
          }
        }
      });
  
      Array.from(this.items.children).forEach((item, index) => {
        const dataId = +item.getAttribute('data-col');
        if (index !== 0 && !this.selectedRows.includes(dataId)) {
          item.style.display = 'none';
        }
      });
  
      const visibleWidth =
        this.firstHeaderWidth + this.secondHeaderWidth * selectedItems;
  
      this.toggleNav(visibleWidth);
  
      this.scroller.scrollLeft = 0;
      this.items.scrollLeft = 0;
  
      if (visibleWidth > this.scroller.clientWidth) {
        this.items.style.overflowX = 'scroll';
        this.scroller.style.overflowX = 'scroll';
        this.nextBtn.style.opacity = '1';
  
        this.changeColumnsCount(selectedItems);
      } else {
        this.items.style.overflowX = 'hidden';
        this.scroller.style.overflowX = 'hidden';
        this.nextBtn.style.opacity = '0';
        this.prevBtn.style.opacity = '0';
      }
      this.table.classList.add('filtered');
      this.table.classList.remove('active-filter');
    }
  
    resetFilter() {
      this.checkboxes.forEach((checkbox) => {
        checkbox.classList.remove('selected');
      });
  
      this.headers.forEach((header) => {
        header.style.display = '';
      });
  
      Array.from(this.items.children).forEach((item, index) => {
        item.style.display = '';
      });
  
      this.items.style.overflowX = 'scroll';
      this.scroller.style.overflowX = 'scroll';
      this.nextBtn.style.opacity = '1';
      
  
      this.selectedRows.length = 0;
      this.changeColumnsCount(this.cols);
      this.table.classList.remove('filtered');
    }
  
    changeColumnsCount(count) {
      this.setGridCols();
      // TODO:: get the defined with for first column and header columns and replace them below
      // this.scroller.style.gridTemplateColumns = `minmax(${this.firstHeaderWidth}px, 1fr) repeat(
      //     ${count},
      //     minmax(${this.secondHeaderWidth}px, 1fr)
      //   )`;
  
      // this.items.style.gridTemplateColumns = `minmax(${this.firstHeaderWidth}px, 1fr) repeat(
      //     ${count},
      //     minmax(${this.secondHeaderWidth}px, 1fr)
      //   )`;
    }
  
    toggleNav = (scrollLeft) => {
      if (!scrollLeft) {
        this.prevBtn.style.opacity = '0';
        return;
      }
  
      if (scrollLeft < this.scroller.scrollWidth - this.scroller.clientWidth) {
        this.nextBtn.style.opacity = '1';
      } else {
        this.nextBtn.style.opacity = '0';
      }
  
      if (scrollLeft > 0) {
        this.prevBtn.style.opacity = '1';
      } else {
        this.prevBtn.style.opacity = '0';
      }
    };
  }