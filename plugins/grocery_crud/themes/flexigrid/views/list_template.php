<?php
	$this->set_css($this->default_theme_path.'/flexigrid/css/flexigrid.css');
	$this->set_js_lib($this->default_javascript_path.'/'.grocery_CRUD::JQUERY);

	$this->set_js_lib($this->default_javascript_path.'/jquery_plugins/jquery.noty.js');
	$this->set_js_lib($this->default_javascript_path.'/jquery_plugins/config/jquery.noty.config.js');
	$this->set_js_lib($this->default_javascript_path.'/common/lazyload-min.js');

	if (!$this->is_IE7()) {
		$this->set_js_lib($this->default_javascript_path.'/common/list.js');
	}

	$this->set_js($this->default_theme_path.'/flexigrid/js/cookies.js');
	$this->set_js($this->default_theme_path.'/flexigrid/js/flexigrid.js');
	$this->set_js($this->default_theme_path.'/flexigrid/js/jquery.form.js');
	$this->set_js($this->default_javascript_path.'/jquery_plugins/jquery.numeric.min.js');
	$this->set_js($this->default_theme_path.'/flexigrid/js/jquery.printElement.min.js');

	/** Fancybox */
	$this->set_css($this->default_css_path.'/jquery_plugins/fancybox/jquery.fancybox.css');
	$this->set_js($this->default_javascript_path.'/jquery_plugins/jquery.fancybox-1.3.4.js');
	$this->set_js($this->default_javascript_path.'/jquery_plugins/jquery.easing-1.3.pack.js');

	/** Jquery UI */
	$this->load_js_jqueryui();

?>
<script type='text/javascript'>
	var base_url = '<?php echo base_url();?>';

	var subject = '<?php echo $subject?>';
	var ajax_list_info_url = '<?php echo $ajax_list_info_url; ?>';
	var unique_hash = '<?php echo $unique_hash; ?>';

	var message_alert_delete = "<?php echo $this->l('alert_delete'); ?>";

