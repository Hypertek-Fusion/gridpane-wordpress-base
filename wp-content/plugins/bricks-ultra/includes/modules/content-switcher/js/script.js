document.addEventListener("DOMContentLoaded", function(t) {
	bricksIsFrontend && ContentSwitcher();
});

function ContentSwitcher(){
	const cs_elements = bricksQuerySelectorAll(document, '.brxe-wpvbu-content-switcher');
	cs_elements.forEach((element) => {
		var wrapper = element.querySelector('.bultr-cs-switcher-wrapper');
		ContentSwitcherButton(element);
		ContentSwitcherRadio(element);
		
	});
}


function ContentSwitcherButton(element){
	var buttons = element.querySelectorAll('.bultr-content-switch-button');
	buttons.forEach((button) => {
		button.addEventListener('click', (e) => {
			e.preventDefault();
			if(button.classList.contains('active')){
				return;
			}
			remove_active_all(buttons);
			const labelID = button.dataset.id;
			button.classList.add('active');
			const content_sections = element.querySelectorAll('.bultr-cs-content-section')
			remove_active_all(content_sections);
			element.querySelector('.bultr-cs-content-section[data-id="'+ labelID +'"]').classList.add('active');
		})
	});
}

function ContentSwitcherRadio(element){
	if(element.querySelector('.bultr-cs-layout_1')){
		return;
	}

	const toggle_switch = element.querySelector('.bultr-content-toggle-switch');
	const primary_label = element.querySelector('.bultr-content-switch-label.primary-label');
	const primary_id = primary_label.dataset.id;
	let secondary_label = element.querySelector('.bultr-content-switch-label.secondary-label');
	const secondary_id = secondary_label.dataset.id;

	const primary_content_section = element.querySelector('.bultr-cs-content-section[data-id="'+ primary_id +'"]');
	const secondary_content_section = element.querySelector('.bultr-cs-content-section[data-id="'+ secondary_id +'"]');

	toggle_switch.addEventListener('click', (e) => {
		if(e.target.checked){
			secondary_label.classList.add('active');
			secondary_content_section.classList.add('active');
			primary_label.classList.remove('active');
			primary_content_section.classList.remove('active');
		}else{
			primary_label.classList.add('active');
			primary_content_section.classList.add('active');
			secondary_label.classList.remove('active');
			secondary_content_section.classList.remove('active');
		}
	})
	
}

function remove_active_all(elements){
	elements.forEach((element) => {
		element.classList.remove('active');
	});
}