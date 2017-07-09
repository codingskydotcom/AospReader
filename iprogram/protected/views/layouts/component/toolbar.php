<?php
	 
?>
<form id="serversFrom" method="post">
<input id="operator" name="operator" type="hidden"></input>
<div class="toolbarbg" style="width: 100%">
	<div style="float:left;margin-right:5px;">
		<div style="padding-top:7px;padding-left:5px;">
			<?php if($buttons != null){ ?>
				<?php foreach($buttons as $buttonitem){ ?>
				<a class="link_button" href="<?php echo $buttonitem['url']; ?>"><?php echo $buttonitem['text']; ?></a>
				<?php } ?>
			<?php } ?>
		</div>
	</div>
	<div style="float:right;margin-right:5px;">
	</div>
	<div style="clear:both;"></div>
</div>
</form>