jQuery(document).ready(function(){
	
	var date = new Date();
  var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());
  var end = new Date(date.getFullYear(), date.getMonth(), date.getDate());

	//$('#start_date,#end_date').datepicker('setDate', today);
	
var _errorMessage = function(e){
	if(e.responseText)
		showFlashMsg($.parseJSON(e.responseText).message, 'error');
	else
		showFlashMsg('Some error occured while requesting to server. Please refresh and try agian.', 'error');
};

var _successMessage = function(resp)
{
	showFlashMsg(resp.message);
};

var _redirect = function(url)
{
	setTimeout(function(){
		location.href = url;
	}, 2000)
}

var _showSpinnerAfterButton = function(arr, $form){
	btton = $form.find('button[type="submit"]');
	btton.after('<i class="fa fa-spinner fa-spin"></i>');
	btton.attr('disabled', 'disabled')
}

var _hideSpinnerAfterButton = function($form){
	button = $form.find('button[type="submit"]');
	button.attr('disabled', false);
	button.siblings('i.fa-spinner').remove();
}
/*Login Form*/
$('#login-form').validate();	
$('#login-form').ajaxForm({
	beforeSubmit: _showSpinnerAfterButton,
	error: _errorMessage,
	success: function(resp){
		_successMessage(resp);
		_redirect(ajax_url + resp.url);
	},
	complete: function(){
		_hideSpinnerAfterButton($('#login-form'));
	}
});
/*Register Form*/
$('#register-form').validate();	
$('#register-form').ajaxForm({
	beforeSubmit: _showSpinnerAfterButton,
	error: _errorMessage,
	success: function(resp){
		_successMessage(resp);
		_redirect(ajax_url + resp.url);
	},
	complete: function(){
		_hideSpinnerAfterButton($('#register-form'));
	}
});
/*Recover Form*/
$('#recover-form').validate();	
$('#recover-form').ajaxForm({
	beforeSubmit: _showSpinnerAfterButton,
	error: _errorMessage,
	success: function(resp){
		_successMessage(resp);
		_redirect(ajax_url + resp.url);
	},
	complete: function(){
		_hideSpinnerAfterButton($('#recover-form'));
	}
});
/*Forget Form*/
$('#forget-form').validate();	
$('#forget-form').ajaxForm({
	beforeSubmit: _showSpinnerAfterButton,
	error: _errorMessage,
	success: function(resp){
		_successMessage(resp);

		$('#forgotPassword').modal('hide');
	},
	complete: function(){
		_hideSpinnerAfterButton($('#forget-form'));
	}
});


/*Change Password Form*/
$('#change-password').validate();	
$('#change-password').ajaxForm({
	beforeSubmit: _showSpinnerAfterButton,
	error: _errorMessage,
	success: function(resp){
		_successMessage(resp);
		$('#changePassword').modal('hide');
		// _redirect(ajax_url + resp.url);
	},
	complete: function(){
		_hideSpinnerAfterButton($('#change-password'));
	}
});

/*InviteMembers*/
$('.projectList').on('change',function(){
		var proList = []; 
		$('.projectList :selected').each(function(i, selected){ 
		  proList[i] = $(selected).val(); 
		});
		if(proList != '')
			$(".projects").val(proList);
		else
			$(".projects").val('');
});

$('.usersList').on('change',function(){
		var usersList = []; 
		$(this).each(function(i, selected){ 
		  usersList[i] = $(selected).val(); 
		});
		if(usersList != '')
			$(this).parent().find('.users').val(usersList);
		else
			$(this).parent().find('.users').val('');
});
	
$('#inviteMem').validate();	
$('#inviteMem').ajaxForm({
	beforeSubmit: _showSpinnerAfterButton,
	error: _errorMessage,

	success: function(resp){
		var respurl='members';
		_successMessage(resp);
		_redirect(ajax_url + respurl);
		//_redirect(ajax_url + resp.url);
	},
	complete: function(){
		_hideSpinnerAfterButton($('#inviteMem'));
	}
});



/*Dashboard*/

$('body').on('change' , '#resource' , function(){
	var uid=$(this).val();
	
	$.ajax({			
			type :'GET',
			url:ajax_url+'Dashboard/view?uid='+uid,
			success:function(resp){
				//alert(resp);
				var responseVal=resp.substr(1);
				var arrayList = responseVal.split(',');
				//var ths = new Array();
				   $('#efforts_table tbody tr td:nth-child(4n) #total_hrs').each(function(i,v){
					for (var j = 0; j < arrayList.length; j++) 
					{
					$(this).html(arrayList[i]+' hrs');
					}
				  }); 
			}
		});
	
	
});
/*New user / Client*/
$('#newUser').validate();	
$('#newUser').ajaxForm({
	beforeSubmit: _showSpinnerAfterButton,
	error: _errorMessage,
	success: function(resp){
		//alert(resp);
		_successMessage(resp);
		_redirect(ajax_url + resp.url);
	},
	complete: function(){
		_hideSpinnerAfterButton($('#newUser'));
	}
	
});


	
/*New project Form*/
$('#newProject').validate();	
$('#newProject').ajaxForm({
	beforeSubmit: _showSpinnerAfterButton,
	error: _errorMessage,
	success: function(resp){
		//alert(ajax_url + resp.url);
		_successMessage(resp);
		_redirect(ajax_url + resp.url);
	},
	complete: function(){
		_hideSpinnerAfterButton($('#newProject'));
	}
});

$('.search-choice-close').on('click',function(){
	console.log('hi');
});

/*Edit project Form*/
$('#editProject').validate();	
$('#editProject').ajaxForm({
	beforeSubmit: _showSpinnerAfterButton,
	error: _errorMessage,
	success: function(resp){
		_successMessage(resp);
		_redirect(ajax_url + resp.url);
	},
	complete: function(){
		_hideSpinnerAfterButton($('#editProject'));
	}
});


/*Edit Budget Form*/
$('#editBudget').validate();	
$('#editBudget').ajaxForm({
	beforeSubmit: _showSpinnerAfterButton,
	error: _errorMessage,
	
	success: function(resp){
		//alert(resp);
		_successMessage(resp);
		_redirect(ajax_url + resp.url);
	},
	complete: function(){
		_hideSpinnerAfterButton($('#editBudget'));
	}
});



/*New tasks Form*/
$('#newTask').validate();	
$('#newTask').ajaxForm({
	beforeSubmit: _showSpinnerAfterButton,
	error: _errorMessage,
	success: function(resp){
		_successMessage(resp);
		_redirect(ajax_url + resp.url);
	},
	complete: function(){
		_hideSpinnerAfterButton($('#newTask'));
	}
});


$('.search-choice-close').on('click',function(){
	console.log('hi');
});

/*Edit tasks Form*/
$('#editTask').validate();	
$('#editTask').ajaxForm({
	beforeSubmit: _showSpinnerAfterButton,
	error: _errorMessage,
	success: function(resp){
		_successMessage(resp);
		_redirect(ajax_url + resp.url);
	},
	complete: function(){
		_hideSpinnerAfterButton($('#editTask'));
	}
});

/*Edit member Form*/
$('#editMember').validate();	
$('#editMember').ajaxForm({
	beforeSubmit: _showSpinnerAfterButton,
	error: _errorMessage,
	success: function(resp){
		_successMessage(resp);
		_redirect(ajax_url + resp.url);
	},
	complete: function(){
		_hideSpinnerAfterButton($('#editMember'));
	}
});

/*DeleteAll Form*/
$('#deleteAll').ajaxForm({
	beforeSubmit: _showSpinnerAfterButton,
	error: _errorMessage,
	success: function(resp){
		_successMessage(resp);
		_redirect(ajax_url + resp.url);
	},
	complete: function(){
		_hideSpinnerAfterButton($('#deleteAll'));
	}
});


/*conversation Form*/
$('#conversationForm').validate();	
$('#conversationForm').ajaxForm({
	beforeSubmit: _showSpinnerAfterButton,
	error: _errorMessage,
	success: function(resp){
		$('#cmnt-section').append(resp.html);
		_successMessage(resp);
		$('#conversationForm').resetForm();
	},
	complete: function(){
		_hideSpinnerAfterButton($('#conversationForm'));
	}
});


$('#commonForm').validate();	
$('#commonForm').ajaxForm({
	beforeSubmit: _showSpinnerAfterButton,
	error: _errorMessage,
	success: function(resp){
		_successMessage(resp);
		_redirect(ajax_url + resp.url);
	},
	complete: function(){
		_hideSpinnerAfterButton($('#commonForm'));
	}
});
$('body').on('click' , '.common-modaldetail' , function(){
//$('.common-modaldetail').on('click' ,function(){
	//alert($(this).attr('data-id'));
	commonmodaldetail($(this).data('id'),$(this).data('url'),$(this).data('modal-title'));
});

$('.projectRelated').on('change' ,function(){
	var url = $(this).data('url'),
		id = $(this).find(':selected').data('id');
	if(id && id != '')
		location.href = url +'/'+id;
	else
		location.href = url;
});

function commonmodaldetail(id,url,title){
	var	id = id;
	var	url = url;
	
	if(id){
		$.ajax({			
			type :'POST',
			data : {id:id},
			url : ajax_url+url,
			beforeSend:function(resp){
				$('#common-modalLabel').html(title);
				$('#common-modal-view').html('<center>Loading...</center>');
			},
			success:function(resp){
				$('#common-modal-view').html(resp);
			},
			error:function(e){
				console.log(id);
				$('#common-modal-view center').html('<center>Something went wrong. Please try again.</center>');
				showFlashMsg('Some error occured while requesting to server. Please refresh and try agian.', 'error');
			}
		});
	}
}

	/*script to choose project*/
	jQuery(".chosen").chosen();
	

$('body').on('change' , '#sb_designation' , function(){
	var designation = $(this).val();
	var	projectId = $('#P-id').val();
	if(designation){
		$.ajax({			
			type :'POST',
			data : {designation:designation , projectId:projectId},
			url : ajax_url+'bugs/team-members',
			success:function(resp){
				$('#tm-mem').html(resp);
			}
		});
	}
});

	

function pr_bg(){
	var $this = $('#pr-bg');
	var projectId = $this.val();
	$this.parent().find('#pr-bugs').remove();
	if(projectId){
		$.ajax({			
			type :'POST',
			data : {projectId:projectId},
			url:ajax_url+'timesheet/project-bugs',
			beforeSend: function(){
			},
			success:function(resp){
				$this.parent().append(resp);
			}
		});
	}
}

$('.screenshotdetails').on('click' ,function(){
	var sid=$(this).data('screenshot-id');
   		$.ajax({			
				type :'POST',
				data : {sid:sid},
				url : ajax_url+'Screenshots/screenshotDetails',
				beforeSend:function(resp){
					$('#screenshot-view').html('<center>Loading...</center>');
				},
				success:function(resp){
					//alert(resp);
					$('#screenshot-view').html(resp);
					
				},
				error:function(e){
					$('#screenshot-view center').html('<center>Something went wrong. Please try again.</center>');
					if(e.responseText)
						showFlashMsg($.parseJSON(e.responseText).message, 'error');
					else
						showFlashMsg('Some error occured while requesting to server. Please refresh and try agian.', 'error');
				}
			});
   	});
	

$('#pr-bg').on('change' , pr_bg);
$(window).on('load', pr_bg);

	$(window).on('load', projectdetail_charts($('#chooseProject').val(),$('#chooseProject').parent().find('input[name=requestfor]').val()));
	$(window).on('load', projectdetail_conversation($('#chooseProject').val(),$('#chooseProject').parent().find('input[name=requestfor]').val()));
	
	projectdetail_charts($(this).val(),$(this).parent().find('input[name=requestfor]').val());
		projectdetail_conversation($(this).val(),$(this).parent().find('input[name=requestfor]').val());
	
	
	$('#chooseProject').on('change' , function(){
   		projectdetail_charts($(this).val(),$(this).parent().find('input[name=requestfor]').val());
		projectdetail_conversation($(this).val(),$(this).parent().find('input[name=requestfor]').val());
		//projectdetail_conversation($(this).val());
   	});
	$('.projectdetails').on('click' ,function(){
   		projectdetail_charts($(this).data('project-id'),$(this).data('requestfor'));
		projectdetail_conversation($(this).data('project-id'),$(this).data('requestfor'));
		//projectdetail_conversation($(this).data('project-id'));
   	});
	function projectdetail_charts(projectId,requestfor){
		var	projectId = projectId;
		var	requestfor = requestfor;
		
		if(projectId){
			$.ajax({			
				type :'POST',
				data : {projectId:projectId, requestfor : requestfor},
				url : ajax_url+'projects/project-details',
				beforeSend:function(resp){
					$('#chart-view').html('<center>Loading...</center>');
				},
				success:function(resp){
					//alert(resp);
					$('#chart-view').html(resp);
					$('#chart-view').find('.amcharts-chart-div').find('a').remove();
				},
				error:function(e){
					$('#chart-view center').html('<center>Something went wrong. Please try again.</center>');
					if(e.responseText)
						showFlashMsg($.parseJSON(e.responseText).message, 'error');
					else
						showFlashMsg('Some error occured while requesting to server. Please refresh and try agian.', 'error');
				}
			});
		}
	}
	
	function projectdetail_conversation(projectId){
		var	projectId = projectId;
		
		if(projectId){
			$.ajax({			
				type :'POST',
				data : {projectId:projectId},
				url : ajax_url+'projects/conversation/',
				beforeSend:function(resp){
					$('#comments_data').html('<center>Loading...</center>');
				},
				success:function(resp){
					//alert(resp);
					$('#comments_data').html(resp);
					
				},
				error:function(e){
					$('#comments_data center').html('<center>Something went wrong. Please try again.</center>');
					
				}
			});
		}
	}
	

$('body').on('change', 'select[name=designation_id], .designationlist' , designation_optionlist);
if($('select[name=designation_id]').length)
	$(window).on('load', designation_optionlist);

function designation_optionlist(){
	$this = $(this);
	if(!$this[0].className)
		$this = $('select[name=designation_id]');
		
	$val = $this.val();
	console.log($val);
	if($val){
		$parent = $(this).parent();
		$selectedposition = $parent.find('.selectedposition').val();
		$positionField = $parent.find('.positionField').val();
		$parent.find('.position').remove();
		$.ajax({
			type :'POST',
			data : {id:$val, selectedposition:$selectedposition, positionField:$positionField},
			url: ajax_url+'employers/positions',
			success: function(resp){
				if(resp){
					$this.parent().append(resp);
					jQuery(".chosen").chosen();
				}
			}
		});
	}
}

	if($('#accEmail span').text().length > 0){
		$('#createAcc').trigger('click');
		$('#createAccount').show();
	}


	var addMore_max_fields      = 10; //maximum input boxes allowed
    var addMoreWrapper         = $(".addMoreWrapper"); //Fields wrapper
    var addMoreButton      = $(".addMoreButton"); //Add button ID
    var removeMoreButton      = $(".removeMoreButton"); //Add button ID
    
    var x = $(".addMoreCount").val(); //initlal text box count
    $(addMoreButton).click(function(e){ //on add input button click
        e.preventDefault();
        if(x < addMore_max_fields){ //max input box allowed
            x++; //text box increment
			$.ajax({
				type :'POST',
				data : {memberCount:x},
				url: ajax_url+'projects/manage-teams',
				success: function(resp){
					if(resp){
						$(".addMoreCount").val(x);
						$(addMoreWrapper).append(resp);
						jQuery(".chosen").chosen();
						designation_optionlist;
					}
				}
			});
        }
    });
	
   $('.timesheetSearch').on('change' , function(){
   		//timesheet_details($(this).val(),$(this).parent().find('input[name=requestfor]').val());
		var pid=$('#timesheetProject').val();
		var uid=$('#timesheetUser').val();
			$.ajax({			
					type :'GET',
					url:ajax_url+'Timesheet/index?pid='+pid+'&uid='+uid,
					success:function(resp){
						var timesheet_table=$(resp).find("#timesheet_table");
						$('#timesheet_div').html(timesheet_table);
					}
				});
		
   	});
	
	$('.act_search').on('change' , function(){
   		//timesheet_details($(this).val(),$(this).parent().find('input[name=requestfor]').val());
		var user_id=$('#user_id').val();
		var action=$('#action').val();
		//alert(user_id);
		//alert(action);
		
		$.ajax({			
				type :'POST',
				data : {user_id:user_id, action : action},
				url : ajax_url+'Activity/view?user_id='+user_id+'&action='+action,
				success:function(resp){
					   // alert(resp);
					    var activity_table=$(resp).find("#activity_table");
						$('#activity_div').html(activity_table);
				},
				error:function(e){
					$('#activity_div center').html('<center>Something went wrong. Please try again.</center>');
					if(e.responseText)
						showFlashMsg($.parseJSON(e.responseText).message, 'error');
					else
						showFlashMsg('Some error occured while requesting to server. Please refresh and try agian.', 'error');
				}
			});
		
   	});
	
	
    
    $(addMoreWrapper).on("click",'.removeMoreButton', function(e){ //user click on remove text
        e.preventDefault(); $(this).parent().parent().remove(); x--;
    });

	/*Brand Management script updated on 25th Juy 2017 by Aruna*/
	$('#saveSearch').on('click' , function(){
			$.ajax({            
						//type :'GET',
						type :'POST',
						data : $('#search_results').serialize(),
						url:ajax_url+'saveSearch',
						success:function(resp){
							//alert(resp);
							$('#searchMsg').html(resp);
							$('#searchMsg').show().delay(5000).fadeOut();
						}
					});
		});	
		
		$('#subscribeButton').on('click' , function(){
			var email=$('#email').val();
			var search_val=$('#search_val').val();
			//alert(email);
			//alert(search_val);
			var re = /[A-Z0-9._%+-]+@[A-Z0-9.-]+.[A-Z]{2,4}/igm;
			if((email=='')||(!re.test(email)))
			{
				$('#email').css('border-color','red');
				$('.emailError').html('Please enter a valid email address');
				return false;
			}
			
			else
			{
				$('.emailError').html('');
				$('#email').css('border-color','');
				$('#email').val('');
				
				 $.ajax({            
						type :'POST',
						data : { search_val : search_val,email : email},
						url:ajax_url+'subscribe',
						success:function(resp){
							//alert(resp);
							$('#searchMsg').html(resp);
							$('#searchMsg').show().delay(5000).fadeOut();
						}
					});
					
			}
			 
		});	
		
		
		
		/*$('#fbpost_link').on('click' , function(){
			$('#search_links_div').hide();
			$('.post_link_class').hide();
			$('.back_class').show();
			$('#keyword_lbl').html('Facebook Post Url');
			$('#search_brand').hide();
			$('#search_brand_fpost').show();
			 $('.svaesearch_div').hide();
			 $('.subscribe_div').hide();
			 $('#searchMsg').hide();
			 $('#brand-chart-view').html('');
			 $('#keyword_error').html('');
			 $('#checkbox_error').html('');
			 $('#keyword').val('');
			
		});	
		
		$('#back').on('click' , function(){
			$('#search_links_div').show();
			$('#keyword_lbl').html('Keyword');
			$('.post_link_class').show();
			$('.back_class').hide();
			$('#search_brand').show();
			$('#search_brand_fpost').hide();
			 $('.svaesearch_div').hide();
			 $('.subscribe_div').hide();
			 $('#searchMsg').hide();
			 $('#brand-chart-view').html('');
			 $('#keyword_error').html('');
			 $('#checkbox_error').html('');
			 $('#keyword').val('');
		});	*/
			


		
	 $('#search_brand').on('click' , function(){
		 $('.svaesearch_div').hide();
		 $('.subscribe_div').hide();
		 $('#searchMsg').hide();
		
		var myCheckboxes = new Array();
			$("input:checked").each(function() {
			   myCheckboxes.push($(this).val());
			});
			
			
		var search_val=$('#keyword').val();
		if ($("input[type='checkbox'][name='search_by[]']:checked").length==0){
			$('#checkbox_error').html('Please select search type');
			return false;
			
		}
		else if(search_val=='')
		{
			$('#keyword').focus();
			$('#keyword_error').html('Please enter search string');
			return false;
		}
		else
		{
			
		$('#wait').show();
		$('#brand-chart-view').html('');
		$('#keyword_error').html('');
		$('#checkbox_error').html('');
		
		
		   $.ajax({            
				  type :'POST',
				  data : {search_by:myCheckboxes , search_val : search_val},
				  url:ajax_url+'brandDetails',
				  success:function(resp){
					  $('#wait').hide();
					  //alert(resp);
					  
					  $('#brand-chart-view').html(resp);
					  $('.svaesearch_div').show();
					  $('.subscribe_div').show();
						
				  }
			  });
		
	 }
	 });
	 
	/*Brand Management script ends here*/
	
	
	/***** Budget details ******/
function budgetDetails(){
	var $this = $('#project_budget');
	var projectId = $this.val();
	if(projectId){
		$('#budget_calculation').show();
		$.ajax({			
			type :'POST',
			data : {projectId:projectId},
			url:ajax_url+'financial/budgetDetails',
			beforeSend: function(){
			},
			success:function(resp){
				$('#budget_calculation').html(resp);
			}
		});
	} else {
		$('#budget_calculation').hide();
	}
}

$('#project_budget').on('change' , budgetDetails);
$(window).on('load', budgetDetails);
/***** End Budget details ******/

/***** Budget details ******/
$('#project_estimation').on('change' , function(){
   		//projectdetail_charts($(this).val(),$(this).data('requestfor'));
   		project_payments($(this).val());
   	});
/***** End Budget details ******/

/***** Send Invoice ******/
	$('body').on('click','.sendInvoice', function(e){
		var paymentId = $(this).data('id');
		if(confirm('Are you sure you want to send this Invoice?')){
			if(paymentId != '' && paymentId != null){
				$.ajax({			
					type :'POST',
					data : {paymentId:paymentId},
					url:ajax_url+'financial/send-invoice.json',
					beforeSend: function(){
					},
					success:function(resp){
						showFlashMsg(resp.message);
					},
					error: _errorMessage
				});
			}
		}
		return false;
	});
/***** End Send Invoice ******/

/***** Pay Invoice ******/
	$('body').on('click','.payInvoice', function(e){
		var paymentId = $(this).data('id');
		if(confirm('Are you sure you want to do this?')){
			if(paymentId != '' && paymentId != null){
				$.ajax({			
					type :'POST',
					data : {paymentId:paymentId},
					url:ajax_url+'financial/pay-invoice.json',
					beforeSend: function(){
					},
					success:function(resp){
						showFlashMsg(resp.message);
						if(resp.url)
						_redirect(ajax_url + resp.url);
					},
					error: _errorMessage
				});
			}
		}
		return false;
	});
/***** End Pay Invoice ******/

/***** Pay Invoice ******/
	$('body').on('click','.cancelInvoice', function(e){
		var paymentId = $(this).data('id');
		if(confirm('Are you sure you want to cancel this invoice?')){
			if(paymentId != '' && paymentId != null){
				$.ajax({			
					type :'POST',
					data : {paymentId:paymentId},
					url:ajax_url+'financial/cancel-invoice.json',
					beforeSend: function(){
					},
					success:function(resp){
						showFlashMsg(resp.message);
						if(resp.url)
						_redirect(ajax_url + resp.url);
					},
					error: _errorMessage
				});
			}
		}
		return false;
	});
/***** End Pay Invoice ******/

	/***** removing payment ******/
	$('body').on('click','.removePayment', function(){
	   removePayment($(this));
	});
 	function removePayment(e){
		var paymentId = e.data('id');
		if(confirm('Are you sure you want to delete this Payment?')){
			if(paymentId){
				$.ajax({			
					type :'POST',
					data : {paymentId:paymentId},
					url:ajax_url+'financial/paymentDelete.json',
					beforeSend: function(){
					},
					success:function(resp){
						projectdetail_charts(e.data('project-id'), 'budgetpie_chart');
						showFlashMsg(resp.message);
						if(resp.status == 'success'){
							e.parents('tr').remove();
						}
					}
				});
			}
		}
		return false;
 	}
	/***** End removing payment ******/
	
	function project_payments(projectId=''){
		if(projectId){
			$.ajax({			
				type :'POST',
				data : {projectId:projectId},
				url : ajax_url+'financial/project-payments',
				beforeSend:function(resp){
					$('#payment-view').html('<center>Loading...</center>');
				},
				success:function(resp){
					//alert(resp);
					$('#payment-view').html(resp);
				},
				complete:function(){
					$('#payment-view').find('.amcharts-chart-div').find('a').remove();
				},
				error:function(e){
					$('#payment-view center').html('<center>Something went wrong. Please try again.</center>');
					if(e.responseText)
						showFlashMsg($.parseJSON(e.responseText).message, 'error');
					else
						showFlashMsg('Some error occured while requesting to server. Please refresh and try agian.', 'error');
				}
			});
		}	
	}

});