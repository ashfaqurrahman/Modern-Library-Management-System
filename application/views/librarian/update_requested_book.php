



<section class="content-header">
	<section class="content">
		<div class="box box-info custom_box">
			<div class="box-header">
				<h3 class="box-title"><i class="fa fa-pencil"></i> Edit Book</h3>
			</div><!-- /.box-header -->
			<!-- form start -->
			<form class="form-horizontal" action="<?php echo site_url().'admin/update_requested_book_action/'.$info['id'];?>" enctype="multipart/form-data" method="POST">
				<div class="box-body">


					<div class="form-group">
						<label class="col-sm-3 control-label" for="name">id  *
						</label>
						<div class="col-sm-9 col-md-6 col-lg-6">
							<input name="id" value="<?php if(isset($info['id'])) echo $info['id'];?>"  class="form-control" type="text">		          
							<span class="red"><?php echo form_error('id'); ?></span>
						</div>
					</div> 

		          <!--  <div class="form-group">
						<label class="col-sm-3 control-label" for="name">Physical Form *
						</label>
						<div class="col-sm-9 col-md-6 col-lg-6">
							<?php	$all_physical_form['']="";
							echo form_dropdown('physical_form',$all_physical_form,'','class="form-control" id="physical_form"');  ?>			          
							<span class="red"><?php echo form_error('all_physical_form'); ?></span>
						</div>
					</div>  -->

		             	<div class="form-group">
						<label class="col-sm-3 control-label" for="name">member_id *
						</label>
						<div class="col-sm-9 col-md-6 col-lg-6">
							<input name="member_id" value="<?php if(isset($info['member_id'])) echo $info['member_id'];?>"  class="form-control" type="text">		               
							<span class="red"><?php echo form_error('member_id'); ?></span>
						</div>
					</div>		


		             	<div class="form-group">
						<label class="col-sm-3 control-label" for="name">book_title  *
						</label>
						<div class="col-sm-9 col-md-6 col-lg-6">
							<input name="book_title" value="<?php if(isset($info['book_title'])) echo $info['book_title']?>"  class="form-control" type="text">		          
							<span class="red"><?php echo form_error('book_title'); ?></span>
						</div>
					</div>
		             	
					<div class="form-group">
						<label class="col-sm-3 control-label" for="name">author *
						</label>
						<div class="col-sm-9 col-md-6 col-lg-6">
							<input name="author" value="<?php if(isset($info['author'])) echo $info['author']?>"  class="form-control" type="text">		          
							<span class="red"><?php echo form_error('author'); ?></span>
						</div>
					</div> 

		             	<div class="form-group">
						<label class="col-sm-3 control-label" for="name">Year of edition *
						</label>
						<div class="col-sm-9 col-md-6 col-lg-6">
							<input name="edition" value="<?php if(isset($info['edition'])) echo $info['edition'];?>"  class="form-control" type="text">		          
							<span class="red"><?php echo form_error('edition'); ?></span>
						</div>
					</div>  

		             	<div class="form-group">
						<label class="col-sm-3 control-label" for="name">note *
						</label>
						<div class="col-sm-9 col-md-6 col-lg-6">
							<input name="note" value="<?php if(isset($info['note'])) echo $info['note']; ?>"  class="form-control" type="text">		          
							<span class="red"><?php echo form_error('note'); ?></span>
						</div>
					</div>  

		             	
					<div class="form-group">
						<label class="col-sm-3 control-label" for="name">date	 *
						</label>
						<div class="col-sm-9 col-md-6 col-lg-6">
							<input name="date" value="<?php if(isset($info['date'])) echo $info['date'];?>"  class="form-control" type="text">		          
							<span class="red"><?php echo form_error('date'); ?></span>
						</div>
					</div>  

		             	<!-- <div class="form-group">
						<label class="col-sm-3 control-label" for="name">Size *
						</label>
						<div class="col-sm-9 col-md-6 col-lg-6">
							<?php	$size_all['']="";
							echo form_dropdown('size',$size_all,'','class="form-control" id="size"');  ?>			          
							<span class="red"><?php echo form_error('size'); ?></span>
						</div>
					</div>   -->

		             	<div class="form-group">
						<label class="col-sm-3 control-label" for="name">reply *
						</label>
						<div class="col-sm-9 col-md-6 col-lg-6">
							<input name="reply" value="<?php if(isset($info['reply'])) echo $info['reply'];?>"  class="form-control" type="text">		          
							<span class="red"><?php echo form_error('reply'); ?></span>
						</div>
					</div> 

		             	<div class="form-group">
						<label class="col-sm-3 control-label" for="name">Call No. *
						</label>
						<div class="col-sm-9 col-md-6 col-lg-6">
							<input name="status" value="<?php if(isset($info['status'])) echo $info['status'];?>"  class="form-control" type="text">		          
							<span class="red"><?php echo form_error('status'); ?></span>
						</div>
					</div> 

		             	
					<div class="form-group">
						<label class="col-sm-3 control-label" for="name">Location *
						</label>
						<div class="col-sm-9 col-md-6 col-lg-6">
							<input name="location" value="<?php if(isset($info['location'])) echo $info['location'];?>"  class="form-control" type="text">		          
							<span class="red"><?php echo form_error('location'); ?></span>
						</div>
					</div>

		             	<div class="form-group">
						<label class="col-sm-3 control-label" for="name">Clue Page *
						</label>
						<div class="col-sm-9 col-md-6 col-lg-6">
							<input name="clue_page" value="<?php if(isset($info['clue_page'])) echo $info['clue_page'];?>"  class="form-control" type="text">		          
							<span class="red"><?php echo form_error('clue_page'); ?></span>
						</div>
					</div>

		             	<div class="form-group">
						<label class="col-sm-3 control-label" for="name">Category *
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
		             			echo "<input type = 'checkbox' name = 'cat[]' value =".$value['id']." ".$temp.$value['category_name']."<br/>";
		             		 }		             		
		             		?>	         		
		             	<span class="red"><?php echo form_error('category'); ?></span>
						</div>		             
					</div> 

		             	<div class="form-group">
						<label class="col-sm-3 control-label" for="name">Editor  *
						</label>
						<div class="col-sm-9 col-md-6 col-lg-6">
							<input name="editor" value="<?php if(isset($info['editor'])) echo $info['editor'];?>"  class="form-control" type="text">		          
							<span class="red"><?php echo form_error('editor'); ?></span>
						</div>
					</div>

		            <div class="form-group">
						<label class="col-sm-3 control-label" for="name">Edition  *
						</label>
						<div class="col-sm-9 col-md-6 col-lg-6">
							<input name="edition" value="<?php if(isset($info['edition'])) echo $info['edition'];?>"  class="form-control" type="text">		          
							<span class="red"><?php echo form_error('edition'); ?></span>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label" for="name">Publishing Year  *
						</label>
						<div class="col-sm-9 col-md-6 col-lg-6">
							<input name="publishing_year" value="<?php if(isset($info['publishing_year'])) echo $info['publishing_year'];?>"  class="form-control" type="text">		          
							<span class="red"><?php echo form_error('publishing_year'); ?></span>
						</div>
					</div>


					<div class="form-group">
						<label class="col-sm-3 control-label" for="name">Publication Place  *
						</label>
						<div class="col-sm-9 col-md-6 col-lg-6">
							<input name="publication_place" value="<?php if(isset($info['publication_place'])) echo $info['publication_place'];?>"  class="form-control" type="text">		          
							<span class="red"><?php echo form_error('publication_place'); ?></span>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label" for="name">Total Pages  *
						</label>
						<div class="col-sm-9 col-md-6 col-lg-6">
							<input name="number_of_pages" value="<?php if(isset($info['number_of_pages'])) echo $info['number_of_pages'];?>"  class="form-control" type="text">		          
							<span class="red"><?php echo form_error('number_of_pages'); ?></span>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label" for="name">Total Books  *
						</label>
						<div class="col-sm-9 col-md-6 col-lg-6">
							<input name="number_of_books" value="<?php echo set_value('number_of_books');  if(isset($info['number_of_books'])) echo $info['number_of_books'];?>"  class="form-control" type="text">		          
							<span class="red"><?php echo form_error('number_of_books'); ?></span>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label" for="name">Dues  *
						</label>
						<div class="col-sm-9 col-md-6 col-lg-6">
							<input name="dues" value="<?php if(isset($info['dues'])) echo $info['dues'];?>"  class="form-control" type="text">		          
							<span class="red"><?php echo form_error('dues'); ?></span>
						</div>
					</div> 

					<div class="form-group">
						<label class="col-sm-3 control-label" for="name">Source of Book *
						</label>
						<div class="col-sm-9 col-md-6 col-lg-6">
							<?php	$all_source_details['']="";
							echo form_dropdown('source_details',$all_source_details,'','class="form-control" id="source_details"');  ?>			          
							<span class="red"><?php echo form_error('source_details'); ?></span>
						</div>
					</div> 

					<div class="form-group">
						<label class="col-sm-3 control-label" for="name">Notes  *
						</label>
						<div class="col-sm-9 col-md-6 col-lg-6">
							<input name="notes" value="<?php if(isset($info['notes'])) echo $info['notes'];?>"  class="form-control" type="text">		          
							<span class="red"><?php echo form_error('notes'); ?></span>
						</div>
					</div>

					<div class="form-group">
		             	<label class="col-sm-3 control-label" for="name">Status *
		             	</label>
		             		<div class="col-sm-9 col-md-6 col-lg-6">
		               			<?php	
		               			$status_all=array('1'=>'Available','0'=>'Not Available');
              					echo form_dropdown('status', $status_all,$info['status'],'class="form-control" id="status"'); 
              					?>	     
		             			<span class="red"><?php echo form_error('status'); ?></span>
		             		</div>
		           </div>  

					<div class="form-group">
						<div class="col-sm-9 col-md-6 col-lg-6">
						
						<div>
						<?php $image=base_url('upload/cover_images').'/'.$info['cover']; ?>
						<img class="img img-thumbnail" style="width:250px; height:275px" align="right"> src="<?php echo $image; ?>">						
						</div>
							<input id="photo" name="photo" class="form-control" type="file"  value="<?php echo set_value('photo');  ?>">
							<span class="blue">Max 200KB (jpg,png)</span><br/>
							<span class="red"><?php $error=$this->session->flashdata('photo_error'); echo $error['error']; ?></span>
						</div>
					</div> 	          




		             </div> <!-- /.box-body --> 
		             <div class="box-footer">
		             	<div class="form-group">
		             		<div class="col-sm-12 text-center">
		             			<input name="submit" type="submit" class="btn btn-warning btn-lg" value="Save"/>  
		             			<input type="button" class="btn btn-default btn-lg" value="Cancel" onclick='goBack("admin/book_list",0)'/>  
		             		</div>
		             	</div>
		             </div><!-- /.box-footer -->         
		         </div><!-- /.box-info -->       
		     </form>     
		 </div>
		</section>
	</section>




