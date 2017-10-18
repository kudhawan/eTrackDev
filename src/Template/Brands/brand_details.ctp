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
		 $linkidin_pt=round($datas['brands']['Linkidin']*100);
		 $bingo_pt=round($datas['brands']['Bingo']*100);
		 
		 
		 $fb_devide=$twt_devide=$gd_devide=$ft_devide=$nyt_devide=$linkidin_devide=$bingo_devide=0;
		 if($fb_pt>0){$fb_devide=1;}
		 if($twitter_pt>0){$twt_devide=1;}
		 if($guardian_pt>0){$gd_devide=1;}
		 if($ft_pt>0){$ft_devide=1;}
		 if($nytimes_pt>0){$nyt_devide=1;}
		// if($linkidin_pt>0){$linkidin_devide=1;}
		 if($bingo_pt>0){$bingo_devide=1;}
		 
		 $aggregat_devide=$fb_devide+$twt_devide+$gd_devide+$ft_devide+$nyt_devide+$linkidin_devide+$bingo_devide;
		 $socail_devide=$fb_devide+$twt_devide+$linkidin_devide;
		 $print_devide=$gd_devide+$ft_devide+$nyt_devide+$bingo_devide;
		 
		 $aggregareCount=($fb_pt+$twitter_pt+$guardian_pt+$ft_pt+$nytimes_pt+$linkidin_pt)/$aggregat_devide;
		 $printmediaCount=($guardian_pt+$ft_pt+$nytimes_pt+$bingo_pt)/$print_devide;
		 $socialCount=($fb_pt+$twitter_pt+$linkidin_pt)/$socail_devide;
		 
		 
		 
		 $Facebook_posts=$datas['brands']['Facebook_posts'];
		 $Twitter_posts=$datas['brands']['Twitter_posts'];
		 $Gaurdian_posts=$datas['brands']['Gaurdian_posts'];
		 $FT_posts=$datas['brands']['FT_posts'];
		 $NYTimes_posts=$datas['brands']['NYTimes_posts'];
		 $Linkidin_posts=$datas['brands']['Linkidin_posts'];
		 $Bingo_posts=$datas['brands']['Bingo_posts'];
		 
		 $fb_count=count($Facebook_posts);
		 $Twitter_count=count($Twitter_posts);
		 $Gaurdian_count=count($Gaurdian_posts);
		 $ft_count=count($FT_posts);
		 $NYTimes_count=count($NYTimes_posts);
		 $Linkidin_count=count($Linkidin_posts);
		 $Bingo_count=count($Bingo_posts);
		 //echo count($Facebook_posts);
		// exit;
		 
		$statistics=substr($datas['statistics'], 0, -1); 
        $splitStats=@explode("_",$statistics);
		 $count=count($splitStats);
		 
		 $newStats = array();

		foreach($splitStats as $statsData) {
		  $temp = @explode(',', $statsData);
		  $key = array_shift($temp);
		  $newStats[$key][] = implode(',', $temp); 
		}
		
		//var_dump($new);
       $dateColumns=array_keys($newStats);
	  $dateCount=count($dateColumns);
   //print_r($dateColumns);
   
   
   
   
