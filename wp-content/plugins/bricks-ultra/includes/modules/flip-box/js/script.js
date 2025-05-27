document.addEventListener("DOMContentLoaded", function(t) {
	bricksIsFrontend && FlipBox();
});

function FlipBox(){
	const fb_elements = document.querySelectorAll('.bultr-flip-box-container');
	
	fb_elements.forEach((element) => {
		const {trigger} = element.dataset;

		const disabled = element?.dataset?.disable;

		if(disabled){
			return;
		}

		if(trigger === 'hover'){
			element.addEventListener('mouseover',(e) => {
				e.target.parentElement.classList.add('bultr-show');
				e.target.parentElement.classList.remove('bultr-hide');
			});
		}
		else{
			element.addEventListener('click',(e) => {
				e.target.parentElement.classList.add('bultr-show');
				e.target.parentElement.classList.remove('bultr-hide');
			});
		}
		
		element.addEventListener('mouseleave',(e) => {
			e.target.classList.remove('bultr-show');
			e.target.classList.add('bultr-hide');
		});
	});
}
