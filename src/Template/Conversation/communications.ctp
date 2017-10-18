<?php 
//echo 111;

foreach($getConversation as $key =>$val):
										if($val->designation_id > 0):
											$maindesignation = @$val->designation->name ? ' <small>'.$val->designation->name.'</small>':''; 
											$subdesignation = @$val->position->title ? ' <small>('.$val->position->title .')</small>':''; 
										else:
											$maindesignation = ' <small>Project Creator</small>'; 
											$subdesignation = ''; 
										endif;
									?>