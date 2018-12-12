<?php 

	$column_width = (int)(80/count($columns));
	
	if(!empty($list)){
?><div class="bDiv" style="padding:0 15px !important;">
		<table cellspacing="0" cellpadding="0" border="0" id="flex1">
		<thead>
			<tr class='hDiv'>
				<?php foreach($columns as $column){?>
				<th width='<?php echo $column_width?>%'>
					<div class="text-center field-sorting <?php if(isset($order_by[0]) &&  $column->field_name == $order_by[0]){?><?php echo $order_by[1]?><?php }?>" 
						rel='<?php echo $column->field_name?>'>
						<?php echo $column->display_as?>
					</div>
				</th>
				<?php }?>
				<?php if(!$unset_delete || !$unset_edit || !$unset_read || !empty($actions)){?>
				<!-- <th align="left" abbr="tools" axis="col1" class="" width='20%'>
					<div class="text-right">
						<?php echo $this->l('list_actions'); ?>
					</div>
				</th> -->
				<?php }?>
			</tr>
		</thead>		
		<tbody>
<?php foreach($list as $num_row => $row){ ?>        
		<tr  <?php if($num_row % 2 == 1){?>class="erow"<?php }?>>
			<?php foreach($columns as $column){?>
			<td width='<?php echo $column_width?>%' class='<?php if(isset($order_by[0]) &&  $column->field_name == $order_by[0]){?>sorted<?php }?>'>
				<div class='text-center'><?php echo $row->{$column->field_name} != '' ? $row->{$column->field_name} : '&nbsp;' ; ?></div>
			</td>
			<?php }?>
			<?php if(!$unset_delete || !$unset_edit || !$unset_read || !empty($actions)){?>
			<!-- <td align="left" width='20%'>
				<div class='tools'>				
					<?php if(!$unset_delete){?>
                    	<a href='<?php echo $row->delete_url?>' title='<?php echo $this->l('list_delete')?> <?php //echo $subject;?>' class="delete-row" >
                    			<span class='delete-icon'></span>
                    	</a>
                    <?php }?>
                    <?php if(!$unset_edit){?>
						<a href='<?php echo $row->edit_url?>' title='<?php echo $this->l('list_edit')?> <?php //echo $subject;?>' class="edit_button"><span class='edit-icon'></span></a>
					<?php }?>
					<?php if(!$unset_read){?>
						<a href='<?php echo $row->read_url?>' title='<?php echo $this->l('list_view')?> <?php //echo $subject;?>' class="edit_button"><span class='read-icon'></span></a>
					<?php }?>
					<?php 
					if(!empty($row->action_urls)){
						foreach($row->action_urls as $action_unique_id => $action_url){ 
							$action = $actions[$action_unique_id];
					?>
							<a href="<?php echo $action_url; ?>" class="<?php echo $action->css_class; ?> crud-action" title="<?php echo $action->label?>"><?php 
								if(!empty($action->image_url))
								{
									?><img src="<?php echo $action->image_url; ?>" alt="<?php echo $action->label?>" /><?php 	
								}
							?></a>		
					<?php }
					}
					?>					
                    <div class='clear'></div>
				</div>
			</td> -->
			<?php }?>
		</tr>
<?php } ?>        
		</tbody>
		</table>
	</div>
<?php }else{?>
	<br/>
	&nbsp;&nbsp;&nbsp;&nbsp; <?php echo $this->l('list_no_items'); ?>
	<br/>
	<br/>
<?php }?>


<!-- <div class="container" style = 'display:none' id = 'id_card_div'>
      <div class="row">
        <div class="col-xs-4 col-lg-4 col-sm-12 col-xs-12 col-xs-offset-4 ">
        	<div style="border:1px solid black; padding:10px;">
        		<div class="id_img">        			
        			<img class="img-responsive center-block" style="height:45px;margin-top:3px;" src="<?php echo base_url();?>assets/images/logo.png" alt="Image">
        		</div>
        		<hr>
        		<div style="margin-top:10px;">

        			<p id= "id"></p>
        			<p id= "name"></p>
        			<p id= "email"></p>
        			<p id= "address"></p>
        			<p id= "add_date"></p>
        			<p id= "type"></p>
        			<p id= "bar"></p>
	        	</div>
            </div>
        </div>
      </div>
    </div>


<script>
	function print_member_id_card(str){

		// alert(str);

		var res = str.split("_|_");
		// $('#id').html('<div style="border:2px solid gray;height:230px;padding:10px;">'); 
		$('#name').html('<p><b>Name :</b> '+res[1]+'</p>');
		$('#email').html('<p><b>Email :</b> '+res[2]+'</p>'); 
		$('#address').html('<p><b>Address :</b> '+res[3]+'</p>'); 
		$('#add_date').html('<p><b>Add Date :</b> '+res[4]+'</p>'); 
		$('#type').html('<p><b>Type :</b> '+res[5]+'</p>'); 
		$('#bar').html('<div><img width="250px" height="35px"  class="img-responsive center-block" src="'+res[6]+'"></div>'); 
		popup($('#id_card_div').html());
	}


    function popup(data) 
    { 

        var mywindow = window.open('', 'print_details', 'width:3.37in,height:2.125in'); 
        mywindow.document.write('<html><head>'); 
        mywindow.document.write('<link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">'); 
        mywindow.document.write('</head><body>'); 
        mywindow.document.write(data); 
        mywindow.document.write('</body></html>'); 
        mywindow.document.close(); 
        mywindow.print(); 
        return true; 
    }
</script>
 -->