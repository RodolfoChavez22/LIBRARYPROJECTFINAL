<?php
include_once '../header.php';
?>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js"></script>
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-4">
				<div class="card mt-4">
					<div class="card-body">
						<div class="chart-container pie-chart">
							<canvas id="doughnut_chart3"></canvas>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<script>
	$(document).ready(function() {
		makechart();

		function makechart() {
			$.ajax({
				url: "charts/finesdata.php",
				method: "POST",
				data: {
					action: 'fetch'
				},
				dataType: "JSON",
				success: function(data) {
					var Fine_type = [];
					var total = [];
					var color = [];

					for (var count = 0; count < data.length; count++) {
						Fine_type.push(data[count].Fine_type);
						total.push(data[count].total);
						color.push(data[count].color);
					}

					var chart_data = {
						labels: Fine_type,
						datasets: [{
							label: 'Highest Fines Due',
							backgroundColor: color,
							color: '#fff',
							data: total
						}]
					};


					var group_chart = $('#doughnut_chart3');

					var graph = new Chart(group_chart, {
						type: "bar",
						data: chart_data,
						options: {
						responsive: true,
						scales: {
							yAxes: [{
								ticks: {
									beginAtZero: true,
									min: 0
								}
							}]
						}
					}
					});
				}
			})
		}

	});
</script>