<?php print_r($all_member_type); exit(); ?>



<section class="content-header">
	<section class="content">
		<div class="box box-info custom_box">
			<div class="box-header">
				<h3 class="box-title"><i class="fa fa-pencil"></i> Registration</h3>
			</div><!-- /.box-header -->
			<!-- form start -->
			<form class="form-horizontal" action="<?php echo site_url().'member/member_registration_action'?>" enctype="multipart/form-data" method="POST">
				<div class="box-body">


					<div class="form-group">
						<label class="col-sm-3 control-label" for="name">Name  *
						</label>
						<div class="col-sm-9 col-md-6 col-lg-6">
							<input name="name" value="<?php if(isset($info['name'])) echo $info['name'];?>"  class="form-control" type="text-area">		          
							<span class="red"><?php echo form_error('name'); ?></span>
						</div>
					</div> 

					<div class="form-group">
						<label class="col-sm-3 control-label" for="name">Member Types *
						</label>
						<div class="col-sm-9 col-md-6 col-lg-6">
							<?php	$all_member_type['']="";
							echo form_dropdown('member_type',$all_member_type,'','class="form-control" id="member_type"');  ?>			          
							<span class="red"><?php echo form_error('member_type'); ?></span>
						</div>
					</div> 

		           

					<div class="form-group">
						<label class="col-sm-3 control-label" for="name">email *
						</label>
						<div class="col-sm-9 col-md-6 col-lg-6">
							<input name="email" value="<?php if(isset($info['email'])) echo $info['email'];?>"  class="form-control" type="text">		               
							<span class="red"><?php echo form_error('email'); ?></span>
						</div>
					</div>		


					<div class="form-group">
						<label class="col-sm-3 control-label" for="name">address  *
						</label>
						<div class="col-sm-9 col-md-6 col-lg-6">
							<input name="address" value="<?php if(isset($info['address'])) echo $info['address']?>"  class="form-control" type="text-area">		          
							<span class="red"><?php echo form_error('address'); ?></span>
						</div>
					</div>
		             	
					<!-- <div class="form-group">
						<label class="col-sm-3 control-label" for="name">Note *
						</label>
						<div class="col-sm-9 col-md-6 col-lg-6">
							<input name="note" value="<?php if(isset($info['note'])) echo $info['note']?>"  class="form-control" type="text-area">		          
							<span class="red"><?php echo form_error('note'); ?></span>
						</div>
					</div>  -->


		             </div> <!-- /.box-body --> 
		             <div class="box-footer">
		             	<div class="form-group">
		             		<div class="col-sm-12 text-center">
		             			<input name="submit" type="submit" class="btn btn-warning btn-lg" value="Save"/>  
		             			<input type="button" class="btn btn-default btn-lg" value="Cancel" onclick='goBack("member/member_book_list",0)'/>  
		             		</div>
		             	</div>
		             </div><!-- /.box-footer -->         
		         </div><!-- /.box-info -->       
		     </form>     
		 </div>
		</section>
	</section>




