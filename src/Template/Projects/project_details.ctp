	<?php 
	$projDT1=$projDT2=$designDT1=$designDT2=$devDT1=$devDT2=$testerDT1=$testerDT2='';
	
	if($reqfor == 'all' || $reqfor == 'columnbar_chart'):
		foreach($datas as $data):
			$chartdata[] = $data;
		endforeach;
		//echo $chartdata[0]['daterange'];
		//exit;
		//$cData=json_encode($chartdata);
		
		
		if(isset($chartdata[0]['daterange'])){
		$projDuration=$chartdata[0]['daterange'];
		$projsplit=@explode('-', $projDuration);
		$projDT1=$projsplit[0];
		$projDT2=$projsplit[1];
		}
		//exit;
		if(isset($chartdata[1]['daterange'])){
		$designDuration=$chartdata[1]['daterange'];
		$designjsplit=@explode('-', $designDuration);
		$designDT1=$designjsplit[0];
		$designDT2=$designjsplit[1];
		}
		if(isset($chartdata[2]['daterange'])){
		$developDuration=$chartdata[2]['daterange'];
		$devsplit=@explode('-', $developDuration);
		$devDT1=$devsplit[0];
		$devDT2=$devsplit[1];
		}
		if(isset($chartdata[3]['daterange'])){
		$testDuration=$chartdata[3]['daterange'];
		$testersplit=@explode('-', $testDuration);
		$testerDT1=$testersplit[0];
		$testerDT2=$testersplit[1];
		}
		
	?>
	<script type="text/javascript">
					var chartdata = <?php echo json_encode($chartdata); ?>;
					
			$(document).ready( function() {
									
					var chart2 = AmCharts.makeChart("columnbar_chart", {
						"theme": "light",
						"type": "serial",
						"dataProvider": chartdata,
						"valueAxes": [{
							"unit": "hrs",
							"position": "left",
							"title": "Time Efforts",
						}],
						"startDuration": 1,
						"graphs": [{
							"balloonText": "[[category]] Hours Assigned: <b>[[value]]</b>",
							"fillAlphas": 0.9,
							"lineAlpha": 0.2,
							"title": "Assigned (in hours)",
							"type": "column",
							"valueField": "assigned"
						}, {
							"balloonText": "[[category]] Hours Spent: <b>[[value]]</b>",
							"fillAlphas": 0.9,
							"lineAlpha": 0.2,
							"title": "Worked (in hours)",
							"type": "column",
							"clustered":false,
							"columnWidth":0.5,
							"valueField": "worked"
						}],
						"plotAreaFillAlphas": 0.1,
						"categoryField": "cap",
						"categoryAxis": {
							"gridPosition": "start"
						},
						"export": {
							"enabled": true
						 }
		
					});
					
				/*gantt chart*/	
					
				$('#jqChart').jqChart({
					
                title: { text: 'Gantt Chart' },
                animation: { duration: 1 },
                legend: {
                    visible: false
                },
                series: [
                    {
                        type: 'gantt',
                        fillStyles: ["#418CF0", "#FCB441", "#E0400A", "#056492", "#BFBFBF"],
						//data:chartdata,
						data: [
                            ['Start and End', new Date(<?php echo $projDT1; ?>), new Date(<?php echo $projDT2; ?>), 'Total Duration'],
                            ['Design', new Date(<?php echo $designDT1;  ?>), new Date(<?php echo $designDT2;  ?>), 'Design'],
                            ['Development', new Date(<?php echo $devDT1;  ?>), new Date(<?php echo $devDT2;  ?>), 'Development'],
                            ['Testing', new Date(<?php echo $testerDT1;  ?>), new Date(<?php echo $testerDT2;  ?>), 'Testing']
                        ],
                        labels: {
                            fillStyle: 'white',
                            font: '14px sans-serif'
                        }
                    }
                ]
            });
	
					
					
				});
			</script>
             <div class="row">
						<div class="col-lg-20">
							<div class="col-lg-10 col-md-10">
								<div class="box-dashboard">
									<div class="box-heading" id="columnbar_chart">Total hours worked today</div>
								</div>
							</div>;
							<div class="col-lg-10 col-md-10">
								<div class="box-dashboard">
									<div class="box-heading" id="jqChart" style=" width:100% ;height: 300px;">Average activity today</div>
								</div>
							</div>
							
							
						</div>
					</div>               
                            
			<?php 
			endif;
			
			if($reqfor == 'all' || $reqfor == 'budgetpie_chart'): ?>
			<script type="text/javascript">
				var chartdata = <?php echo json_encode($datas); ?>;
				$(document).ready( function() {
					var chart = AmCharts.makeChart( "budgetpie_chart", {
					  "type": "pie",
					  "theme": "light",
					  "dataProvider": chartdata,
					  "valueField": "paid",
					  "titleField": "title",
					   "balloon":{
						   "fixedPosition":true
						  },
					  "export": {
						"enabled": true
					  }
					} );
				});
				</script>
				<div id="budgetpie_chart"></div>
			<?php else:
				//echo '<center>Something went wrong. Please try again.</center>';
			endif; ?>