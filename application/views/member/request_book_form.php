<section class="content-header">
	<section class="content">
		<div class="box box-info custom_box">
			<div class="box-header">
				<h3 class="box-title"><i class="fa fa-plus-circle"></i> <?php echo $this->lang->line("request new book"); ?></h3>
			</div><!-- /.box-header -->
			<!-- form start -->
			<form class="form-horizontal" action="<?php echo site_url().'member/request_book_form_action'?>" enctype="multipart/form-data" method="POST">
				<div class="box-body">


					<div class="form-group">
						<label class="col-sm-3 control-label" for="name"><?php echo $this->lang->line("title"); ?>  *
						</label>
						<div class="col-sm-9 col-md-6 col-lg-6">
							<input name="book_title" value="<?php if(isset($info['book_title'])) echo $info['book_title'];?>"  class="form-control" type="text-area">		          
							<span class="red"><?php echo form_error('book_title'); ?></span>
						</div>
					</div> 

						      

					<div class="form-group">
						<label class="col-sm-3 control-label" for="name"><?php echo $this->lang->line("author"); ?> *
						</label>
						<div class="col-sm-9 col-md-6 col-lg-6">
							<input name="author" value="<?php if(isset($info['author'])) echo $info['author'];?>"  class="form-control" type="text">		               
							<span class="red"><?php echo form_error('author'); ?></span>
						</div>
					</div>		


					<div class="form-group">
						<label class="col-sm-3 control-label" for="name"><?php echo $this->lang->line("edition"); ?>  *
						</label>
						<div class="col-sm-9 col-md-6 col-lg-6">
							<input name="edition" value="<?php if(isset($info['edition'])) echo $info['edition']?>"  class="form-control" type="text-area">		          
							<span class="red"><?php echo form_error('edition'); ?></span>
						</div>
					</div>
		             	
					<div class="form-group">
						<label class="col-sm-3 control-label" for="name"><?php echo $this->lang->line("notes"); ?> *
						</label>
						<div class="col-sm-9 col-md-6 col-lg-6">
							<input name="note" value="<?php if(isset($info['note'])) echo $info['note']?>"  class="form-control" type="text-area">		          
							<span class="red"><?php echo form_error('note'); ?></span>
						</div>
					</div> 


		             </div> <!-- /.box-body --> 
		             <div class="box-footer">
		             	<div class="form-group">
		             		<div class="col-sm-12 text-center">
		             			<input name="submit" type="submit" class="btn btn-warning btn-lg" value="<?php echo $this->lang->line("save"); ?>"/>  
		             			<input type="button" class="btn btn-default btn-lg" value="<?php echo $this->lang->line("cancel"); ?>" onclick='goBack("member/requested_books",0)'/>  
		             		</div>
		             	</div>
		             </div><!-- /.box-footer -->         
		         </div><!-- /.box-info -->       
		     </form>     
		 </div>
		</section>
	</section>




