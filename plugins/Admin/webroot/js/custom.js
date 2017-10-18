var _errorMessage = function(e)
{
	if(e.responseText)
		showFlashMsg($.parseJSON(e.responseText).message, 'error');
	else
		showFlashMsg('Some error occured while requesting to server. Please refresh and try agian.', 'error');
};
var _successMessage = function(resp)
{
	showFlashMsg(resp.message);
};

var _get = function(url)
{
	var data;
	$.ajax({
			url: ajax_url + url,
			async: false,
			error: _errorMessage,
			success: function(resp)
			{
				data = resp;
			}
		});
	return data;
}

var _post = function(url, data)
{
	var data;
	$.ajax({
			url: ajax_url + url,
			type: 'post',
			data: data,
			async: false,
			error: _errorMessage,
			success: function(resp)
			{
				data = resp;
			}
		});
	return data;
}

$(document).ready(function()
{
	//~ Users status and level change
	$('#Users select').on('change', function(){
		data = {};
		data[$(this).attr('name')] = $(this).val();
		resp = _post('administrator/Users/change-field/'+$(this).data('id')+'.json', data);
		_successMessage(resp);
		
	})
	$('#Coolers input[type=checkbox]').on('change', function(){
		data = {};
		data[$(this).attr('name')] = $(this).val();
		resp = _post('administrator/Coolers/change-field/'+$(this).data('id')+'.json', data);
		_successMessage(resp);
		
	})
	$('#Users input[type=checkbox]').on('change', function(){
		data = {};
		data[$(this).attr('name')] = $(this).is(':checked') ? 1 : 0;
		resp = _post('administrator/Users/change-field/'+$(this).data('id')+'.json', data);
		_successMessage(resp);
		
	})
})

function formatDateTime(date) {
	var arr = date.split(/[- :T]/), // from your example var date = "2012-11-14T06:57:36+0000";
    date = new Date(arr[0], arr[1]-1, arr[2], arr[3], arr[4], 00);
	var hours = date.getHours();
	var minutes = date.getMinutes();
	var ampm = hours >= 12 ? 'PM' : 'AM';
	hours = hours % 12;
	hours = hours ? hours : 12; // the hour '0' should be '12'
	minutes = minutes < 10 ? '0'+minutes : minutes;
	var strTime = (date.getMonth()*1+1) + '/' + date.getDate() + '/' + (date.getYear()-100) + ' ' + hours + ':' + minutes + ' ' + ampm;
	return strTime;
}

$('.form-validate').validate();
$('#tech-form').validate();
$('#add-form').validate();

$('#drpicker').timepicki({
	reset: true,
	min_hour_value:0,
	max_hour_value:23,
	show_meridian:false,
	start_time: ["00", "00"]
});

//~ $('#fromTmpck').timepicki({
	//~ reset: true,
	//~ min_hour_value:0,
	//~ max_hour_value:23,
	//~ show_meridian:false
//~ });
//~ 
//~ $('#toTmpck').timepicki({
	//~ reset: true,
	//~ min_hour_value:0,
	//~ max_hour_value:23,
	//~ show_meridian:false
//~ });
//~ 
//~ $('#st-form-validate').validate();
//~ 
//~ $( "#st-form-validate" ).submit(function() {
	//~ coolerId = $('#clId').val();
	//~ var dt = new Date();
	//~ var currentTime = ((dt.getHours() * 60) * 1) + ((dt.getMinutes()) * 1);
	//~ 
	//~ from = [];
	//~ to = [];
	//~ fromTime = $('#fromTmpck').val();
	//~ toTime = $('#toTmpck').val();
	//~ if(fromTime || toTime){
		//~ if(fromTime){
			//~ from = fromTime.split(':');
			//~ from = ((from[0] * 60) * 1 + (from[1]) * 1);
			//~ if(from < currentTime || from == currentTime){
				//~ $('#fromTmpck').after('<label id="fromTmpck-error" class="error" for="fromTmpck">Time should be greater than current time.</label>');
				//~ $('#st-form-validate').validate({
					//~ debug: false
				//~ });
				//~ return false;
			//~ }
		//~ }
		//~ 
		//~ if(toTime){
			//~ to = toTime.split(':');
			//~ to = ((to[0] * 60) * 1 + (to[1]) * 1);
			//~ 
			//~ if(to < currentTime || to == currentTime){
				//~ $('#toTmpck').after('<label id="toTmpck-error" class="error" for="toTmpck">Time should be greater than current time.</label>');
				//~ $('#st-form-validate').validate({
					//~ debug: false
				//~ });
				//~ return false;
			//~ }
		//~ }
		//~ if(to < from || to == from){
			//~ $('#toTmpck').after('<label id="toTmpck-error" class="error" for="toTmpck">Time should be greater than from time.</label>');
			//~ $('#st-form-validate').validate({
				//~ debug: false
			//~ });
			//~ return false;
		//~ }
		//~ $.ajax({
			//~ type:'POST',
			//~ data:{'toTime':toTime , 'fromTime':fromTime , 'coolerId':coolerId},
			//~ url:ajax_url+'administrator/coolers/timeCheck',
			//~ success:function(resp){
				//~ 
			//~ }	
		//~ });
	//~ }
	//~ $('#st-form-validate').validate({debug: false});
	//~ return false;
//~ });
