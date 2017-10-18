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
		 $Facebook_posts=$datas['brands']['Facebook_posts'];
		 $fb_count=count($Facebook_posts);
?>

<script lang="javascript" type="text/javascript">


    $(document).ready(function () {
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
		/*Records Accordian Display*/
		//$(".panelFB,.panelTWT,.panelGUA,.panelFT,.panelNYT,.panelBingo").hide();
		$( ".accordionFB" ).click(function() {
			
			$(".panelFB").toggle();
			
		});
		
		});
    </script>
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
<form method="post" action="" id="search_results">
  <input type="hidden" name="search_val" id="search_val" value="<?php echo $search_val; ?>">
  <input type="hidden" name="search_brand[]"  value="Facebook_<?php echo $datas['brands']['Facebook']; ?>">
</form>

<div style=" height:30px;">&nbsp;</div>
<h2>Statistics of Facebook post </h2>
<div class="row"  align="center">
   <?php if ($fb_pt>0){ ?>
                <div id="demo-facebook" class="pie-title-center" data-percent="<?php echo $fb_pt;  ?>"> <span class="pie-value"></span>
                  <div>Facebook</div>
                </div>
                <?php }  ?>
</div>
<div style="height:30px">&nbsp;</div>


<h2>Search Results Data </h2>
<div class="demo">
  <div class="container">
    <div class="row">
      <div class="col-lg-14">
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

        </div>
      </div>
    </div>
  </div>
</div>