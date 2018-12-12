<section class="content-header">
	<section class="content">
		<div class="box box-info custom_box">
			<div class="box-header">
				<h3 class="box-title"><i class="fa fa-pencil"></i> <?php echo $this->lang->line("edit"); ?> - <?php echo $this->lang->line("book"); ?></h3>
			</div><!-- /.box-header -->
			<!-- form start -->
			<form class="form-horizontal" action="<?php echo site_url().'admin/update_book_action/'.$info['id'];?>" enctype="multipart/form-data" method="POST">
				<div class="box-body">

					<div class="form-group">
						<label class="col-sm-3 control-label" ><?php echo $this->lang->line("ISBN"); ?>  
						</label>
						<div class="col-sm-9 col-md-6 col-lg-6">
							<input name="isbn" value="<?php if(set_value('isbn')) echo set_value('isbn');else {if(isset($info['isbn'])) echo $info['isbn'];}?>"  class="form-control" type="text">		          
							<span class="red"><?php echo form_error('isbn'); ?></span>
						</div>
					</div> 

					<div class="form-group">
						<label class="col-sm-3 control-label" ><?php echo $this->lang->line("title"); ?> *
						</label>
						<div class="col-sm-9 col-md-6 col-lg-6">
							<input name="title" value="<?php if(set_value('title')) echo set_value('title');else {if(isset($info['title'])) echo $info['title'];}?>"  class="form-control" type="text">		          
							<span class="red"><?php echo form_error('title'); ?></span>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label" ><?php echo $this->lang->line("subtitle"); ?>  
						</label>
						<div class="col-sm-9 col-md-6 col-lg-6">
							<input name="subtitle" value="<?php if(set_value('subtitle')) echo set_value('subtitle');else{if(isset($info['subtitle'])) echo $info['subtitle'];}?>"  class="form-control" type="text">		          
							<span class="red"><?php echo form_error('subtitle'); ?></span>
						</div>
					</div> 

					<div class="form-group">
						<label class="col-sm-3 control-label" ><?php echo $this->lang->line("author"); ?>  *
						</label>
						<div class="col-sm-9 col-md-6 col-lg-6">
							<input name="author" value="<?php if(set_value('author')) echo set_value('author');else{if(isset($info['author'])) echo $info['author'];}
							?>"  class="form-control" type="text">		               
							<span class="red"><?php echo form_error('author'); ?></span>
						</div>
					</div>				

					<div class="form-group">
						<label class="col-sm-3 control-label" ><?php echo $this->lang->line("edition"); ?>   *
						</label>
						<div class="col-sm-9 col-md-6 col-lg-6">
							<input name="edition" value="<?php 
								if(set_value('edition')) echo set_value('edition');
								else {									
									if(isset($info['edition'])) echo $info['edition'];
								}
							?>"  class="form-control" type="text">		          
							<span class="red"><?php echo form_error('edition'); ?></span>
						</div>
					</div>	


					<div class="form-group">
						<label class="col-sm-3 control-label" ><?php echo $this->lang->line("edition year"); ?>  
						</label>
						<div class="col-sm-9 col-md-6 col-lg-6">
							<input name="edition_year" value="<?php 
								if(set_value('edition_year')) echo set_value('edition_year');
								else{									
									if(isset($info['edition_year'])) echo $info['edition_year'];
								}
							?>"  class="form-control" type="text">		          
							<span class="red"><?php echo form_error('edition_year'); ?></span>
						</div>
					</div>  


					<div class="form-group">
		            	<label class="col-sm-3 control-label" ><?php echo $this->lang->line("cover image"); ?> </label>
		            	<div class="col-sm-9 col-md-6 col-lg-6">		            		
		            		<div>
		            			<?php $image=base_url('upload/cover_images').'/'.$info['cover'];   ?>
		            			<img class="img img-thumbnail" style="width:250px; height:275px" src="<?php echo $image; ?>">						
		            		</div>
		            		<input id="photo" name="photo" class="form-control" type="file"  value="<?php echo set_value('photo');  ?>">
		            		<span class="blue"><?php echo $this->lang->line("max dimension"); ?> : 600 X 1000</span><br/>
		            		<span class="blue"><?php echo $this->lang->line("max size"); ?> : 200KB <?php echo $this->lang->line("allowed format"); ?> : jpg,png</span><br/>
		            		<span class="red"><?php echo $this->session->userdata('photo_error'); $this->session->unset_userdata('photo_error'); ?></span>
		            	</div>
		            </div> 	 

		           <div class="form-group">
						<label class="col-sm-3 control-label" ><?php echo $this->lang->line("physical form"); ?> 
						</label>
						<div class="col-sm-9 col-md-6 col-lg-6">
							<?php	$all_physical_form['']="";
							echo form_dropdown('physical_form',$all_physical_form,$info['physical_form'],'class="form-control" id="physical_form"');  ?>			          
							<span class="red"><?php echo form_error('all_physical_form'); ?></span>
						</div>
					</div> 	            
					

		            <div class="form-group">
						<label class="col-sm-3 control-label" ><?php echo $this->lang->line("publisher"); ?>  
						</label>
						<div class="col-sm-9 col-md-6 col-lg-6">
							<input name="publisher" value="<?php 
								if(set_value('publisher')) echo set_value('publisher');
								else{									
									if(isset($info['publisher'])) echo $info['publisher']; 
								}
							?>"  class="form-control" type="text">		          
							<span class="red"><?php echo form_error('publisher'); ?></span>
						</div>
					</div>  

		             
					<div class="form-group">
						<label class="col-sm-3 control-label" ><?php echo $this->lang->line("series"); ?> 	
						</label>
						<div class="col-sm-9 col-md-6 col-lg-6">
							<input name="series" value="<?php 
								if(set_value('series')) echo set_value('series');
								else{									
									if(isset($info['series'])) echo $info['series'];
								}
							?>"  class="form-control" type="text">		          
							<span class="red"><?php echo form_error('series'); ?></span>
						</div>
					</div>  

		            <div class="form-group">
						<label class="col-sm-3 control-label" ><?php echo $this->lang->line("size"); ?>  
						</label>
						<div class="col-sm-9 col-md-6 col-lg-6">
							<?php	$size_all['']="";
							echo form_dropdown('size1',$size_all,$info['size1'],'class="form-control" id="size1"');  ?>			          
							<span class="red"><?php echo form_error('size1'); ?></span>
						</div>
					</div>  

		            <div class="form-group">
						<label class="col-sm-3 control-label" ><?php echo $this->lang->line("price"); ?>  
						</label>
						<div class="col-sm-9 col-md-6 col-lg-6">
							<input name="price" value="<?php 
								if(set_value('price')) echo set_value('price');
								else{									
									if(isset($info['price'])) echo $info['price'];
								}
							?>"  class="form-control" type="text">		          
							<span class="red"><?php echo form_error('price'); ?></span>
						</div>
					</div> 

		            <div class="form-group">
						<label class="col-sm-3 control-label" ><?php echo $this->lang->line("call no"); ?>  
						</label>
						<div class="col-sm-9 col-md-6 col-lg-6">
							<input name="call_no" value="<?php 
								if(set_value('call_no')) echo set_value('call_no');
								else{									
									if(isset($info['call_no'])) echo $info['call_no'];
								}
							?>"  class="form-control" type="text">		          
							<span class="red"><?php echo form_error('call_no'); ?></span>
						</div>
					</div> 

		             	
					<div class="form-group">
						<label class="col-sm-3 control-label" ><?php echo $this->lang->line("location"); ?>  
						</label>
						<div class="col-sm-9 col-md-6 col-lg-6">
							<input name="location" value="<?php
								if(set_value('location')) echo set_value('location');
								else{									
									if(isset($info['location'])) echo $info['location'];
								}
							?>"  class="form-control" type="text">		          
							<span class="red"><?php echo form_error('location'); ?></span>
						</div>
					</div>

		            <div class="form-group">
						<label class="col-sm-3 control-label" ><?php echo $this->lang->line("clue page"); ?> 
						</label>
						<div class="col-sm-9 col-md-6 col-lg-6">
							<input name="clue_page" value="<?php 
								if(set_value('clue_page')) echo set_value('clue_page');
								else{									
									if(isset($info['clue_page'])) echo $info['clue_page'];
								}
							?>"  class="form-control" type="text">		          
							<span class="red"><?php echo form_error('clue_page'); ?></span>
						</div>
					</div>

		            <div class="form-group">
						<label class="col-sm-3 control-label" ><?php echo $this->lang->line("category"); ?>  
						</label>
						<div class="col-sm-9 col-md-6 col-lg-6">	

		             		<?php		             		
		             		$size_of_all_category = sizeof($all_category);				// extracting array size
		             		$size_of_existing_category = sizeof($existing_category);	
		             		foreach ($all_category as $value) 
		             		{
		             			$temp = "/>";
		             			for($i=0; $i<$size_of_existing_category; $i++)
		             			{		             				
		             				if($value['id'] == $existing_category[$i])
		             					$temp = "checked/>";
		             			}
		             			echo "<input type = 'checkbox' name = 'cat[]' value =".$value['id']." ".$temp.' '.$value['category_name']."<br/>";
		             		 }		             		
		             		?>	  

		             	<span class="red"><?php echo form_error('category'); ?></span>
						</div>		             
					</div> 

		            <div class="form-group">
						<label class="col-sm-3 control-label" ><?php echo $this->lang->line("editor"); ?>   
						</label>
						<div class="col-sm-9 col-md-6 col-lg-6">
							<input name="editor" value="<?php 
								if(set_value('editor')) echo set_value('editor');
								else{									
									if(isset($info['editor'])) echo $info['editor'];
								}
							?>"  class="form-control" type="text">		          
							<span class="red"><?php echo form_error('editor'); ?></span>
						</div>
					</div>

		            

					<div class="form-group">
						<label class="col-sm-3 control-label" ><?php echo $this->lang->line("publication year"); ?>   
						</label>
						<div class="col-sm-9 col-md-6 col-lg-6">
							<input name="publishing_year" value="<?php 
								if(set_value('publishing_year')) echo set_value('publishing_year');
								else{									
									if(isset($info['publishing_year'])) echo $info['publishing_year'];
								}
							?>"  class="form-control" type="text">		          
							<span class="red"><?php echo form_error('publishing_year'); ?></span>
						</div>
					</div>


					<div class="form-group">
						<label class="col-sm-3 control-label" ><?php echo $this->lang->line("publication place"); ?>   
						</label>
						<div class="col-sm-9 col-md-6 col-lg-6">
							<input name="publication_place" value="<?php 
								if(set_value('publication_place')) echo set_value('publication_place');
								else{									
									if(isset($info['publication_place'])) echo $info['publication_place'];
								}
							?>"  class="form-control" type="text">		          
							<span class="red"><?php echo form_error('publication_place'); ?></span>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label" ><?php echo $this->lang->line("total pages"); ?>   
						</label>
						<div class="col-sm-9 col-md-6 col-lg-6">
							<input name="number_of_pages" value="<?php 
								if(set_value('number_of_pages')) echo set_value('number_of_pages');
								else{									
									if(isset($info['number_of_pages'])) echo $info['number_of_pages'];
								}
							?>"  class="form-control" type="text">		          
							<span class="red"><?php echo form_error('number_of_pages'); ?></span>
						</div>
					</div>

					<!-- <div class="form-group">
						<label class="col-sm-3 control-label" >Total Books  *
						</label>
						<div class="col-sm-9 col-md-6 col-lg-6">
							<input name="number_of_books" value="<?php echo set_value('number_of_books');  if(isset($info['number_of_books'])) echo $info['number_of_books'];?>"  class="form-control" type="text">		          
							<span class="red"><?php echo form_error('number_of_books'); ?></span>
						</div>
					</div> -->

					<!-- <div class="form-group">
						<label class="col-sm-3 control-label" >Dues  
						</label>
						<div class="col-sm-9 col-md-6 col-lg-6">
							<input name="dues" value="<?php if(isset($info['dues'])) echo $info['dues'];?>"  class="form-control" type="text">		          
							<span class="red"><?php echo form_error('dues'); ?></span>
						</div>
					</div>  -->

					<div class="form-group">
						<label class="col-sm-3 control-label" ><?php echo $this->lang->line("source of book"); ?>  
						</label>
						<div class="col-sm-9 col-md-6 col-lg-6">
							<?php	$all_source_details['']="";
							echo form_dropdown('source_details',$all_source_details,$info['source_details'],'class="form-control" id="source_details"');  ?>			          
							<span class="red"><?php echo form_error('source_details'); ?></span>
						</div>
					</div> 

					<div class="form-group">
						<label class="col-sm-3 control-label" ><?php echo $this->lang->line("notes"); ?>   
						</label>
						<div class="col-sm-9 col-md-6 col-lg-6">
							<input name="notes" value="<?php 
								if(set_value('notes')) echo set_value('notes');
								else{									
									if(isset($info['notes'])) echo $info['notes'];
								}
							?>"  class="form-control" type="text">		          
							<span class="red"><?php echo form_error('notes'); ?></span>
						</div>
					</div>

					<div class="form-group">
		             	<label class="col-sm-3 control-label" ><?php echo $this->lang->line("availability"); ?>  
		             	</label>
		             		<div class="col-sm-9 col-md-6 col-lg-6">
		               			<?php	
		               			$status_all = array('1'=>$this->lang->line("available"),'0'=>$this->lang->line("unavailable"));
              					echo form_dropdown('status', $status_all, $info['status'],'class="form-control" id="status"'); 
              					?>	     
		             			<span class="red"><?php echo form_error('status'); ?></span>
		             		</div>
		            </div>  

		            <div class="form-group">
						<label class="col-sm-3 control-label"><?php echo $this->lang->line("pdf / epub version- if available"); ?></label>
						<div class="col-sm-9 col-md-6 col-lg-6">
							<input id="pdf" name="pdf" class="form-control" type="file"  value="">
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
							<input name="link" value="<?php 
								if(set_value('link')) echo set_value('link');
								else{									
									if(isset($info['pdf'])) echo $info['pdf'];
								}
							?>"   class="form-control" type="text">		          
							<span class="red"><?php echo form_error('link'); ?></span>
						</div>
					</div>

					<!-- <div class="form-group">
						<label class="col-sm-3 control-label"></label>
						<div class="col-sm-9 col-md-6 col-lg-6">
							<label class="radio-inline"><input name="single_group" type="radio"  value="1">Only for this book</label>
							<label class="radio-inline"><input name="single_group" type="radio" checked="checked" value="2">All books of this group</label>
							<span class="red"><?php echo form_error('single_group'); ?></span>
						</div>
					</div> -->
					

		             </div> <!-- /.box-body --> 
		             <div class="box-footer">
		             	<div class="form-group">
		             		<div class="col-sm-12 text-center">
		             			<input name="submit" type="submit" class="btn btn-warning btn-lg" value="<?php echo $this->lang->line("save"); ?>"/>  
		             			<input type="button" class="btn btn-default btn-lg" value="<?php echo $this->lang->line("cancel"); ?>" onclick='goBack("admin/book_list",1)'/>  
		             		</div>
		             	</div>
		             </div><!-- /.box-footer -->         
		         </div><!-- /.box-info -->       
		     </form>     
		 </div>
		</section>
	</section>




