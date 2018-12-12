<section class="content-header">
	<section class="content">
		<div class="box box-info custom_box">
			<div class="box-header">
				<h3 class="box-title"><i class="fa fa-plus-circle"></i> <?php echo $this->lang->line("add"); ?> - <?php echo $this->lang->line("book"); ?></h3>
			</div><!-- /.box-header -->
			<!-- form start -->
			<form class="form-horizontal" action="<?php echo site_url().'admin/add_book_action';?>" enctype="multipart/form-data" method="POST">
				<div class="box-body">

					<div class="form-group">
						<label class="col-sm-3 control-label" ><?php echo $this->lang->line("ISBN"); ?>   
						</label>
						<div class="col-sm-9 col-md-6 col-lg-6">
							<input name="isbn" value="<?php echo set_value('isbn');?>"  class="form-control" type="text">		          
							<span class="red"><?php echo form_error('isbn'); ?></span>
						</div>
					</div>


					<div class="form-group">
						<label class="col-sm-3 control-label" ><?php echo $this->lang->line("title"); ?>   *
						</label>
						<div class="col-sm-9 col-md-6 col-lg-6">
							<input name="title" value="<?php echo set_value('title');?>"  class="form-control" type="text">		          
							<span class="red"><?php echo form_error('title'); ?></span>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label" ><?php echo $this->lang->line("subtitle"); ?>  
						</label>
						<div class="col-sm-9 col-md-6 col-lg-6">
							<input name="subtitle" value="<?php echo set_value('subtitle');?>"  class="form-control" type="text">		          
							<span class="red"><?php echo form_error('subtitle'); ?></span>
						</div>
					</div> 

					<div class="form-group">
						<label class="col-sm-3 control-label" ><?php echo $this->lang->line("author"); ?>  *
						</label>
						<div class="col-sm-9 col-md-6 col-lg-6">
							<input name="author" value="<?php echo set_value('author');?>"  class="form-control" type="text">		               
							<span class="red"><?php echo form_error('author'); ?></span>
						</div>
					</div>	

					<div class="form-group">
						<label class="col-sm-3 control-label" ><?php echo $this->lang->line("edition"); ?>   *
						</label>
						<div class="col-sm-9 col-md-6 col-lg-6">
							<input name="edition" value="<?php echo set_value('edition');?>"  class="form-control" type="text">		          
							<span class="red"><?php echo form_error('edition'); ?></span>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label" ><?php echo $this->lang->line("edition year"); ?> 
						</label>
						<div class="col-sm-9 col-md-6 col-lg-6">
							<input name="edition_year" value="<?php echo set_value('edition_year');?>"  class="form-control" type="text">		          
							<span class="red"><?php echo form_error('edition_year'); ?></span>
						</div>
					</div> 

					<div class="form-group">
						<label class="col-sm-3 control-label" ><?php echo $this->lang->line("number of copies"); ?>   *
						</label>
						<div class="col-sm-9 col-md-6 col-lg-6">
							<input type="number" min="1" name="number_of_books" value="<?php if(form_error('number_of_books')) echo set_value('number_of_books'); else echo 1;?>"  class="form-control">		          
							<span class="red"><?php echo form_error('number_of_books'); ?></span>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label"><?php echo $this->lang->line("cover image"); ?> </label>
						<div class="col-sm-9 col-md-6 col-lg-6">
							<input id="photo" name="photo" class="form-control" type="file"  value="<?php echo set_value('photo'); ?>">
							<span class="blue"><?php echo $this->lang->line("max dimension"); ?>  : 1200 X 2000</span><br/>
							<span class="blue"><?php echo $this->lang->line("max size"); ?> : 1024KB <?php echo $this->lang->line("allowed format");?> : jpg,png</span><br/>
							<!-- <span class="red"><?php $error=$this->session->flashdata('photo_error'); echo $error['error']; ?></span> -->
							<span class="red"><?php echo $this->session->userdata('photo_error'); $this->session->unset_userdata('photo_error'); ?></span>
						</div>
					</div>


					<div class="form-group">
						<label class="col-sm-3 control-label" ><?php echo $this->lang->line("physical form"); ?>  
						</label>
						<div class="col-sm-9 col-md-6 col-lg-6">
							<?php	$all_physical_form['']="";
							echo form_dropdown('physical_form',$all_physical_form,'','class="form-control" id="physical_form"');  ?>			          
							<span class="red"><?php echo form_error('all_physical_form'); ?></span>
						</div>
					</div> 
										

					<div class="form-group">
						<label class="col-sm-3 control-label" ><?php echo $this->lang->line("publisher"); ?>  
						</label>
						<div class="col-sm-9 col-md-6 col-lg-6">
							<input name="publisher" value="<?php echo set_value('publisher');?>"  class="form-control" type="text">		          
							<span class="red"><?php echo form_error('publisher'); ?></span>
						</div>
					</div> 



					<div class="form-group">
						<label class="col-sm-3 control-label" ><?php echo $this->lang->line("series"); ?> 
						</label>
						<div class="col-sm-9 col-md-6 col-lg-6">
							<input name="series" value="<?php echo set_value('series');?>"  class="form-control" type="text">		          
							<span class="red"><?php echo form_error('series'); ?></span>
						</div>
					</div> 

					<div class="form-group">
						<label class="col-sm-3 control-label" ><?php echo $this->lang->line("size"); ?> 
						</label>
						<div class="col-sm-9 col-md-6 col-lg-6">
							<?php	$size_all['']="";
							echo form_dropdown('size1',$size_all,'','class="form-control" id="size1"');  ?>			          
							<span class="red"><?php echo form_error('size1'); ?></span>
						</div>
					</div>  

					<div class="form-group">
						<label class="col-sm-3 control-label" ><?php echo $this->lang->line("price"); ?> 
						</label>
						<div class="col-sm-9 col-md-6 col-lg-6">
							<input name="price" value="<?php echo set_value('price');?>"  class="form-control" type="text">		          
							<span class="red"><?php echo form_error('price'); ?></span>
						</div>
					</div> 

					<div class="form-group">
						<label class="col-sm-3 control-label" ><?php echo $this->lang->line("call no"); ?> 
						</label>
						<div class="col-sm-9 col-md-6 col-lg-6">
							<input name="call_no" value="<?php echo set_value('call_no');?>"  class="form-control" type="text">		          
							<span class="red"><?php echo form_error('call_no'); ?></span>
						</div>
					</div> 

					<div class="form-group">
						<label class="col-sm-3 control-label" ><?php echo $this->lang->line("location"); ?> 
						</label>
						<div class="col-sm-9 col-md-6 col-lg-6">
							<input name="location" value="<?php echo set_value('location');?>"  class="form-control" type="text">		          
							<span class="red"><?php echo form_error('location'); ?></span>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label" ><?php echo $this->lang->line("clue page"); ?> 
						</label>
						<div class="col-sm-9 col-md-6 col-lg-6">
							<input name="clue_page" value="<?php echo set_value('clue_page');?>"  class="form-control" type="text">		          
							<span class="red"><?php echo form_error('clue_page'); ?></span>
						</div>
					</div>


					<div class="form-group">
						<label class="col-sm-3 control-label" ><?php echo $this->lang->line("book category"); ?> 
						</label>
						<div class="col-sm-9 col-md-6 col-lg-6">		    
							<?php 
							foreach ($info2 as $cat)
							{
								echo '<input name="cat[]" type="checkbox" value="'.$cat["id"].'"/> '.$cat["category_name"].'<br/>';
							}
							?>       		             		             		 	          
							<span class="red"><?php echo form_error('cat'); ?></span>
						</div>		             
					</div> 

					<div class="form-group">
						<label class="col-sm-3 control-label" ><?php echo $this->lang->line("editor"); ?> 
						</label>
						<div class="col-sm-9 col-md-6 col-lg-6">
							<input name="editor" value="<?php echo set_value('editor');?>"  class="form-control" type="text">		          
							<span class="red"><?php echo form_error('editor'); ?></span>
						</div>
					</div>
					

					<div class="form-group">
						<label class="col-sm-3 control-label" ><?php echo $this->lang->line("publication year"); ?> 
						</label>
						<div class="col-sm-9 col-md-6 col-lg-6">
							<input name="publishing_year" value="<?php echo set_value('publishing_year');?>"  class="form-control" type="text">		          
							<span class="red"><?php echo form_error('publishing_year'); ?></span>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label" ><?php echo $this->lang->line("publication place"); ?> 
						</label>
						<div class="col-sm-9 col-md-6 col-lg-6">
							<input name="publication_place" value="<?php echo set_value('publication_place');?>"  class="form-control" type="text">		          
							<span class="red"><?php echo form_error('publication_place'); ?></span>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label" ><?php echo $this->lang->line("total pages"); ?> 
						</label>
						<div class="col-sm-9 col-md-6 col-lg-6">
							<input name="number_of_pages" value="<?php echo set_value('number_of_pages');?>"  class="form-control" type="text">		          
							<span class="red"><?php echo form_error('number_of_pages'); ?></span>
						</div>
					</div>

					

					<!-- <div class="form-group">
						<label class="col-sm-3 control-label" >Dues
						</label>
						<div class="col-sm-9 col-md-6 col-lg-6">
							<input name="dues" value="<?php echo set_value('dues');?>"  class="form-control" type="text">		          
							<span class="red"><?php echo form_error('dues'); ?></span>
						</div>
					</div>  -->

					<div class="form-group">
						<label class="col-sm-3 control-label" ><?php echo $this->lang->line("source of book"); ?> 
						</label>
						<div class="col-sm-9 col-md-6 col-lg-6">
							<?php	$all_source_details['']="";
							echo form_dropdown('source_details',$all_source_details,set_value('source_details'),'class="form-control" id="source_details"');  ?>			          
							<span class="red"><?php echo form_error('source_details'); ?></span>
						</div>
					</div> 

					<div class="form-group">
						<label class="col-sm-3 control-label" ><?php echo $this->lang->line("notes"); ?> 
						</label>
						<div class="col-sm-9 col-md-6 col-lg-6">
							<input name="notes" value="<?php echo set_value('notes');?>"  class="form-control" type="text">		          
							<span class="red"><?php echo form_error('notes'); ?></span>
						</div>
					</div>


					<div class="form-group">
						<label class="col-sm-3 control-label"><?php echo $this->lang->line("pdf / epub version- if available"); ?> </label>
						<div class="col-sm-9 col-md-6 col-lg-6">
							<input id="pdf" name="pdf" class="form-control" type="file"  value="<?php echo set_value('pdf'); ?>">
							<span class="red"><?php echo $this->session->userdata('pdf_error'); $this->session->unset_userdata('pdf_error'); ?></span>
						</div>
					</div> 

					<div class="form-group">
						<label class="col-sm-3 control-label" >
						</label>
						<div class="col-sm-9 col-md-6 col-lg-6">
							<span><?php echo $this->lang->line("OR"); ?></span>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label" ><?php echo $this->lang->line("pdf / epub link- if available"); ?> 
						</label>
						<div class="col-sm-9 col-md-6 col-lg-6">
							<input name="link" value="<?php echo set_value('link');?>"  class="form-control" type="text">		          
							<span class="red"><?php echo form_error('link'); ?></span>
						</div>
					</div>


				</div> <!-- /.box-body --> 
				<div class="box-footer">
					<div class="form-group">
						<div class="col-sm-12 text-center">
							<input name="submit" type="submit" class="btn btn-warning btn-lg" value="<?php echo $this->lang->line('save');?>"/>  
							<input type="button" class="btn btn-default btn-lg" value="<?php echo $this->lang->line('cancel');?>" onclick='goBack("admin/book_list")'/>  
						</div>
					</div>
				</div><!-- /.box-footer -->         
			</div><!-- /.box-info -->       
		</form>     
	</div>
</section>
</section>



