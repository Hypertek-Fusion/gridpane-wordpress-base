class BeforeAfter {
	className;
	defaultSliderOffset;
	orientation;
	moveSliderOnHover;
	moveWithHandlesOnly;
	clickToMove;
	beforeText;
	afterText;
	overlay;
	defaultSeparatorPosition;
  
	// POSSIBLE PARAMETERS VALUE
	//1. className: 'after-before' -> Slider container class name
	//2. defaultSliderOffset: 0.5 -> The slider handler position range from 0 to 1
	//3. orientation: 'horizontal' -> Slider orientation => 'vertical', 'horizontal'
	//4. moveWithHandlesOnly: true -> wether to move with slider handle only => true, false
	//5. clickToMove: false -> wether to move on container click => true, false
	//6. beforeText: 'Before' -> before image text
	//7. afterText: 'After' -> after image text
	//8. overlay: true -> wether to show overlay on hover => true, false
	//9. moveSliderOnHover: false -> wether to move slider on container hover => true, false
	//10. defaultSeparatorPosition: 50 -> position of handler => range from 1 to 100
  
	constructor(options) {
	  this.className = options?.className;
	  this.defaultSliderOffset = options?.defaultSliderOffset || 0.25;
	  this.orientation = options?.orientation || 'horizontal';
	  this.moveSliderOnHover = options?.moveSliderOnHover || false;
	  this.moveWithHandlesOnly = options?.moveWithHandlesOnly ?? true;
	  this.clickToMove = options?.clickToMove || false;
	  this.beforeText = options?.beforeText || '';
	  this.afterText = options?.afterText || '';
	  this.overlay = options?.overlay ?? true;
	  this.defaultSeparatorPosition = options?.defaultSeparatorPosition ?? 50;
  
	  if (this.className) {
		
		this.init();
	  }
	}
	
  
  
	init() {
	  const PREFIX = 'bultr-ic';
	  const elements = document.querySelectorAll(`.${this.className}`);
	  var timer;
	  elements.forEach((element) => {
		let isMouseHold = false;
		element.classList.add(
		  PREFIX + '-container',
		  `${PREFIX}-${this.orientation}`
		);
  
		const images = element.querySelectorAll('img');
  
		const firstImage = images[0];
		const lastImage = images[images.length - 1];
		if(!firstImage || !lastImage) return;
		const handleClassName = PREFIX + '-handle';
  
		const handle = element.querySelector(`.${handleClassName}`);
		const handleWidth = element.querySelector(`.${handleClassName}`).getBoundingClientRect().width;
		
		const handleBefore = element.querySelector(`.${handleClassName}-before`);
		const handleAfter = element.querySelector(`.${handleClassName}-after`);
		
		if (this.orientation === 'vertical') {
		  handleBefore.style.left =  `calc(50% + ${handleWidth/2}px`;
		  handleAfter.style.right = `calc(50% + ${handleWidth / 2}px`;
		  
		  const height = handleBefore.getBoundingClientRect().height;
		  handleBefore.style.marginTop = '-' + height / 2 + 'px';
		  handleAfter.style.marginTop = '-' + height / 2 + 'px';
		} else {
		  handleBefore.style.bottom = `calc(50% + ${handleWidth/2}px`;
		  handleAfter.style.top = `calc(50% + ${handleWidth / 2}px`;
		  const width = handleBefore.getBoundingClientRect().width;
		  handleBefore.style.marginLeft = '-' + width / 2 + 'px';
		  handleAfter.style.marginLeft = '-' + width / 2 + 'px';
		}
  
  
		let moveTarget = handle;
  
		if (!this.moveWithHandlesOnly) {
		  moveTarget = element;
		}
  
		// Return the number specified or the min/max number if it outside the range given.
		const minMaxNumber = function (num, min, max) {
		  return Math.max(min, Math.min(max, num));
		};
		
		// call on mouse move end
		const mouseStopped = () => {
		  if (this.moveSliderOnHover) {
			element.querySelector('.bultr-ic-overlay').classList.toggle('active');          
		  }
		}
		// Calculate the slider percentage based on the position.
		const getSliderPercentage = (positionX, positionY) => {
		  let sliderPercentage;
		  if (this.orientation === 'vertical') {
			sliderPercentage =
			  (positionY -
				parseFloat(element.getBoundingClientRect().top) -
				window.pageYOffset) /
			  firstImage.height;
		  } else {
			sliderPercentage =
			  (positionX -
				parseFloat(
				  element.getBoundingClientRect().left - window.pageXOffset
				)) /
			  firstImage.width;
		  }
		  return minMaxNumber(sliderPercentage, 0, 1);
		};
  
		const getOffset = (sliderPct) => {
		  const w = firstImage.width;
		  const h = firstImage.height;
		  const offset = {
			w: w + 'px',
			h: h + 'px',
			cw: sliderPct * w + 'px',
			ch: sliderPct * h + 'px',
		  };
  
		  return offset;
		};
  
		const adjustImage = (offset) => {
		  if (this.orientation === 'vertical') {
			firstImage.style.clip =
			  'rect(0,' + offset.w + ',' + offset.ch + ',0)';
			lastImage.style.clip =
			  'rect(' + offset.ch + ',' + offset.w + ',' + offset.h + ',0)';
		  } else {
			firstImage.style.clip =
			  'rect(0,' + offset.cw + ',' + offset.h + ',0)';
			lastImage.style.clip =
			  'rect(0,' + offset.w + ',' + offset.h + ',' + offset.cw + ')';
		  }
		};
  
		const adjustSlider = (offset) => {
		  if (this.orientation === 'vertical') {
			handle.style.top = offset.ch;
		  } else {
			handle.style.left = offset.cw;
		  }
		  
		  adjustImage(offset);
		  
		};
  
		const updateHandler = (e) => {
		  let offset;
		  if (e.type === 'touchmove') {
			offset = getOffset(
			  getSliderPercentage(
				e.changedTouches[0].pageX,
				e.changedTouches[0].pageY
			  )
			);
		  } else {
			offset = getOffset(getSliderPercentage(e.pageX, e.pageY));
		  }
  
		  if (offset) {
			adjustSlider(offset);
		  }
		};
  
		const onMouseMove = (e) => {
		  if (!isMouseHold) return;
		  if (this.moveSliderOnHover) {
			element.querySelector('.bultr-ic-overlay').classList.remove('active');
			clearTimeout(timer);
		  
			timer=setTimeout(mouseStopped,300);
		  }
		  
		  updateHandler(e);
		};
  
		moveTarget.addEventListener('mousedown', function (e) {
		  isMouseHold = true;
		  element.addEventListener('mousemove', onMouseMove);
		  return false;
		});
  
		moveTarget.addEventListener('touchstart', function (e) {
		  isMouseHold = true;
		  element.addEventListener('touchmove', onMouseMove);
		  return false;
		});
		element.addEventListener('mouseup', function () {
		  isMouseHold = false;
		  element.removeEventListener('mousemove', onMouseMove);
		});
  
		element.addEventListener('touchend', function () {
		  isMouseHold = false;
		  element.removeEventListener('touchmove', onMouseMove);
		});
  
		element.addEventListener('mouseleave', function () {
		  isMouseHold = false;
		  setTimeout(mouseStopped,300);
		  // element.querySelector('.bultr-ic-overlay').classList.remove('active');
		  element.removeEventListener('mousemove', onMouseMove);
		});
  
		element.addEventListener('touchcancel', function () {
		  isMouseHold = false;
		  element.removeEventListener('touchmove', onMouseMove);
		});
  
		if (this.moveSliderOnHover) {
		  element.addEventListener('mouseenter', () => {
			isMouseHold = true;
			element.querySelector('.bultr-ic-overlay').classList.add('active');
			element.addEventListener('mousemove', onMouseMove);
		  });
		}
  
		if (this.clickToMove) {
		  element.addEventListener('click', (e) => {
			updateHandler(e);
		  });
		}
		let overlay = element.querySelector(`.${PREFIX}-overlay`);
		if (! overlay) {
		  element.insertAdjacentHTML(
			'beforeend',
			`<div class='${PREFIX}-overlay ${this.overlay ? 'bg' : ''}'></div>`
		  );
		  overlay = element.querySelector(`.${PREFIX}-overlay`);
		  if (this.beforeText) {
			overlay.insertAdjacentHTML(
			  'beforeend',
			  `<div class='${PREFIX}-before-label bultr-ic-label' data-content='` +
				this.beforeText +
				"'></div>"
			);
		  }
		  if (this.afterText) {
			overlay.insertAdjacentHTML(
			  'beforeend',
			  `<div class='${PREFIX}-after-label bultr-ic-label' data-content='` +
				this.afterText +
				"'></div>"
			);
		  }
		}
  
		firstImage.classList.add(PREFIX + '-before');
		lastImage.classList.add(PREFIX + '-after');
		adjustSlider(getOffset(this.defaultSliderOffset));
	  });
	}
  }
  