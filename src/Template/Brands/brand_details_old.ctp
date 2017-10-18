<?php 

//print_r($datas);
	    foreach($datas as $data):
			$chartdata[] = $data;
		endforeach;
		  $statisticsCount= count($datas['statistics']);
		//print_r($datas['statistics']);
		//exit;
		 $search_val=$datas['brands']['search_val'];
		 $fb_pt=round($datas['brands']['Facebook']*100);
		 $twitter_pt=round($datas['brands']['Twitter']*100);
		 $guardian_pt=round($datas['brands']['Gaurdian']*100);
		 $ft_pt=round($datas['brands']['FT']*100);
		 $nytimes_pt=round($datas['brands']['NYTimes']*100);
		 
		 $aggregareCount=($fb_pt+$twitter_pt+$guardian_pt+$ft_pt+$nytimes_pt)/5;
		 $printmediaCount=($guardian_pt+$ft_pt+$nytimes_pt)/3;
		 echo $socialCount=($guardian_pt+$ft_pt+$nytimes_pt)/2;
		 $aggregare_pt=$aggregareCount/100;
		 
		 
		 
		 $Facebook_posts=$datas['brands']['Facebook_posts'];
		 $Twitter_posts=$datas['brands']['Twitter_posts'];
		 $Gaurdian_posts=$datas['brands']['Gaurdian_posts'];
		 $FT_posts=$datas['brands']['FT_posts'];
		 $NYTimes_posts=$datas['brands']['NYTimes_posts'];
		 
		 $fb_count=count($Facebook_posts);
		 $Twitter_count=count($Twitter_posts);
		 $Gaurdian_count=count($Gaurdian_posts);
		 $ft_count=count($FT_posts);
		 $NYTimes_count=count($NYTimes_posts);
		 //echo count($Facebook_posts);
		// exit;
		 
		$statistics=substr($datas['statistics'], 0, -1); 
        $splitStats=split("_",$statistics);
		 $count=count($splitStats);
		 
		 $newStats = array();

		foreach($splitStats as $statsData) {
		  $temp = explode(',', $statsData);
		  $key = array_shift($temp);
		  $newStats[$key][] = implode(',', $temp); 
		}
		
		//var_dump($new);
       $dateColumns=array_keys($newStats);
	  $dateCount=count($dateColumns);
   //print_r($dateColumns);
   
   
   
   
?>
<style>
.column-left {
	float: left;
	width: 33%;
}
.column-right {
	float: right;
	width: 33%;
}
.column-center {
	display: inline-block;
	width: 33%;
}
.pie-title-center {
	display: inline-block;
	position: relative;
	text-align: center;
}
.pie-value {
	display: block;
	position: absolute;
	font-size: 14px;
	height: 40px;
	top: 50%;
	left: 0;
	right: 0;
	margin-top: -20px;
	line-height: 40px;
}
.container {
	margin:50px auto;
	width:100%
}
table {
	border-collapse: collapse;
}
caption {
	background: #D3D3D3;
}
th {
	background: #A7C942;
	border: 1px solid #98BF21;
	color: #ffffff;
	font-weight: bold;
	text-align: center;
}
td {
	width:120px;
	border: 1px solid #98BF21;
	text-align: left;
	font-weight: normal;
	color: #000000;
}
tr:nth-child(odd) {
	background: #ffffff;
}
tbody tr:nth-child(odd) th {
	background: #ffffff;
	color: #000000;
}
tr:nth-child(even) {
	background: #EAF2D3;
}
tbody tr:nth-child(even) th {
	background: #EAF2D3;
	color: #000000;
}
#target {
	width: 600px;
	height: 400px;
}


