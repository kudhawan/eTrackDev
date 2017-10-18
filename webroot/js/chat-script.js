
        var pageTitle = $('title').html();
		var settings = {
            'pusherKey': null,   // required : open an account on http://pusher.com/ to get one
            'authPath' : null , // required : path to authentication scripts more info at http://pusher.com/docs/authenticating_users
            'friendsList' : ajax_url+'chats/user-list.json', // required : path to friends list json 
			'chatMessage' : ajax_url+'chats/message-list.json', // required : path to message list json 
			'chatNewMessage' : ajax_url+'chats/new-message.json', // required : path to new message list json 
			'onoffStatus' : ajax_url+'users/active-user.json', // required : path to online/offline list json 
			'interval' : 1000, // required : path to friends list json
            'serverPath' : ajax_url+'chats/send-msg.json', // required : path to server
        };
		//var newMsgTime = setInterval(getnewMessage, settings.interval);
		var userStatusList = newMsgTime = null;
		$(function() {
			setInterval(function(){
				userStatusList = $.getJSON(settings.onoffStatus, function(data) {
					//console.log(data);
				});
			}, 5000);
		});
$(document).ready(function(){
		// int var 
		
		memberUpdate();
		
		
		
        /*presenceChannel.bind('send-event', function(data) { 
            if(presenceChannel.members.me.id == data.to && data.from != presenceChannel.members.me.id){
                var obj = $('a[href=#'+data.from+']');
                createChatBox(obj);
                var name = $('#id_'+data.from).find('h2').find('.userName').html();
                $('#id_'+data.from+' .msgTxt').append('<p class="friend"><b>'+name+'</b><br/>'+ data.message+'</p>');       
                $('#id_'+data.from).addClass('recive').removeClass('writing');
                $('#id_'+data.from+' .logMsg').scrollTop($('#id_'+data.from+' .logMsg')[0].scrollHeight);      
                if ($('title').text().search('New message - ')==-1)
                    $('title').prepend('New message - ');
            }
            if (presenceChannel.members.me.id == data.from){
                $('#id_'+data.to+' .msgTxt').append('<p class="you"><b>You</b><br/>'+ data.message+'</p>');
                $('#id_'+data.to+' .logMsg').scrollTop($('#id_'+data.to+' .logMsg')[0].scrollHeight);
            }    
        });*/
		
		
		$('#pusherChat,.pusherChatBox').on('click','#expand,.expand', VisibleToggle);
		
		$('body').on('click', '#membersContent .visibletoggle, .pusherChatBox .visibletoggle', VisibleToggle);
		
        // close chat box
        $('#pusherChat').on('click', '.closeBox',function(){
            $(this).parents('.pusherChatBox').hide();
            updateBoxPosition();
            return false;
        });
        
        // trigger click on friend & create chat box
        $('#pusherChat #members-list').on('click','a',function(){
            var obj=$(this);
            createChatBox(obj);
            return false;
        });
        
        // some action whene click on chat box
        $('body').on('click','.pusherChatBox',function(){
            var newMessage = false;
            $(this).removeClass('recive');
            $('.pusherChatBox').each(function(){
                if ($(this).hasClass('recive')){
                    newMessage = true;
                    return false; 
                }       
            });  
            if (newMessage == false)
                $('title').text(pageTitle);
        });
		

      
        $('#slideLeft').on('click',function(){
            $('.chatBoxslide .pusherChatBox:visible:first').addClass('overFlowHide');
            $('.chatBoxslide .pusherChatBox.overFlow').removeClass('overFlow');
            updateBoxPosition();
        });

        $('#slideRight').on('click',function(){
            $('.chatBoxslide .pusherChatBox.overFlowHide:last').removeClass('overFlowHide');
            updateBoxPosition();
        });
     
        /*-----------------------------------------------------------*
         * send message & typing event to server
         *-----------------------------------------------------------*/ 
        $("body").on('keyup','.pusherChatBox .chatMsg',function(event) {    
            var from = $(this).parents('form');
			clearInterval(newMsgTime);
			if ( event.which == 13 && $(this).val().length == 0)
				return false;
				
            if ( event.which == 13 && $(this).val().length > 1) {
				var msg = $(this).val();
                $(this).next().next().next().val('false');
                var data = $.post(settings.serverPath, from.serialize())
				.complete(function() {
					clearInterval(newMsgTime);
					$('#id_'+from.find('.to').val()+' .msgTxt').append('<p class="you"><b>You</b><br/><span style="margin-left:5px;">'+ msg +'</span></p>');
					$('#id_'+from.find('.to').val()+' .logMsg').scrollTop($('#id_'+from.find('.to').val()+' .logMsg')[0].scrollHeight);
					newMsgTime = setInterval(getnewMessage, settings.interval);
				});
                event.preventDefault();
                $(this).val('');
                $(this).focus();         
            //}else if (!$(this).val() || ($(this).next().next().next().val()=='null' && $(this).val())){  
			}else if ((event.which != 13 || event.which != 9 || event.which != 8 || event.which != 16) && $(this).val()){ 
                $(this).next().next().next().val('true');
                var data = $.post(settings.serverPath, from.serialize())
				.complete(function() {
					clearInterval(newMsgTime);
					newMsgTime = setInterval(getnewMessage, settings.interval);
				});        
            }else if ($(this).val() == ''){
                $(this).next().next().next().val('false');
                var data = $.post(settings.serverPath, from.serialize())
				.complete(function() {
					clearInterval(newMsgTime);
					newMsgTime = setInterval(getnewMessage, settings.interval);
				});        
            }
        });     
        
        
        /*-----------------------------------------------------------*
         * some css tricks
         *-----------------------------------------------------------*/ 
        $('#pusherChat .scroll').css({
            'max-height':$(window).height()-50
        })               

        $('#pusherChat .chatBoxWrap').css({
            'width':$(window).width() -  $('#membersContent').width()-30 
        })           

        $(window).resize(function(){
            $('#pusherChat .scroll').css({
                'max-height':$(window).height()-50
            });
    
            $('#pusherChat .chatBoxWrap').css({
                'width':$(window).width() -  $('#membersContent').width() -30
            }) 
            updateBoxPosition();
        });
        
});

		/*
		function newMessageUpdate(f_id = '', s_id = ''){
			$.post(ajax_url+'chats/mark-as-read.json?f_id='+f_id+'&s_id='+s_id, {'f_id':f_id,'s_id':s_id}, function(data){
			//console.log(data);
			});
		}*/
		
        /*-----------------------------------------------------------*
         * Bind the 'send-event' & update the chat box message log
         *-----------------------------------------------------------*/
		function updateChat(){
			 var chatData = $.getJSON(settings.chatNewMessage, function(data) {
				$.each(data.userlist, function(index,value) {
                    console.log(value);
                });   
            });
		}
		
		function getnewMessage(obj){
			var receiverid,name,indexLength = 0,resume = false;
			clearInterval(newMsgTime);
			newMsgTime = null;
			$.getJSON(settings.chatNewMessage+'?userID='+currentUserId, function(data) {
				$.each(data.messagelist, function(mainIndex,mainValue) {
					indexLength++;
					//console.log(mainValue.chats);
					if (mainValue.chats.first_user == currentUserId){
						receiverid = mainValue.chats.second_user;
					} else {
						receiverid = mainValue.chats.first_user;
					}
					checkUser(receiverid);
					if(mainValue.chats.state != '' && mainValue.chats.state != null){
						$.each($.parseJSON(mainValue.chats.state), function(stateIndex,stateValue) {
															   //console.log(stateValue);
							if(stateValue.typing == 'true'){ 
								$('#id_'+stateIndex.replace('user_', '')).addClass('writing');
							} else {
								$('#id_'+stateIndex.replace('user_', '')).removeClass('writing');
							}
						});
					}
					$.each(mainValue.messages, function(index,value) {
						name = $('#id_'+receiverid+' .userName').html();
						if (currentUserId == value.sender_id){
							$('#id_'+receiverid+' .msgTxt').append('<p class="you"><b>You</b><br/><span style="margin-left:5px;">'+ value.message+'</span></p>');
						} else {
							if($('id_'+receiverid).length == 0)
								$('#members-list').find('a[href="#'+receiverid+'"]').click();
							else
								newMessageUpdate(currentUserId,receiverid);
								
							$('#id_'+receiverid+' .msgTxt').append('<p class="friend"><b>'+name+'</b><br/><span style="margin-left:5px;">'+ value.message+'</span></p>'); 
							$('#id_'+receiverid).addClass('recive').removeClass('writing');
							if ($('title').text().search('New message - ')==-1)
								$('title').prepend('New message - ');
						}
						if(receiverid!='' && $('#id_'+receiverid+' .logMsg').length > 0)
							$('#id_'+receiverid+' .logMsg').scrollTop($('#id_'+receiverid+' .logMsg')[0].scrollHeight);
					});
				});
			})
			.complete(function() {
				clearInterval(newMsgTime);
				newMsgTime = setInterval(getnewMessage, settings.interval);
			});
		}

		function VisibleToggle(){
            var obj = $(this);
            obj.parent().find('.scroll,.slider').slideToggle('1', function() {
                if ($(this).is(':visible')){
                    obj.parent().find('.close').show();
                    obj.parent().find('.open').hide();
                }else {
                    obj.parent().find('.close').hide();
                    obj.parent().find('.open').show();
                }
            });    
            return false
        }
		
		
		function checkUser(userID){
			var visibleCount = 0;
			if(userStatusList != null && userStatusList.responseJSON != null){
				$.each(userStatusList.responseJSON.online_offline_status, function(index,value) {
												//console.log(userID+' '+value.id+' '+value.online_offline_status);
					if(value.online_offline_status == 1) {
						visibleCount++;
						$('#members-list').find('a[href="#'+value.id+'"]').removeClass('off').addClass('on');
						$('#id_'+value.id).removeClass('off').removeClass('on').addClass('on');
						return value.online_offline_status;
					} else {
						$('#members-list').find('a[href="#'+value.id+'"]').removeClass('on').addClass('off');
						$('#id_'+value.id).removeClass('off').removeClass('on').addClass('off');
						return 0;
					}
				});
				$('#membersContent').find('#count').html(visibleCount);
			}
		}
		
		/*-----------------------------------------------------------*
         * memberUpdate() place & update friends list on client page 
         *-----------------------------------------------------------*/  
        function memberUpdate(){    
            var userData = $.getJSON(settings.friendsList, function(data) {
							 
                var offlineUser = onlineUser ='' ;
                var chatBoxOnline;
                $.each(data.userlist, function(index,value) {
                    if (data.currentUser!=value.id) {          
                        //user = checkUser(value.id);
						user = '';
						if(value.picture != '')
							picture_url = ajax_url+value.picture;
						else
							picture_url = ajax_url+'images/user-icon.png';
                        if (user){
                            onlineUser +='<a href="#'+value.id+'" data-user="'+value.id+'" class="on"><img src="'+picture_url+'"/> <span>'+value.name+'</span></a>';
                            chatBoxOnline ='on';
                        }else {
                            offlineUser +='<a href="#'+value.id+'" data-user="'+value.id+'" class="off"><img src="'+picture_url+'"/> <span>'+value.name+'</span></a>'; 
                            chatBoxOnline ='off';
                        }              
                    }
                    $('#id_'+value.id).removeClass('off').removeClass('on').addClass(chatBoxOnline);
                });
                $('#pusherChat #members-list').append(onlineUser+offlineUser);    
            }).complete(function(){
				newMsgTime = setInterval(getnewMessage, settings.interval);
			});
    
            $('#pusherChat #members-list').html('');   
            if(userData.length>0){
                $("#count").html(userData.length - 1);
            }
        }
        
        /*-----------------------------------------------------------*
         * create a chat box from the html template 
         *-----------------------------------------------------------*/        
        function createChatBox(obj){
			clearInterval(newMsgTime);
			newMsgTime = null;
            var name = obj.find('span').html();
            var img = obj.find('img').attr('src');  
            var id = obj.attr('href').replace('#', 'id_');                     
            var off = clone ='';
            if (obj.hasClass('off')) off='off';
    
            if (!$('#'+id).html()){                 
                $('#templateChatBox .pusherChatBox h2 .userName').html(name);               
                $('#templateChatBox .pusherChatBox h2 img').attr('src',img);
                $('.chatBoxslide').prepend($('#templateChatBox .pusherChatBox').clone().attr('id',id));            
            }
            else if (!$('#'+id).is(':visible') ){
                clone = $('#'+id).clone();
                $('#'+id).remove();
                if(!$('.chatBoxslide .pusherChatBox:visible:first').html())
                    $('.chatBoxslide').prepend(clone.show());     
                else
                    $(clone.show()).insertBefore('.chatBoxslide .pusherChatBox:visible:first');
            }
            if (settings.profilePage){
                $.getJSON(settings.friendsList, function(data) { 
                    var profileUrl = data[obj.attr('href').replace('#', '')][2];
                    $('#'+id+' h2 a').attr('href',profileUrl);
                });
            } 
            if (settings.chatMessage != ''){
                $.getJSON(settings.chatMessage+'?userID='+obj.data('user'), function(data) {
					$('#id_'+obj.data('user')+' .msgTxt').html('');
					$.each(data.messagelist, function(index,value) {
						if (currentUserId == value.sender_id){
							$('#id_'+obj.data('user')+' .msgTxt').append('<p class="you"><b>You</b><br/><span style="margin-left:5px;">'+ value.message+'</span></p>');
						} else {
							$('#id_'+obj.data('user')+' .msgTxt').append('<p class="friend"><b>'+name+'</b><br/><span style="margin-left:5px;">'+ value.message+'</span></p>');  
							if ($('title').text().search('New message - ')==-1)
								$('title').prepend('New message - ');
						}
					});
					$('#id_'+obj.data('user')+' .logMsg').scrollTop($('#id_'+obj.data('user')+' .logMsg')[0].scrollHeight);
                })
				.complete(function() {
					newMsgTime = setInterval(getnewMessage, settings.interval);
				});
            }
            $('#'+id+' textarea').focus();
            $('#'+id+' .from').val(currentUserId);
            $('#'+id+' .to').val(obj.data('user'));
            $('#'+id).addClass(off);
            updateBoxPosition();
			newMessageUpdate(currentUserId,obj.data('user'));
            return false
        }

        /*-----------------------------------------------------------*
         * reorganize the chat box position on adding or removing
         *-----------------------------------------------------------*/  
        function updateBoxPosition(){
            var right=0;
            var slideLeft = false;
            $('.chatBoxslide .pusherChatBox:visible').each(function(){
                $(this).css({
                    'right':right
                });
        
                right += $(this).width()+20;
        
                $('.chatBoxslide').css({
                    'width':right
                });
        
                if ($(this).offset().left- 20<0){
                    $(this).addClass('overFlow');
                    slideLeft = true;
                }
                else
                    $(this).removeClass('overFlow');
    
    
            });          
            if(slideLeft) $('#slideLeft').show();
            else $('#slideLeft').hide();
    
            if($('.overFlowHide').html()) $('#slideRight').show();
            else $('#slideRight').hide();
			
        }