?>
<style>
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
.demo {
	width:100%;
}
a:hover, a:focus {
	text-decoration: none;
	outline: none;
}
a {
	cursor:pointer;
}
</style>
<script lang="javascript" type="text/javascript">
    $(document).ready(function () {
		/*Code for Pie Chart*/
			$('#demo-aggregate').pieChart({
                barColor: '#0CF',
                trackColor: '#BFBFBF',
                lineCap: 'round',
                lineWidth: 8,
                rotate: 90,
                onStep: function (from, to, percent) {
					var value=percent.toFixed(0);
					
                    $(this.element).find('.pie-value').text(percent.toFixed(0)+'% Negative' );
                }
            });
			
			$('#demo-facebook').pieChart({
                barColor: '#68b828',
                trackColor: '#BFBFBF',
                lineCap: 'round',
                lineWidth: 8,
                rotate: 90,
                onStep: function (from, to, percent) {
					var value=percent.toFixed(0);
					
                    $(this.element).find('.pie-value').text(percent.toFixed(0)+'% Negative' );
                }
            });
			
			$('#demo-twitter').pieChart({
                barColor: '#8465d4',
                trackColor: '#BFBFBF',
                lineCap: 'round',
                lineWidth: 8,
                rotate: 90,
                onStep: function (from, to, percent) {
					var value=percent.toFixed(0);
					
                    $(this.element).find('.pie-value').text(percent.toFixed(0)+'% Negative' );
                }
            });
			
			$('#demo-ft').pieChart({
                barColor: '#FF0',
                trackColor: '#BFBFBF',
                lineCap: 'round',
                lineWidth: 8,
                rotate: 90,
                onStep: function (from, to, percent) {
					var value=percent.toFixed(0);
					
                    $(this.element).find('.pie-value').text(percent.toFixed(0)+'% Negative' );
                }
            });
			
			$('#demo-guardian').pieChart({
                barColor: '#F30',
                trackColor: '#BFBFBF',
                lineCap: 'round',
                lineWidth: 8,
                rotate: 90,
                onStep: function (from, to, percent) {
					var value=percent.toFixed(0);
					
                    $(this.element).find('.pie-value').text(percent.toFixed(0)+'% Negative' );
                }
            });
			$('#demo-nytymes').pieChart({
                barColor: '#F0F',
                trackColor: '#BFBFBF',
                lineCap: 'round',
                lineWidth: 8,
                rotate: 90,
                onStep: function (from, to, percent) {
					var value=percent.toFixed(0);
					
                    $(this.element).find('.pie-value').text(percent.toFixed(0)+'% Negative' );
                }
            });
			
			$('#demo-linkidin').pieChart({
                barColor: '#033',
                trackColor: '#BFBFBF',
                lineCap: 'round',
                lineWidth: 8,
                rotate: 90,
                onStep: function (from, to, percent) {
					var value=percent.toFixed(0);
					
                    $(this.element).find('.pie-value').text(percent.toFixed(0)+'% Negative' );
                }
            });
			
			$('#demo-bingo').pieChart({
                barColor: '#033',
                trackColor: '#BFBFBF',
                lineCap: 'round',
                lineWidth: 8,
                rotate: 90,
                onStep: function (from, to, percent) {
					var value=percent.toFixed(0);
					
                    $(this.element).find('.pie-value').text(percent.toFixed(0)+'% Negative' );
                }
            });
			
			
			$('#demo-social').pieChart({
                barColor: '#C33',
                trackColor: '#BFBFBF',
                lineCap: 'round',
                lineWidth: 8,
                rotate: 90,
                onStep: function (from, to, percent) {
					var value=percent.toFixed(0);
					
                    $(this.element).find('.pie-value').text(percent.toFixed(0)+'% Negative' );
                }
            });
			
			$('#demo-print').pieChart({
                barColor: '#00F',
                trackColor: '#BFBFBF',
                lineCap: 'round',
                lineWidth: 8,
                rotate: 90,
                onStep: function (from, to, percent) {
					var value=percent.toFixed(0);
					
                    $(this.element).find('.pie-value').text(percent.toFixed(0)+'% Negative' );
                }
            });
		
		/*code for Aggregate  chart (Week Report)*/
		
		
  		$('table.line').visualize({type: 'line',width:700});
		/*tree structure graphs show/hide script*/
		
		
		$("#div_social, #div_print, #div_facebook,#div_twitter,#div_linkidin,#div_ft,#div_guardian, #div_nytymes,#div_bingo").hide();
		$( "#div_aggregate" ).click(function() {
			
			$("#div_social, #div_print").toggle();
			$("#default_div").toggleClass("defaultTree");
			
		});
		$( "#div_social" ).click(function() {
			
			$("#div_facebook,#div_twitter,#div_linkidin").toggle();
			
		});
		$( "#div_print" ).click(function() {
			
			$("#div_ft,#div_guardian, #div_nytymes,#div_bingo").toggle();
			
		});
		
		
		/*Records Accordian Display*/
		$(".panelFB,.panelTWT,.panelGUA,.panelFT,.panelNYT,.panelBingo").hide();
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
		$( ".accordionBingo" ).click(function() {
			
			$(".panelBingo").toggle();
			
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
  <input type="hidden" name="search_brand[]"  value="Linkidin_<?php echo $datas['brands']['Linkidin']; ?>">
    <input type="hidden" name="search_brand[]"  value="Bingo_<?php echo $datas['brands']['Bingo']; ?>">

</form>
<?php if($datas['statistics']!=''){ ?>
<h2 style="color: #36C; font-weight:bold;">Week statistics Graph for "<?php echo $search_val;  ?>"</h2>
<div class="wrapper" style="margin:20px;">
  <table id="source1" class="line" style="display:none" >
    <caption>
    Week statistics (%)
    </caption>
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
	   $val=@explode(',',$newStats[$mainColumn][0]);
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
	   $val=@explode(',',$newStats[$mainColumn][1]);
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
        <th scope="row">Guardian</th>
        <?php foreach ($dateColumns as $mainColumn):  ?>
        <td><?php
	   $val=@explode(',',$newStats[$mainColumn][2]);
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
	   $val=@explode(',',$newStats[$mainColumn][3]);
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
	   $val=@explode(',',$newStats[$mainColumn][4]);
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
             <?php if ($linkidin_pt>0){ ?>
      <tr>
        <th scope="row">Linkidin</th>
        <?php foreach ($dateColumns as $mainColumn):  ?>
        <td><?php
	   $val=@explode(',',$newStats[$mainColumn][5]);
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
      
      
       <?php if ($bingo_pt>0){ ?>
      <tr>
        <th scope="row">Bingo</th>
        <?php foreach ($dateColumns as $mainColumn):  ?>
        <td><?php
	   $val=@explode(',',$newStats[$mainColumn][6]);
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
      <caption>
      Aggregate Chart (%)
      </caption>
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
	   $val=@explode(',',$newStats[$mainColumn][0]);
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
	   $val=@explode(',',$newStats[$mainColumn][1]);
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
          <th>Guardian</th>
          <?php foreach ($dateColumns as $mainColumn):  ?>
          <td><?php
	   $val=@explode(',',$newStats[$mainColumn][2]);
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
	   $val=@explode(',',$newStats[$mainColumn][3]);
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
	   $val=@explode(',',$newStats[$mainColumn][4]);
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
        
        
      <?php if ($linkidin_pt>0){ ?>
        <tr>
          <th>Linkidin</th>
          <?php foreach ($dateColumns as $mainColumn):  ?>
          <td><?php
	   $val=@explode(',',$newStats[$mainColumn][5]);
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
               <?php if ($bingo_pt>0){ ?>
      <tr>
        <th scope="row">Bingo</th>
        <?php foreach ($dateColumns as $mainColumn):  ?>
        <td><?php
	   $val=@explode(',',$newStats[$mainColumn][6]);
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
<h2>Statistics Hierarchy </h2>
<div class="row"  align="center">
  <p style=" margin:20px; ">Click on the below circle graph to view sub level graphs</p>
  <div class="tree defaultTree" align="center"  id="default_div">
    <ul>
      <li> <a id='div_aggregate'>
        <div id="demo-aggregate" class="pie-title-center" data-percent="<?php echo $aggregareCount;  ?>"> <span class="pie-value"></span>
          <div>Aggregate</div>
        </div>
        </a>
        <ul>
          <li  id='div_social'> <a>
            <div id="demo-social" class="pie-title-center" data-percent="<?php echo $socialCount;  ?>"> <span class="pie-value"></span>
              <div>Social</div>
            </div>
            </a>
            <ul>
              <li id='div_facebook'> <a >
                <?php if ($fb_pt>0){ ?>
                <div id="demo-facebook" class="pie-title-center" data-percent="<?php echo $fb_pt;  ?>"> <span class="pie-value"></span>
                  <div>Facebook</div>
                </div>
                <?php }  ?>
                </a> </li>
              <li id='div_twitter'> <a >
                <?php if ($twitter_pt>0){ ?>
                <div id="demo-twitter"  class="pie-title-center" data-percent="<?php echo $twitter_pt;  ?>"> <span class="pie-value"></span>
                  <div>Twitter</div>
                </div>
                <?php }  ?>
                </a> </li>
                
                 <li id='div_linkidin'> <a >
                <?php if ($linkidin_pt>0){ ?>
                <div id="demo-linkidin"  class="pie-title-center" data-percent="<?php echo $linkidin_pt;  ?>"> <span class="pie-value"></span>
                  <div>Linkedin</div>
                </div>
                <?php }  ?>
                </a> </li>
            </ul>
          </li>
          <li id='div_print'> <a >
            <div id="demo-print" class="pie-title-center" data-percent="<?php echo $printmediaCount;  ?>"> <span class="pie-value"></span>
              <div>Print Media</div>
            </div>
            </a>
            <ul>
              <li  id='div_ft'><a>
                <?php if ($ft_pt>0){ ?>
                <div id="demo-ft"   class="pie-title-center" data-percent="<?php echo $ft_pt;  ?>"> <span class="pie-value"></span>
                  <div>FT</div>
                </div>
                <?php }  ?>
                </a></li>
              <li id='div_guardian' ><a >
                <?php if ($guardian_pt>0){ ?>
                <div id="demo-guardian" class="pie-title-center" data-percent="<?php echo $guardian_pt;  ?>"> <span class="pie-value"></span>
                  <div>Guardian</div>
                </div>
                <?php }  ?>
                </a></li>
              <li id='div_nytymes'><a >
                <?php if ($nytimes_pt>0){ ?>
                <div id="demo-nytymes"  class="pie-title-center" data-percent="<?php echo $nytimes_pt;  ?>"> <span class="pie-value"></span>
                  <div>NYTymes</div>
                </div>
                <?php }  ?>
                </a></li>
                
                 <li id='div_bingo'><a >
                <?php if ($bingo_pt>0){ ?>
                <div id="demo-bingo"  class="pie-title-center" data-percent="<?php echo $bingo_pt;  ?>"> <span class="pie-value"></span>
                  <div>Bingo</div>
                </div>
                <?php }  ?>
                </a></li>
                
            </ul>
          </li>
        </ul>
      </li>
    </ul>
  </div>
</div>
<div style="height:30px">&nbsp;</div>

<h2>Search Results Data of "<?php echo $search_val; ?>"</h2>
<div class="demo">
  <div class="container">
    <div class="row">
      <div class="col-lg-16">
        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
          <?php if($fb_pt>0){ ?>
          <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingOne">
              <h4 class="panel-title"> <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne"> Facebook results<span style="float:right; margin-right:20px">Score:<?php echo $fb_pt; ?>%</span> </a> </h4>
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
          <div>&nbsp;</div>
          <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingTwo">
              <h4 class="panel-title"> <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo"> Twitter Results<span style="float:right; margin-right:20px">Score:<?php echo $twitter_pt; ?>%</span> </a> </h4>
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
          <div>&nbsp;</div>
          <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingThree">
              <h4 class="panel-title"> <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree"> Guardian Results<span style="float:right; margin-right:20px">Score:<?php echo $guardian_pt; ?>%</span> </a> </h4>
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
          <div>&nbsp;</div>
          <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingFour">
              <h4 class="panel-title"> <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour"> Financial Time Results<span style="float:right; margin-right:20px">Score:<?php echo $ft_pt; ?>%</span> </a> </h4>
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
          <div>&nbsp;</div>
          <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingFive">
              <h4 class="panel-title"> <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFive" aria-expanded="false" aria-controls="collapseFive"> NYTimes Results<span style="float:right; margin-right:20px">Score:<?php echo $nytimes_pt; ?>%</span> </a> </h4>
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
          
          
         <?php if($bingo_pt>0){ ?>
          <div>&nbsp;</div>
          <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingSix">
              <h4 class="panel-title"> <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseSix" aria-expanded="false" aria-controls="collapseSix"> Bing News<span style="float:right; margin-right:20px">Score:<?php echo $bingo_pt; ?>%</span> </a> </h4>go
            </div>
            <div id="collapseSix" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingSix">
              <div class="panel-body">
                <?php
								
		                        for($i = 0 ; $i < $Bingo_count ; $i++){
									?>
                <p class="postTitle"><?php echo $Bingo_posts[$i]; ?></p>
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