	
	<?php 
		echo $this->Html->css(['chat-style.css']);
	 	echo $this->Html->script(['chat-script.js']);
	?>
	<!-- Chat Modal -->
	<div id="pusherChat">
		<div id="membersContent">
			<span id="expand">
				<span class="close">&#x25BC;</span>
				<span class="open">&#x25B2;</span>
			</span>
			<h2 class="visibletoggle"><span id="count">0</span> online</h2>
			<div class="scroll" style="display:none;">
				<div id="members-list">
				</div>
			</div>
		</div>
		<!-- chat box template -->
		
		<div id="templateChatBox">
			<div class="pusherChatBox">
				<span class="state">
					<span class="pencil">
						<img src="<?php echo HTTP_ROOT.'images/chat/pencil.gif'; ?>" />
					</span>
					<span class="quote">
						<img src="<?php echo HTTP_ROOT.'images/chat/quote.gif'; ?>" />
					</span>
				</span>
				<span class="expand">
					<span class="close">&#x25BC;</span>
					<span class="open">&#x25B2;</span>
				</span>
				<span class="closeBox">x</span>
				<h2 class="visibletoggle">
					<a href="#" title="go to profile"><img src="" class="imgFriend" /></a> 
					<span class="userName"></span>
				</h2>
				<div class="slider">
					<div class="logMsg">
						<div class="msgTxt">
						</div>
					</div>
					<form method="post" name="#123">
						<textarea  name="msg" class="chatMsg" rows="3" ></textarea>
						<input type="hidden" name="from" class="from" />
						<input type="hidden" name="to"  class="to"/>
						<input type="hidden" name="typing"  class="typing" value="false"/>
					</form>
				</div>
			</div>
		</div>
		<!-- chat box template end -->
			<div class="chatBoxWrap">
				<div class="chatBoxslide">
				</div>
				<span id="slideLeft"> <img src="<?php echo HTTP_ROOT.'images/chat/quote.gif'; ?>" />&#x25C0;</span> 
				<span id="slideRight">&#x25B6; <img src="<?php echo HTTP_ROOT.'images/chat/quote.gif'; ?>" /></span>
			</div>
		</div>