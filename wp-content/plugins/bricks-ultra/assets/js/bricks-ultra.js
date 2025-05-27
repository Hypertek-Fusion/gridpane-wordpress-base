window.bultra =  {};
window.bultra.buGetBreakpoints = () => {
	const buBreakPoints = bricksUltra.breakpoints;
	const baseDevice = 	bricksUltra.baseDevice.baseDevice;
	const baseDeviceWidth = bricksUltra.baseDevice.baseDeviceWidht;
	const sortedBreakpoints = Object.entries(buBreakPoints).sort((a,b) => a[1]-b[1]);
		// const abcd2 = abcd.reduce((a, v) => ( { ...a, [v[0]]: v[1]}), {});
		const finalArr = {};
		sortedBreakpoints.map((element,i) => {
			finalArr[element[0]] = {};
			if(baseDeviceWidth == element[1]){
				if(sortedBreakpoints[i+1]) {
					finalArr[element[0]]['min'] = sortedBreakpoints[i-1][1];
					finalArr[element[0]]['max'] = sortedBreakpoints[i+1][1];
				}else{
					finalArr[element[0]]['min'] = sortedBreakpoints[i-1][1];
					finalArr[element[0]]['max'] = element[1]+1000;
				}
			}
			else if(baseDeviceWidth > element[1]) {
				finalArr[element[0]]['max'] = element[1];
				if(i !== 0){
					finalArr[element[0]]['min'] = sortedBreakpoints[i-1][1];
				}
			} else {
				finalArr[element[0]]['min'] = element[1];
				if(sortedBreakpoints[i+1]) {
					finalArr[element[0]]['max'] = sortedBreakpoints[i+1][1];
				} else {
					finalArr[element[0]]['max'] = element[1] + 1000;
				}	
			}
		});
		
		const key = Object.keys(finalArr)[0];
		finalArr[key]['min'] = 0;
		const innerWidth = window.innerWidth;
		let current_device = '';
		let lastElement = Object.keys(finalArr)[Object.keys(finalArr).length - 1];
		if(innerWidth > finalArr[lastElement]['max']){
			current_device = lastElement;
		}else{
			for (const k in finalArr) {
				if(innerWidth >= finalArr[k]['min'] && innerWidth <= finalArr[k]['max']){
					current_device = k;
				}
			}
		}		
		return current_device;
}

window.bultra.buGetDevices = () => {
	const buBreakPoints = bricksUltra.breakpoints;	
	let devices = Object.keys(buBreakPoints);
	return devices;
}

