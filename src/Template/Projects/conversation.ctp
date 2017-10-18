                        <div class="col-lg-12 top-margin">
						<div class="page-heading"><h1> Comments</h1></div>
					</div>
                        
                         <div id="cmnt-section">
                         <p>Project Comments</p>
									<?php foreach($getConversation as $key =>$val):
										if($val->designation_id > 0):
											$maindesignation = @$val->designation->name ? ' <small>'.$val->designation->name.'</small>':''; 
											$subdesignation = @$val->position->title ? ' <small>('.$val->position->title .')</small>':''; 
										else:
											$maindesignation = ' <small>Project Creator</small>'; 
											$subdesignation = ''; 
										endif;
									?>
										<div class="comment-indvidual">
											<label class="user-name"><?php echo $val->user->name.$maindesignation.$subdesignation; ?><span><?php echo date('m/d/y, h:i a' , strtotime($val->created)); ?></span></label>
											<p><?php  echo $val->comment; ?></p>
										</div>
									<?php endforeach;?>
									</div>