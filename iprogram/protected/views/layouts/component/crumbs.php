<?php 

//echo "=====111====";
//print_r($crumb);
 
$showCrumb = 1;
if(key_exists("print", $_GET)){
	if($_GET['print'] == "1"){
		$showCrumb = 0;
	}
}

?>

<?php if($crumb != null && count($crumb) > 1 && $showCrumb){ ?>
<div class="top_first_banner" style="margin-top:10px;margin-bottom:0px;padding:5px 0px;background:#fff;">
	<span>当前位置：</span>
	<?php $firstItem = true; ?>
	<?php foreach($crumb as $crumbitem){ ?>
		<?php if($firstItem == true){ ?>
			<?php $firstItem = false; ?>
		<?php } else { ?>
			<span>>&nbsp;&nbsp;</span>
		<?php } ?>
		<?php if(strlen($crumbitem->url) > 0 ){ ?>
			<a class="crumb_link" href="<?php echo $crumbitem->url; ?>"><?php echo $crumbitem->name; ?>&nbsp;&nbsp;</a>
		<?php }else{ ?>
			<span><?php echo $crumbitem->name; ?>&nbsp;&nbsp;</span>
		<?php } ?>
	<?php } ?>
</div>
<div class="top_first_banner" style="margin-top:0px;height:1px;background:#e5e5e5"></div>
<?php } ?>
