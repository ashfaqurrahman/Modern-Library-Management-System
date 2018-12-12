<section class="content-header">
   <section class="content">
     	<div class="box box-info custom_box">
		    	<div class="box-header">
		         <h3 class="box-title"><i class="fa fa-plus-circle"></i> Edit books</h3>
		        </div><!-- /.box-header -->
		       		<!-- form start -->
		    <form class="form-horizontal" action="<?php echo site_url().'admin_library/delete_book_action/'.$info['id'];?>" method="POST">
		        <div class="box-body">
		           	<div class="form-group">
		              	<label class="col-sm-3 control-label" for="name">Delete *
		              	</label>
		                	<div class="col-sm-9 col-md-6 col-lg-6">
		               			<input name="deleted" value="<?php echo set_value('deleted')."1";?>"  class="form-control" type="text">		               
		             			<span class="red"><?php echo form_error('deleted'); ?></span>
		             		</div>
		            </div>
		           
		           		               
		           </div> <!-- /.box-body --> 
		           	<div class="box-footer">
		            	<div class="form-group">
		             		<div class="col-sm-12 text-center">
		               			<input name="submit" type="submit" class="btn btn-warning btn-lg" value="Save"/>  
		              			<input type="button" class="btn btn-default btn-lg" value="Cancel" onclick='goBack("admin_library/book_list",0)'/>  
		             		</div>
		           		</div>
		         	</div><!-- /.box-footer -->         
		        </div><!-- /.box-info -->       
		    </form>     
     	</div>
   </section>
</section>



