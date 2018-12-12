<footer class="main-footer">
	<div class="pull-right hidden-xs">
	<b>Version</b> <?php echo $this->config->item("product_version");?>
	</div>
	<strong>
		Copyright <?php echo $this->config->item("copyright_to_prefix");?> 
		<a target="_BLANK" href="<?php echo $this->config->item("copyright_to_href");?>" title="<?php echo $this->config->item("copyright_to_title");?>">
			<?php echo $this->config->item("copyright_to");?> 
		</a>
	<?php echo $this->config->item("copyright_to_sufix");?>
</footer>