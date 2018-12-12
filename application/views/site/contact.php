<br/>
<?php
if($this->session->flashdata('mail_sent')==1)
{
	echo "<div class='text-center alert alert-success'>".$this->lang->line("we have received your email. we will contact you through email as soon as possible")."</div>";
} 
?>

<style>
	.red p{display:inline !important;}
</style>
<div class="container-fluid">
  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
        <div class="row">
            <div class="col-xs-12 grid">
              <div class="border_gray grid_content content_grid">
                <h4 class="column-title"><i class="fa fa-send blue"> </i> <span class="blue"><?php echo $this->lang->line("send email"); ?></span></h4>                 
	                <form role="form" method="POST" action="<?php echo site_url('home/email_contact'); ?>">
						<div class="row" style="margin-top:0;padding-top:0;">
							<div class="col-xs-12"><b class='blue'><?php echo $this->lang->line("email"); ?> *</b> </div>
						</div>
						<div class="row">
							<div class="col-xs-12">
								<div class="form-group">
									<input type="text" value="<?php echo set_value('email'); ?>" name="email" id="email" class="form-control input-lg" placeholder="<?php echo $this->lang->line("email"); ?> *">
								</div>
							</div>
						</div>
						<div class="row" style="margin-top:0;padding-top:0;">
							<div class="col-xs-12">
								<span class="red">
									<?php echo form_error('email'); ?>
								</span>
							</div>
						</div>
						<br/>

						<div class="row" style="margin-top:0;padding-top:0;">
							<div class="col-xs-12"><b class='blue'><?php echo $this->lang->line("message subject"); ?> *</b> </div>
						</div>
						<div class="row">
							<div class="col-xs-12">
								<div class="form-group">
									<input type="text" value="<?php echo set_value('subject'); ?>" name="subject" id="subject" class="form-control input-lg" placeholder="<?php echo $this->lang->line("message subject"); ?> *">
								</div>
							</div>
						</div>
						<div class="row" style="margin-top:0;padding-top:0;">
							<div class="col-xs-12">
								<span class="red">
									<?php echo form_error('subject'); ?>
								</span>
							</div>
						</div>
						<br/>

						<div class="row" style="margin-top:0;padding-top:0;">
							<div class="col-xs-12"><b class='blue'><?php echo $this->lang->line("message"); ?> *</b> </div>
						</div>
						<div class="row">
							<div class="col-xs-12">
								<div class="form-group">
									<textarea name="message" placeholder="<?php echo $this->lang->line("message"); ?>" class="form-control input-lg" id="message"><?php echo set_value('message'); ?></textarea>
								</div>
							</div>
						</div>
						<div class="row" style="margin-top:0;padding-top:0;">
							<div class="col-xs-12">
								<span class="red">
									<?php echo form_error('message'); ?>
								</span>
							</div>
						</div>


						<div class="row">
							<div class="col-xs-12"><input type="submit" value="<?php echo $this->lang->line("send email"); ?>" class="btn btn-primary btn-block btn-lg" ></div>
						</div>
					</form>
              </div>
            </div>
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
    	<div class="row">
            <div class="col-xs-12 grid">
              <div class="border_gray grid_content content_grid"  style="min-height:430px;">
                <h4 class="column-title"><i class="fa fa-home blue"> </i> <span class="blue">Contact Us</span></h4>
                <div class="row"><div class="col-xs-12"><img style="display:block;" src="<?php echo base_url();?>assets/images/logo.png" alt="<?php echo $this->config->item('product_name');?>" class="contact_logo img-responsive"></div></div>
   			    <div class="row">
   			    	<div class="col-xs-12">
	   			    	<br/><br/>
	   			    	<h4><i class="fa fa-home"></i> <?php echo $this->config->item("institute_address1"); ?> </h4>
		                <h4><i class="fa fa-map-marker"></i> <?php echo $this->config->item("institute_address2"); ?> </h4>
		                <h4><i class="fa fa-phone"></i> <?php echo $this->config->item("institute_mobile"); ?> </h4>
		                <h4 class="email"><i class="fa fa-envelope"></i> <?php echo $this->config->item("institute_email"); ?> </h4>
   			    	</div>
   			    </div>
              </div>
            </div>
        </div>
    </div>

  </div> <!-- end column middle area -->
</div> <!-- end container main content -->




<div class="modal fade" id="t_and_c_m" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title" id="myModalLabel">Terms & Conditions</h4>
			</div>
			<div class="modal-body">
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Similique, itaque, modi, aliquam nostrum at sapiente consequuntur natus odio reiciendis perferendis rem nisi tempore possimus ipsa porro delectus quidem dolorem ad.</p>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Similique, itaque, modi, aliquam nostrum at sapiente consequuntur natus odio reiciendis perferendis rem nisi tempore possimus ipsa porro delectus quidem dolorem ad.</p>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Similique, itaque, modi, aliquam nostrum at sapiente consequuntur natus odio reiciendis perferendis rem nisi tempore possimus ipsa porro delectus quidem dolorem ad.</p>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Similique, itaque, modi, aliquam nostrum at sapiente consequuntur natus odio reiciendis perferendis rem nisi tempore possimus ipsa porro delectus quidem dolorem ad.</p>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Similique, itaque, modi, aliquam nostrum at sapiente consequuntur natus odio reiciendis perferendis rem nisi tempore possimus ipsa porro delectus quidem dolorem ad.</p>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Similique, itaque, modi, aliquam nostrum at sapiente consequuntur natus odio reiciendis perferendis rem nisi tempore possimus ipsa porro delectus quidem dolorem ad.</p>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Similique, itaque, modi, aliquam nostrum at sapiente consequuntur natus odio reiciendis perferendis rem nisi tempore possimus ipsa porro delectus quidem dolorem ad.</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" data-dismiss="modal">I Agree</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