</script>
<?php include('message.php'); ?>
<div id='list-report-error' class='report-div error'></div>
<div id='list-report-success' class='<?php if($success_message !== null) echo 'alert alert-success ';?> report-list text-center' <?php if($success_message !== null){?>style="display:block"<?php }?>><?php
if($success_message !== null){?>
	<h4 style="margin:0; !important;"><i class="fa fa-check-circle"></i>  <?php echo $success_message; ?></h4>
<?php }
?></div>
<div class="flexigrid" style='width: 100%; padding:15px' data-unique-hash="<?php echo $unique_hash; ?>">
	<div id="hidden-operations" class="hidden-operations"></div>
	<div class="mDiv" style="padding-left:0 !important;padding-top:0 !important;color:#333 !important;font-size:24px !important;font-family:'Source Sans Pro',​sans-serif !important;font-weight:500 !important; ">
		<div class="ftitle">
			<?php echo $subject?>
		</div>		
	</div>
	<div id='main-table-box' class="main-table-box">

	<?php
		// session receiving for custom link starts (al-amin)
		$set_custom_link=$CI->session->userdata('set_custom_link');
		$CI->session->unset_userdata('set_custom_link');
		// session receiving for custom link ends (al-amin)		
	?>

	<?php 
	// if(!$unset_add || !$unset_export || !$unset_print)){ // before editing for custom add field (al-amin)
	if(!$unset_add || !$unset_export || !$unset_print || !empty($set_custom_link)) //after editing for custom add field (al-amin)
	{ ?>
	<div class="tDiv">
		<?php if(!$unset_add){?>
		<div class="tDiv2">
        	<a href='<?php echo $add_url?>' title='<?php echo $this->l('list_add'); ?> - <?php echo $subject?>' class='btn btn-warning'>							
				<i class='fa fa-plus-circle'></i>	<?php echo $this->l('list_add');?>	
            </a>			
		</div>
		<?php }?>
		<div class="tDiv3">
			<?php if(!$unset_export) { ?>
        	<a class="btn btn-primary export-anchor" data-url="<?php echo $export_url; ?>" target="_blank">				
				<i class='fa fa-download'></i> <?php  echo $this->l('list_export');?>				
            </a>			
			<?php } ?>
			<?php if(!$unset_print) { ?>
        	<a class="btn btn-primary print-anchor" data-url="<?php echo $print_url; ?>">				
				<i class='fa fa-print'></i> <?php  echo $this->l('list_print');?>					
            </a>
			<?php }?>
		</div>

 		<?php		
			// adding custom add button starts (al-amin)
			if(!empty($set_custom_link))		
			{ 
				for($i=0;$i<count($set_custom_link);$i++)
				{ ?>
					<div class="tDiv2">
			        	<a href="<?php echo $set_custom_link[$i]['set_custom_link_url'];?>" title="<?php echo $set_custom_link[$i]['set_custom_link_hover'];?>" class='add-anchor add_button'>
						<div class="fbutton">
							<div>
								<span class="<?php echo $set_custom_link[$i]['set_custom_link_type'];?>"><?php echo $set_custom_link[$i]['set_custom_link_label'];?></span>
							</div>
						</div>
			            </a>
						<div class="btnseparator">
						</div>
					</div>
					<?php
				}
			}
			// adding custom add button ends (al-amin)
		?>

		<div class='clear'></div>
	</div>
	<?php } 
	else echo '<div class="tDiv"></div>';
	?>

	<?php echo form_open( $ajax_list_url, 'method="post" id="filtering_form" class="form-inline filtering_form" autocomplete = "off" data-ajax-list-info-url="'.$ajax_list_info_url.'"'); ?>
	<?php if ( !$unset_search ){ ?>
	<div class="sDiv quickSearchBox" id='quickSearchBox' style="display:block;background:#fff;border-bottom:none">
		<div class="sDiv2">
			<div class="form-group">
				<input type="text" style='min-width:150px;max-width:300px;' placeholder="<?php echo $CI->lang->line("keyword"); ?>" class="qsbsearch_fieldox search_text form-control" name="search_text" size="30" id='search_text'>
			</div>
			<div class="form-group">
				<!-- <select name="search_field" id="search_field" class="form-control" style='width:150px'> -->
					<!-- commented by al-amin -->
					<!-- <option value="">All</option>
					<?php foreach($columns as $column){?>
					<option value="<?php echo $column->field_name?>"><?php echo $column->display_as?>&nbsp;&nbsp;</option>
					<?php }?> -->
				<!-- </select> -->

				<!-- rewitten by al-amin (because all search does not work if where or relation used) -->
				<!-- status ad deleted search also removed because they are stored 0/1 in database but displated as active/inactive or yes/no -->
				<select name="search_field" id="search_field" class="form-control" style='min-width:150px;max-width:300px;'>					
					<?php $count_search_field=1; ?>
					<?php foreach($columns as $column)
					{ 
						if($column->field_name=='status'|| $column->field_name=='deleted' )
						continue;
						?>
						<option <?php if($count_search_field==1) echo 'selected="yes"';?> value="<?php echo $column->field_name?>"><?php echo $CI->lang->line("search by"); ?>: <?php echo $column->display_as?>&nbsp;&nbsp;</option>
						<?php $count_search_field++;
					}?>
				</select>

				</select>
			</div>
            <input type="button" value="<?php echo $this->l('list_search');?>" class="crud_search btn btn-info" id='crud_search'>
		</div>
        <!-- <div class='search-div-clear-button'>
        	<input type="button" value="<?php echo $this->l('list_clear_filtering');?>" id='search_clear' class="search_clear btn btn-info" style='font-weight:bold;border-radius:0;padding:6px 10px'>
        </div> -->
	</div>
	<?php } ?>



	<div id='ajax_list' class="ajax_list">
		<?php echo $list_view?>
	</div>
	
	<div class="pDiv" style="padding:0 15px 15px 15px;">
		<br>
		<div style="border-top:1px solid #ccc;">
			<div class="pDiv2">
			</div>
			<div class="pGroup">
				<select name="per_page" id='per_page' class="per_page">
					<?php foreach($paging_options as $option){?>
						<option value="<?php echo $option; ?>" <?php if($option == $default_per_page){?>selected="selected"<?php }?>><?php echo $option; ?>&nbsp;&nbsp;</option>
					<?php }?>
				</select>
				<input type='hidden' name='order_by[0]' id='hidden-sorting' class='hidden-sorting' value='<?php if(!empty($order_by[0])){?><?php echo $order_by[0]?><?php }?>' />
				<input type='hidden' name='order_by[1]' id='hidden-ordering' class='hidden-ordering'  value='<?php if(!empty($order_by[1])){?><?php echo $order_by[1]?><?php }?>'/>
			</div>
			<div class="btnseparator">
			</div>
			<div class="pGroup">
				<div class="pFirst pButton first-button">
					<span></span>
				</div>
				<div class="pPrev pButton prev-button">
					<span></span>
				</div>
			</div>
			<div class="btnseparator">
			</div>
			<div class="pGroup">
				<span class="pcontrol"><?php echo $this->l('list_page'); ?> <input name='page' type="text" value="1" size="4" id='crud_page' class="crud_page">
				<?php echo $this->l('list_paging_of'); ?>
				<span id='last-page-number' class="last-page-number"><?php echo ceil($total_results / $default_per_page)?></span></span>
			</div>
			<div class="btnseparator">
			</div>
			<div class="pGroup">
				<div class="pNext pButton next-button" >
					<span></span>
				</div>
				<div class="pLast pButton last-button">
					<span></span>
				</div>
			</div>
			<div class="btnseparator">
			</div>
			<div class="pGroup">
				<div class="pReload pButton ajax_refresh_and_loading" id='ajax_refresh_and_loading'>
					<span></span>
				</div>
			</div>
			<div class="pGroup special">			
				<span class="pPageStat">
					<?php $paging_starts_from = "<span id='page-starts-from' class='page-starts-from'>1</span>"; ?>
					<?php $paging_ends_to = "<span id='page-ends-to' class='page-ends-to'>". ($total_results < $default_per_page ? $total_results : $default_per_page) ."</span>"; ?>
					<?php $paging_total_results = "<span id='total_items' class='total_items'>$total_results</span>"?>
					<?php echo str_replace( array('{start}','{end}','{results}'),
											array($paging_starts_from, $paging_ends_to, $paging_total_results),
											$this->l('list_displaying')
										   ); ?>
				</span>
			</div>
		</div>
	</div>
	<div style="clear: both;">
	</div>
	</div>
	<?php echo form_close(); ?>
	</div>
</div>
