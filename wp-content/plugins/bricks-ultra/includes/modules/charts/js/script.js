
document.addEventListener("DOMContentLoaded", function(t) {
	bricksIsFrontend && buCharts();
});
function buCharts(){

	const containers = document.querySelectorAll('.bultr-charts-wrapper');

	containers.forEach((element)=>{
		const chartWrap = element.querySelector('.bultr-chart-wrap');
		if(chartWrap != null || chartWrap != undefined){
			const canvas = element.querySelector('.bultr-chart-canvas');
			const id = element.id;
			const ctx = canvas.getContext("2d");

			let chartStatus = Chart.getChart(ctx);

			if (chartStatus != undefined) {
				chartStatus.destroy();
			}
			
			let chartDatas = chartWrap.dataset.chart;
			chartDatas = JSON.parse(chartDatas);
			if(chartDatas.type === 'polarArea' && chartDatas.enablePercentage == true){
				chartDatas.options.scales.r.ticks['callback'] = function(value, index, values) {
				return `${value}%`;
				} 
			}
			
			//highlight on load
			let offsetValue=chartDatas.offsetValue;			
			
			let key=0;
			let label_value = chartDatas.highlightLoad;
			const highlightOnLoad = {
				
				id: "highlightOnLoad",
				afterDatasetsDraw(chart, args, options) 
				{
				let labels = chartDatas.data.labels;
				let index =labels.indexOf(label_value)
				if(label_value !="" && key === 0){
					
					chart._metasets[0].data[index].options.offset = parseInt(offsetValue);
				}
				key++;
				}
			};
			if(label_value != ""){
				
				chartDatas.plugins = [highlightOnLoad];
			}

			new Chart(ctx, chartDatas);
		}
        
	});
		
}

