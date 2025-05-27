document.addEventListener("DOMContentLoaded", function(t) {
	bricksIsFrontend && alertBox();
});

function alertBox(){
	const alertBoxes = bricksQuerySelectorAll(document, '.brxe-wpvbu-alert-box');
	alertBoxes.forEach((element) => {
		const id = element.getAttribute('id');
		const alert = element.querySelector('.bultr-alert-box');

		const layouts = JSON.parse(alert.getAttribute('layouts'));
		const buttons = element.querySelectorAll('.bultr-alert-button');
		const isDismissible = alert.getAttribute('dismissible');
		const dismiss_button = alert.querySelector('.bultr-dismiss-content');
		const isCookieSet = checkCookie(id);	
		let device = window.bultra.buGetBreakpoints();
		alert.classList.add(device);
		if(layouts){
			alert.classList.add('bultr-alert-icon-pos-'+layouts[device]);
		}
		
		if(bricksIsFrontend){
			if(isCookieSet == '1'){
				alert.style.display = 'none';
			}else{
				alert.classList.remove('alert-dismiss');
			}
		}
		
		if(buttons.length > 0){
			buttons.forEach(function(button){
				button.addEventListener('click',function(e){
					let pri_actions = button.getAttribute('actions');
					let actions = pri_actions.split(',');
					let isDefer = actions.includes('defer');
					let isDismiss = actions.includes('dismiss');
					if(bricksIsFrontend){
						if(isDefer && !isCookieSet == '1'){
							let expire_time = button.getAttribute('defer');
							if(expire_time == ''){
								expire_time = 43200;
							}
							setAlertCookie(expire_time, id,alert);
						}
					}
					if(isDismiss){
						alert.classList.add('alert-dismiss');
					}
				})
			})
		}

		if(isDismissible){
			dismiss_button.addEventListener('click',() => {
				alert.classList.add('alert-dismiss');
			})
		}

		function hideAlert(){
			alert.style.display = "none";
		}

		function setAlertCookie(expire_time,id ,alert){
			const cname = 'bultr-alert-cookie-' + id;
			const d = new Date();
			d.setTime(d.getTime() + (expire_time * 60 * 1000));
			let expires = "expires="+d.toUTCString();
			document.cookie = cname + "=" + "1" + ";" + expires + ";path=/";
			alert.classList.add('alert-dismiss');
		}

		function checkCookie() {
			let isCookie = getCookie('bultr-alert-cookie-' + id);
			if (isCookie) {
				return '1';
			} 
		}

		function getCookie(cname) {
			let name = cname + "=";
			let decodedCookie = decodeURIComponent(document.cookie);
			let ca = decodedCookie.split(';');
			for(let i = 0; i < ca.length; i++) {
			  let c = ca[i];
			  while (c.charAt(0) == ' ') {
				c = c.substring(1);
			  }
			  if (c.indexOf(name) == 0) {
				return c.substring(name.length, c.length);
			  }
			}
			return "";
		}

		window.addEventListener('resize', () => {
			if(layouts){
				onResize();
			}
		});

		function onResize() {
			let device = window.bultra.buGetBreakpoints();
			// implement resize 
			var alert_classes = alert.classList;
			var devices = window.bultra.buGetDevices();
			var current_device = '';
			alert_classes.forEach(function(alert_class){
			  if(devices.includes(alert_class)){
				current_device = alert_class;
			  }
			});
			if(current_device != ''){
				alert.classList.remove(current_device);
				alert.classList.remove('bultr-alert-icon-pos-'+layouts[current_device]);
			}
			alert.classList.add(device);
			alert.classList.add('bultr-alert-icon-pos-'+layouts[device]);
		}

	})
}