/*accordian*/
.demo{ width:100%; }
a:hover,a:focus{
    text-decoration: none;
    outline: none;
}
#accordion .panel{
    border: none;
    background: transparent;
    box-shadow: none;
    border-radius: 0;
    margin: 0;
}
#accordion .panel-heading{
    padding: 0;
}
#accordion .panel-title a{
    display: block;
    padding: 15px 40px 15px 15px;
    background: #dc8127;
    font-size: 15px;
    font-weight: bold;
    color: #fff;
    text-transform: uppercase;
    border-bottom: 1px solid #fff;
    box-shadow: none;
    position: relative;
    transition: all 0.3s ease 0s;
}
#accordion .panel-title a.collapsed{
    color: #fff;
    border-bottom: none;
}
#accordion .panel-title a:before,
#accordion .panel-title a.collapsed:before{
    content: "\f0d7";
    font-family: FontAwesome;
    font-size: 22px;
    color: #ebb987;
    line-height: 24px;
    position: absolute;
    top: 11px;
    right: 10px;
    transition: all 0.3s ease 0s;
}
#accordion .panel-title a.collapsed:before{
    transform: rotate(-90deg);
}
#accordion .panel-title a:before,
#accordion .panel-title a.collapsed:hover{
    color: #333;
}
#accordion .panel-body{
    padding: 15px 27px;
    margin: 0 20px;
    background: #fff;
    font-size: 14px;
    color: #808080;
    line-height: 23px;
    border-top: none;
}
#accordion .panel-body p{
    margin-bottom: 0;
}
.postTitle{ color:#069; margin:10px; background-color:#EAEAEA;}
</style>
<script lang="javascript" type="text/javascript">


        $(document).ready(function () {
			
			/*Code for Bar Chart*/
			
            $('#jqChart').jqChart({
                title: { text: '' },
                animation: { duration: 1 },
                shadows: {
                    enabled: true
                },
                series: [
                    {
                        type: 'column',
                        title: 'Statistics',
                        fillStyles: ['#418CF0', '#FCB441', '#E0400A', '#056492', '#BFBFBF'],
                        data: [<?php if ($fb_pt>0)
{ ?>['Facebook', <?php echo $fb_pt;  ?>],<?php }  ?><?php if ($twitter_pt>0)
{?> ['Twitter', <?php echo $twitter_pt;  ?>],<?php }  ?><?php if ($guardian_pt>0)
{?> ['Guardian', <?php echo $guardian_pt;  ?>],<?php }  ?><?php if ($ft_pt>0)
{?>['FT', <?php echo $ft_pt;  ?>], <?php }  ?><?php if ($nytimes_pt>0)
{ ?>['Nyttimes', <?php echo $nytimes_pt;  ?>]<?php }  ?>]
                    }

                ]
            });
		/*Code for Bar Chart Ends here*/
		/*Code for Pie Chart*/
		$('#demo-pie-1').pieChart({
                barColor: '#68b828',
                trackColor: '#BFBFBF',
                lineCap: 'round',
                lineWidth: 8,
                onStep: function (from, to, percent) {
					var value=percent.toFixed(0);
					if(value>=50)
					{
						var percentString=' (Negative)';
					}
					else
					{
						var percentString=' (Positive)';
						
					}
                   $(this.element).find('.pie-value').text(percent.toFixed(0)+'% Negative' );
                }
            });

            $('#demo-pie-2').pieChart({
                barColor: '#8465d4',
                trackColor: '#BFBFBF',
                lineCap: 'butt',
                lineWidth: 8,
                onStep: function (from, to, percent) {
					var value=percent.toFixed(0);
					if(value>=50)
					{
						var percentString=' (Negative)';
					}
					else
					{
						var percentString=' (Positive)';
						
					}
                    $(this.element).find('.pie-value').text(percent.toFixed(0)+'% Negative' );
                    //$(this.element).find('.pie-value').text(percent.toFixed(0)+'%');
                }
            });

            $('#demo-pie-3').pieChart({
                barColor: '#F30',
                trackColor: '#BFBFBF',
                lineCap: 'square',
                lineWidth: 8,
                onStep: function (from, to, percent) {
					var value=percent.toFixed(0);
					if(value>=50)
					{
						var percentString=' (Negative)';
					}
					else
					{
						var percentString=' (Positive)';
						
					}
                    $(this.element).find('.pie-value').text(percent.toFixed(0)+'% Negative' );
                    //$(this.element).find('.pie-value').text(percent.toFixed(0)+'%');
                }
            });

            $('#demo-pie-4').pieChart({
                barColor: '#FF0',
                trackColor: '#BFBFBF',
                lineCap: 'round',
                lineWidth: 8,
                rotate: 90,
                onStep: function (from, to, percent) {
					var value=percent.toFixed(0);
					if(value>=50)
					{
						var percentString=' (Negative)';
					}
					else
					{
						var percentString=' (Positive)';
						
					}
                   $(this.element).find('.pie-value').text(percent.toFixed(0)+'% Negative' );
                    //$(this.element).find('.pie-value').text(percent.toFixed(0)+'%' );
                }
            });
			
			$('#demo-pie-5').pieChart({
                barColor: '#0CF',
                trackColor: '#BFBFBF',
                lineCap: 'round',
                lineWidth: 8,
                rotate: 90,
                onStep: function (from, to, percent) {
					var value=percent.toFixed(0);
					if(value>=50)
					{
						var percentString=' (Negative)';
					}
					else
					{
						var percentString=' (Positive)';
						
					}
                    $(this.element).find('.pie-value').text(percent.toFixed(0)+'% Negative' );
					//$(this.element).find('.pie-value').text(percent.toFixed(0)+'%'+percentString );
                    //$(this.element).find('.pie-value').text(percent.toFixed(0)+'%');
                }
            });
		/*Code for Pie Chart ends here*/
		
		/*code for aggrigated pie chart*/
		var background = {
                type: 'linearGradient',
                x0: 0,
                y0: 0,
                x1: 0,
                y1: 1,
                colorStops: [{ offset: 0, color: '#d2e6c9' },
                             { offset: 1, color: 'white' }]
            };

            $('#jqChartPie').jqChart({
                title: { text: 'Aggregated Chart ' },
                legend: { title: 'Social' },
                border: { strokeStyle: '#6ba851' },
                background: background,
                animation: { duration: 1 },
                shadows: {
                    enabled: true
                },
                series: [
                    {
                        type: 'pie',
                        fillStyles: ['#418CF0', '#FCB441', '#E0400A', '#056492', '#BFBFBF', '#1A3B69', '#FFE382'],
                        labels: {
                            stringFormat: '%.1f%%',
                            valueType: 'percentage',
                            font: '15px sans-serif',
                            fillStyle: 'white'
                        },
                        explodedRadius: 10,
                        explodedSlices: [5],
                        data: [['Facebook', <?php echo $fb_pt;  ?>], ['Twitter', <?php echo $twitter_pt;  ?>], ['Guardian', <?php echo $guardian_pt;  ?>],
                               ['FT', <?php echo $ft_pt;  ?>], ['Nyttimes', <?php echo $nytimes_pt;  ?>]]
                    }
                ]
            });

            $('#jqChartPie').bind('tooltipFormat', function (e, data) {
                var percentage = data.series.getPercentage(data.value);
                percentage = data.chart.stringFormat(percentage, '%.2f%%');

                return '<b>' + data.dataItem[0] + '</b><br />' +
                       data.value + ' (' + percentage + ')';
            });

		/*code for aggrigated pie chart ends here*/
		
		/*code for Aggregate  chart (Week Report)*/
		
		//$('#source1').tableBarChart('#target', '', false);
		
  		$('table.line').visualize({type: 'line',width:700});
		$('table.aggregate').visualize({type: 'pie', pieMargin: 10,width:300,height:200});
		$('table.print').visualize({type: 'pie', pieMargin: 10,width:300, height:200});
		$('table.social').visualize({type: 'pie', pieMargin: 10,width:300, height:200});
		
		
		/*Records Accordian Display*/
		$(".panelFB,.panelTWT,.panelGUA,.panelFT,.panelNYT").hide();
		$( ".accordionFB" ).click(function() {
			
			$(".panelFB").toggle();
			
		});
		$( ".accordionTWT" ).click(function() {
			
			$(".panelTWT").toggle();
			
		});
		
		$( ".accordionGUA" ).click(function() {
			
			$(".panelGUA").toggle();
			
		});
		$( ".accordionFT" ).click(function() {
			
			$(".panelFT").toggle();
			
		});
		$( ".accordionNYT" ).click(function() {
			
			$(".panelNYT").toggle();
			
		});
	
		
		
		});
		
		
    </script>
    <form method="post" action="" id="search_results">
    <input type="hidden" name="search_val" id="search_val" value="<?php echo $search_val; ?>">
    <input type="hidden" name="search_brand[]"  value="Facebook_<?php echo $datas['brands']['Facebook']; ?>">
    <input type="hidden" name="search_brand[]"  value="Twitter_<?php echo $datas['brands']['Twitter']; ?>">
    <input type="hidden" name="search_brand[]"  value="Guardian_<?php echo $datas['brands']['Gaurdian']; ?>">
    <input type="hidden" name="search_brand[]"  value="FT_<?php echo $datas['brands']['FT']; ?>">
    <input type="hidden" name="search_brand[]"  value="NYTimes_<?php echo $datas['brands']['NYTimes']; ?>">
    </form>
<?php if($datas['statistics']!=''){ ?>
<h2 style="color: #36C; font-weight:bold;">Week statistics Graph for "<?php echo $search_val;  ?>"</h2>

<div class="wrapper" style="margin:20px;">


  <table id="source1" class="line" style="display:none" >
    <caption>Week statistics (%)</caption>
    
    <thead>
      <tr>
        <td></td>
        <?php foreach ($dateColumns as $mainColumn):  ?>
        <th scope="col"> <?php
	   echo $mainColumn ; ?>
        </th>
        <?php endforeach; ?>
      </tr>
    </thead>
    <tbody>
      <?php if ($fb_pt>0){ ?>
      <tr>
        <th scope="row">Facebook</th>
        <?php foreach ($dateColumns as $mainColumn):  ?>
        <td><?php
	   $val=split(',',$newStats[$mainColumn][0]);
	   $percentVal=round($val[1] *100);
	   if($percentVal>=50)
	   {
		 $feedbackString='Negative';  
	   }
	   else
	   {
		  $feedbackString='Positive';  
	   }
	   echo round($val[1] *100); ?>
          % Negative</td>
        <?php endforeach; ?>
      </tr>
      <?php }  ?>
      <?php if ($twitter_pt>0){ ?>
      <tr>
        <th scope="row">Twitter</th>
        <?php foreach ($dateColumns as $mainColumn):  ?>
        <td><?php
	   $val=split(',',$newStats[$mainColumn][1]);
	   $percentVal=round($val[1] *100);
	  if($percentVal>=50)
	   {
		 $feedbackString='Negative';  
	   }
	   else
	   {
		  $feedbackString='Positive';  
	   }
	   echo round($val[1] *100); ?>
          % Negative</td>
        <?php endforeach; ?>
      </tr>
      <?php }  ?>
      <?php if ($guardian_pt>0){ ?>
      <tr>
        <th scope="row">Gaurdian</th>
        <?php foreach ($dateColumns as $mainColumn):  ?>
        <td><?php
	   $val=split(',',$newStats[$mainColumn][2]);
	   $percentVal=round($val[1] *100);
	   if($percentVal>=50)
	   {
		 $feedbackString='Negative';  
	   }
	   else
	   {
		  $feedbackString='Positive';  
	   }
	   echo round($val[1] *100); ?>
          % Negative</td>
        <?php endforeach; ?>
      </tr>
      <?php }  ?>
      <?php if ($ft_pt>0){ ?>
      <tr>
        <th scope="row">FT</th>
        <?php foreach ($dateColumns as $mainColumn):  ?>
        <td><?php
	   $val=split(',',$newStats[$mainColumn][3]);
	   $percentVal=round($val[1] *100);
	   if($percentVal>=50)
	   {
		 $feedbackString='Negative';  
	   }
	   else
	   {
		  $feedbackString='Positive';  
	   }
	   echo round($val[1] *100); ?>
          % Negative</td>
        <?php endforeach; ?>
      </tr>
      <?php }  ?>
      <?php if ($nytimes_pt>0){ ?>
      <tr>
        <th scope="row">Nytymes</th>
        <?php foreach ($dateColumns as $mainColumn):  ?>
        <td><?php
	   $val=split(',',$newStats[$mainColumn][4]);
	   $percentVal=round($val[1] *100);
	   if($percentVal>=50)
	   {
		 $feedbackString='Negative';  
	   }
	   else
	   {
		  $feedbackString='Positive';  
	   }
	   echo round($val[1] *100); ?>
          % Negative</td>
        <?php endforeach; ?>
      </tr>
      <?php }  ?>
    </tbody>
  </table>
</div>
<div class="container">
  <div class="column-left">
    <table id="source1" class="aggregate table" style="display:none" >
        <caption>Aggregate Chart (%)</caption>

      <thead>
        <tr>
          <th>&nbsp;</th>
          <?php foreach ($dateColumns as $mainColumn):  ?>
          <th> <?php
	   echo $mainColumn ; ?>
          </th>
          <?php endforeach; ?>
        </tr>
      </thead>
      <tbody>
        <?php if ($fb_pt>0){ ?>
        <tr>
          <th>Facebook</th>
          <?php foreach ($dateColumns as $mainColumn):  ?>
          <td><?php
	   $val=split(',',$newStats[$mainColumn][0]);
	   $percentVal=round($val[1] *100);
	   if($percentVal>=50)
	   {
		 $feedbackString='Negative';  
	   }
	   else
	   {
		  $feedbackString='Positive';  
	   }
	   echo round($val[1] *100); ?>
            % Negative</td>
          <?php endforeach; ?>
        </tr>
        <?php }  ?>
        <?php if ($twitter_pt>0){ ?>
        <tr>
          <th>Twitter</th>
          <?php foreach ($dateColumns as $mainColumn):  ?>
          <td><?php
	   $val=split(',',$newStats[$mainColumn][1]);
	   $percentVal=round($val[1] *100);
	  if($percentVal>=50)
	   {
		 $feedbackString='Negative';  
	   }
	   else
	   {
		  $feedbackString='Positive';  
	   }
	   echo round($val[1] *100); ?>
            % Negative</td>
          <?php endforeach; ?>
        </tr>
        <?php }  ?>
        <?php if ($guardian_pt>0){ ?>
        <tr>
          <th>Gaurdian</th>
          <?php foreach ($dateColumns as $mainColumn):  ?>
          <td><?php
	   $val=split(',',$newStats[$mainColumn][2]);
	   $percentVal=round($val[1] *100);
	   if($percentVal>=50)
	   {
		 $feedbackString='Negative';  
	   }
	   else
	   {
		  $feedbackString='Positive';  
	   }
	   echo round($val[1] *100); ?>
            % Negative</td>
          <?php endforeach; ?>
        </tr>
        <?php }  ?>
        <?php if ($ft_pt>0){ ?>
        <tr>
          <th>FT</th>
          <?php foreach ($dateColumns as $mainColumn):  ?>
          <td><?php
	   $val=split(',',$newStats[$mainColumn][3]);
	   $percentVal=round($val[1] *100);
	   if($percentVal>=50)
	   {
		 $feedbackString='Negative';  
	   }
	   else
	   {
		  $feedbackString='Positive';  
	   }
	   echo round($val[1] *100); ?>
            % Negative</td>
          <?php endforeach; ?>
        </tr>
        <?php }  ?>
        <?php if ($nytimes_pt>0){ ?>
        <tr>
          <th>Nytymes</th>
          <?php foreach ($dateColumns as $mainColumn):  ?>
          <td><?php
	   $val=split(',',$newStats[$mainColumn][4]);
	   $percentVal=round($val[1] *100);
	   if($percentVal>=50)
	   {
		 $feedbackString='Negative';  
	   }
	   else
	   {
		  $feedbackString='Positive';  
	   }
	   echo round($val[1] *100); ?>
            % Negative</td>
          <?php endforeach; ?>
        </tr>
        <?php }  ?>
      </tbody>
    </table>
  </div>
  <div class="column-center">
    <table id="source1" class="print table" style="display:none">
        <caption>Print Media Statistics (%)</caption>

      <thead>
        <tr>
          <th>&nbsp;</th>
          <?php foreach ($dateColumns as $mainColumn):  ?>
          <th> <?php
	   echo $mainColumn ; ?>
          </th>
          <?php endforeach; ?>
        </tr>
      </thead>
      <tbody>
        <?php if ($guardian_pt>0){ ?>
        <tr>
          <th>Gaurdian</th>
          <?php foreach ($dateColumns as $mainColumn):  ?>
          <td><?php
	   $val=split(',',$newStats[$mainColumn][2]);
	   $percentVal=round($val[1] *100);
	   if($percentVal>=50)
	   {
		 $feedbackString='Negative';  
	   }
	   else
	   {
		  $feedbackString='Positive';  
	   }
	   echo round($val[1] *100); ?>
            % Negative</td>
          <?php endforeach; ?>
        </tr>
        <?php }  ?>
        <?php if ($ft_pt>0){ ?>
        <tr>
          <th>FT</th>
          <?php foreach ($dateColumns as $mainColumn):  ?>
          <td><?php
	   $val=split(',',$newStats[$mainColumn][3]);
	   $percentVal=round($val[1] *100);
	   if($percentVal>=50)
	   {
		 $feedbackString='Negative';  
	   }
	   else
	   {
		  $feedbackString='Positive';  
	   }
	   echo round($val[1] *100); ?>
            % Negative</td>
          <?php endforeach; ?>
        </tr>
        <?php }  ?>
        <?php if ($nytimes_pt>0){ ?>
        <tr>
          <th>Nytymes</th>
          <?php foreach ($dateColumns as $mainColumn):  ?>
          <td><?php
	   $val=split(',',$newStats[$mainColumn][4]);
	   $percentVal=round($val[1] *100);
	   if($percentVal>=50)
	   {
		 $feedbackString='Negative';  
	   }
	   else
	   {
		  $feedbackString='Positive';  
	   }
	   echo round($val[1] *100); ?>
            % Negative</td>
          <?php endforeach; ?>
        </tr>
        <?php }  ?>
      </tbody>
    </table>
  </div>
  <div class="column-right">
    <table id="source1" class="social table" style="display:none;">
            <caption>Social Media Statistics (%)</caption>

      <thead>
        <tr>
          <th>&nbsp;</th>
          <?php foreach ($dateColumns as $mainColumn):  ?>
          <th> <?php
	   echo $mainColumn ; ?>
          </th>
          <?php endforeach; ?>
        </tr>
      </thead>
      <tbody>
        <?php if ($fb_pt>0){ ?>
        <tr>
          <th>Facebook</th>
          <?php foreach ($dateColumns as $mainColumn):  ?>
          <td><?php
	   $val=split(',',$newStats[$mainColumn][0]);
	   $percentVal=round($val[1] *100);
	   if($percentVal>=50)
	   {
		 $feedbackString='Negative';  
	   }
	   else
	   {
		  $feedbackString='Positive';  
	   }
	   echo round($val[1] *100); ?>
            % Negative</td>
          <?php endforeach; ?>
        </tr>
        <?php }  ?>
        <?php if ($twitter_pt>0){ ?>
        <tr>
          <th>Twitter</th>
          <?php foreach ($dateColumns as $mainColumn):  ?>
          <td><?php
	   $val=split(',',$newStats[$mainColumn][1]);
	   $percentVal=round($val[1] *100);
	  if($percentVal>=50)
	   {
		 $feedbackString='Negative';  
	   }
	   else
	   {
		  $feedbackString='Positive';  
	   }
	   echo round($val[1] *100); ?>
            % Negative</td>
          <?php endforeach; ?>
        </tr>
        <?php }  ?>
      </tbody>
    </table>
  </div>
</div>
<?php  }  ?>
<div style=" height:30px;">&nbsp;</div>

<div style=" height:30px;"><h2>Search Statistics Graph</h2></div>

<!---  Code for pie   chart    -->

<div class="row">
  <div class="col-lg-20">
    <div class="col-lg-10 col-md-6">
      <div class="box-dashboard">
        <div class="box-heading">
          <div class="container">
            <?php if ($fb_pt>0){ ?>
            <div id="demo-pie-1" class="pie-title-center" data-percent="<?php echo $fb_pt;  ?>"> <span class="pie-value"></span>
              <div>Facebook</div>
            </div>
            <?php }  ?>
            <?php if ($twitter_pt>0){ ?>
            <div id="demo-pie-2" class="pie-title-center" data-percent="<?php echo $twitter_pt;  ?>"> <span class="pie-value"></span>
              <div>Twitter</div>
            </div>
            <?php } ?>
            <?php if ($guardian_pt>0){ ?>
            <div id="demo-pie-3" class="pie-title-center" data-percent=" <?php echo $guardian_pt;  ?>"> <span class="pie-value"></span>
              <div>Gaurdian</div>
            </div>
            <?php }  ?>
            <?php if ($ft_pt>0){ ?>
            <div id="demo-pie-4" class="pie-title-center" data-percent="<?php echo $ft_pt;  ?>"> <span class="pie-value"></span>
              <div>FT</div>
            </div>
            <?php }  ?>
            <?php if ($nytimes_pt>0){ ?>
            <div id="demo-pie-5" class="pie-title-center" data-percent="<?php echo $nytimes_pt;  ?>"> <span class="pie-value"></span>
              <div>NYTimes</div>
            </div>
            <?php }  ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
   <h2>Search Results Data of "<?php echo $search_val; ?>"</h2>

<div class="demo">
    <div class="container">
        <div class="row">
            <div class="col-lg-16">
                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                    <?php if($fb_pt>0){ ?>
                    
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingOne">
                            <h4 class="panel-title">
                                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    Facebook results<span style="float:right; margin-right:20px">Score:<?php echo $fb_pt; ?>%</span>
                                </a>
                                
                            </h4>
                        </div>
                        <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                            <div class="panel-body">
                                <?php
								
		                        for($i = 0 ; $i < $fb_count ; $i++){
									?>
								<p class="postTitle"><?php echo $Facebook_posts[$i]; ?></p>
								
								<?php  }  ?>  
                                
                                
                            </div>
                        </div>
                    </div>
                    <?php  }  ?>
                    <?php if($twitter_pt>0) { ?>
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingTwo">
                            <h4 class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    Twitter Results<span style="float:right; margin-right:20px">Score:<?php echo $twitter_pt; ?>%</span>
                                </a>
                            </h4>
                        </div>
                        <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                            <div class="panel-body">
                                <?php
								
		                        for($i = 0 ; $i < $Twitter_count ; $i++){
									?>
								<p class="postTitle"><?php echo $Twitter_posts[$i]; ?></p>
								
								<?php  }  ?>
                            </div>
                        </div>
                    </div>
                    <?php }  ?>
                    <?php if($guardian_pt>0){ ?>
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingThree">
                            <h4 class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    Guardian Results<span style="float:right; margin-right:20px">Score:<?php echo $guardian_pt; ?>%</span>
                                </a>
                            </h4>
                        </div>
                        <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                            <div class="panel-body">
                               <?php
								
		                        for($i = 0 ; $i < $Gaurdian_count ; $i++){
									?>
								<p class="postTitle"><?php echo $Gaurdian_posts[$i]; ?></p>
								
								<?php  }  ?>
                            </div>
                        </div>
                    </div>
                    <?php }  ?>
                    
                    <?php if($ft_pt>0){ ?>
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingFour">
                            <h4 class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                    Financial Time Results<span style="float:right; margin-right:20px">Score:<?php echo $ft_pt; ?>%</span>
                                </a>
                            </h4>
                        </div>
                        <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
                            <div class="panel-body">
                               <?php
								
		                        for($i = 0 ; $i < $ft_count ; $i++){
									?>
								<p class="postTitle"><?php echo $FT_posts[$i]; ?></p>
								
								<?php  }  ?>
                            </div>
                        </div>
                    </div>
                    <?php }  ?>
                    
                    <?php if($nytimes_pt>0){ ?>
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingFive">
                            <h4 class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                    NYTimes Results<span style="float:right; margin-right:20px">Score:<?php echo $nytimes_pt; ?>%</span>
                                </a>
                            </h4>
                        </div>
                        <div id="collapseFive" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFive">
                            <div class="panel-body">
                               <?php
								
		                        for($i = 0 ; $i < $NYTimes_count ; $i++){
									?>
								<p class="postTitle"><?php echo $NYTimes_posts[$i]; ?></p>
								
								<?php  }  ?>
                            </div>
                        </div>
                    </div>
                    <?php }  ?>
                </div>
            </div>
        </div>
    </div>
</div>
