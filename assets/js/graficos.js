	var ctx = $("#myChart");
	var myChart = new Chart(ctx, {
		type: 'line',
		data: {
			labels: ["00:00", "04:00", "08:00", "12:00", "16:00", "20:00", "23:59"],
			datasets: [{
				label: 'Registro do dia 07/11/2018',
				data: [0, 15, 3, 18, 10, 11,10],
				backgroundColor: [
				'rgba(69, 69, 69, 0.2)'
				
				],
				borderColor: [
				'rgba(0,0,0,1)'
				
				],
				borderWidth: 1
			}]
		},
		options: {
			scales: {
				yAxes: [{
					ticks: {
						beginAtZero:true
					}
				}]
			}
		}
	});
	$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();   
});
