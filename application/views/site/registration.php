<br/>
<?php
if($this->session->flashdata('registration_success')==1)
{
	echo "<div class='text-center alert alert-success'>".$this->lang->line("your registration is successfull but one more step to go. you will be notified through email when admin approves you")."</div>";
} 
?>

<style>
	.red p{display:inline !important;}
</style>
<div class="container-fluid">
  <div class="row row-centered">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-centered">
        <div class="row row-centered">
            <div class="col-xs-12 grid col-centered">
              <div class="border_gray grid_content content_grid">
                <h4 class="column-title in_center"><i class="fa fa-pencil blue"> </i> <span class="blue"><?php echo $this->config->item('product_name');?> <?php echo $this->lang->line("registration"); ?></span></h4>                 
	                <form role="form" method="POST" action="<?php echo site_url('home/registration_action'); ?>">
						<div class="row" style="margin-top:0;padding-top:0;">
							<div class="col-xs-12 col-sm-6 col-sm-offset-3 col-md-6 col-sm-offset-3"><b class='blue'><?php echo $this->lang->line("name"); ?> *</b> </div>
						</div>
						<div class="row">
							<div class="col-xs-12 col-sm-6 col-md-3 col-md-offset-3">
								<div class="form-group">
									<input type="text" value="<?php echo set_value('first_name'); ?>" name="first_name" id="first_name" class="form-control input-lg" placeholder="<?php echo $this->lang->line("first name"); ?> *">
								</div>
							</div>
							<div class="col-xs-12 col-sm-6 col-md-3">
								<div class="form-group">
									<input type="text" value="<?php echo set_value('last_name'); ?>" name="last_name" id="last_name" class="form-control input-lg" placeholder="<?php echo $this->lang->line("last name"); ?> *">
								</div>
							</div>
						</div>
						<div class="row" style="margin-top:0;padding-top:0;">
							<div class="col-xs-12 col-sm-6 col-sm-offset-3 col-md-6 col-sm-offset-3">
								<span class="red">
									<?php echo form_error('first_name'); ?>
									<?php if(form_error('first_name') && form_error('last_name')) echo " &amp; "; echo form_error('last_name'); ?>
								</span>
							</div>
						</div>

						<div class="row" style="margin-top:0;padding-top:0;">
							<div class="col-xs-12 col-sm-6 col-md-3 col-sm-offset-3"><b class='blue'><?php echo $this->lang->line("member id"); ?> *</b> </div>
							<div class="col-xs-12 col-sm-6 col-md-3"><b class='blue'><?php echo $this->lang->line("mobile"); ?> *</b> </div>
						</div>
						<div class="row">
							<div class="col-xs-12 col-sm-6 col-md-3 col-sm-offset-3">
								<div class="form-group">
									<input type="text" value="<?php echo set_value('member_id'); ?>" name="member_id" id="member_id" class="form-control input-lg" placeholder="<?php echo $this->lang->line("member id"); ?> *">
								</div>
							</div>
							<div class="col-xs-12 col-sm-6 col-md-3">
								<div class="form-group">
									<input type="text" value="<?php echo set_value('mobile'); ?>" name="mobile" id="mobile" class="form-control input-lg" placeholder="<?php echo $this->lang->line("mobile"); ?> - <?php echo $this->lang->line("with country code"); ?> *">
								</div>
							</div>
						</div>
						<div class="row" style="margin-top:0;padding-top:0;">
							<div class="col-xs-12 col-sm-6 col-md-3 col-sm-offset-3">
								<span class="red">
									<?php echo form_error('member_id'); ?>
								</span>
							</div>
							<div class="col-xs-12 col-sm-6 col-md-3">
								<span class="red">
									<?php echo form_error('mobile'); ?>
								</span>
							</div>
						</div>


						<div class="row" style="margin-top:0;padding-top:0;">
							<div class="col-xs-12 col-sm-6 col-sm-offset-3 col-md-6 col-sm-offset-3"><b class='blue'><?php echo $this->lang->line("email"); ?> - <?php echo $this->lang->line("will be used as username"); ?></b> </div>
						</div>
						<div class="row">
							<div class="col-xs-12 col-sm-6 col-sm-offset-3 col-md-6 col-sm-offset-3">
								<div class="form-group">
									<input type="email" value="<?php echo set_value('email'); ?>" name="email" id="email" class="form-control input-lg" placeholder="<?php echo $this->lang->line("email"); ?> *">
								</div>
							</div>
						</div>
						<div class="row" style="margin-top:0;padding-top:0;">
							<div class="col-xs-12 col-sm-6 col-sm-offset-3 col-md-6 col-sm-offset-3">
								<span class="red">
									<?php echo form_error('email'); ?>
								</span>
							</div>
						</div>
						
						<div class="row" style="margin-top:0;padding-top:0;">
							<div class="col-xs-12 col-sm-6 col-sm-offset-3 col-md-6 col-sm-offset-3"><b class='blue'><?php echo $this->lang->line("password"); ?> *</b> </div>
						</div>
						<div class="row">
							<div class="col-xs-12 col-sm-6 col-md-3 col-md-offset-3">
								<div class="form-group">
									<input type="password" name="password" id="password" class="form-control input-lg" placeholder="<?php echo $this->lang->line("password"); ?> *" >
								</div>
							</div>
							<div class="col-xs-12 col-sm-6 col-md-3">
								<div class="form-group">
									<input type="password" name="password_confirmation" id="password_confirmation" class="form-control input-lg" placeholder="<?php echo $this->lang->line("confirm password"); ?> *" tabindex="6">
								</div>
							</div>
						</div>
						<div class="row" style="margin-top:0;padding-top:0;">
							<div class="col-xs-12 col-sm-6 col-sm-offset-3 col-md-6 col-sm-offset-3">
								<span class="red">
									<?php echo form_error('password'); ?>
									<?php if(form_error('password') && form_error('password_confirmation')) echo "&amp; "; echo form_error('password_confirmation'); ?>
								</span>
							</div>
						</div>

						<div class="row" style="margin-top:0;padding-top:0;">
							<div class="col-xs-12 col-sm-6 col-sm-offset-3 col-md-6 col-sm-offset-3"><b class='blue'><?php echo $this->lang->line("user type"); ?> * </b> </div>
						</div>
						<div class="row">
							<div class="col-xs-12 col-sm-6 col-sm-offset-3  col-md-6 col-md-offset-3">
								<div class="form-group">
									<?php 
					                  $user_type['']=$this->lang->line("user type"); 
					                  echo form_dropdown('user_type',$user_type,set_value('user_type'),'class="form-control"'); 
					                ?>
								</div>
							</div>
						</div>
						<div class="row" style="margin-top:0;padding-top:0;">
							<div class="col-xs-12 col-sm-6 col-sm-offset-3 col-md-6 col-sm-offset-3">
								<span class="red">
									<?php echo form_error('user_type'); ?>
								</span>
							</div>
						</div>

						<div class="row" style="margin-top:0;padding-top:0;">
							<div class="col-xs-12 col-sm-6 col-sm-offset-3 col-md-6 col-sm-offset-3"><b class='blue'><?php echo $this->lang->line("address"); ?> </b> </div>
						</div>
						<div class="row">
							<div class="col-xs-12 col-sm-6 col-sm-offset-3  col-md-6 col-md-offset-3">
								<div class="form-group">
									<input type="text" value="<?php echo set_value('address'); ?>" name="address" id="address" class="form-control input-lg" placeholder="<?php echo $this->lang->line("address"); ?>">
								</div>
							</div>
						</div>

						<div class="row" style="margin-top:0;padding-top:0;">
							<div class="col-xs-12 col-sm-6 col-sm-offset-3 col-md-6 col-sm-offset-3">
								<span class="red">
									<?php echo form_error('address'); ?>
								</span>
							</div>
						</div><br/>

						<div class="row">
							<div class="col-xs-12 col-sm-6 col-sm-offset-3  col-md-6 col-md-offset-3 text-center">
								<!-- By clicking <strong class="label label-primary">Register</strong>, you agree to the <a href="#" data-toggle="modal" data-target="#t_and_c_m">Terms and Conditions</a> set out by this site, including our Cookie Use. -->
								<a href="#" data-toggle="modal" data-target="#t_and_c_m"><?php echo $this->lang->line("by clicking register, you agree to the terms and conditions set out by this site"); ?></a>
							</div>
						</div>
						<br/>
						<div class="row">
							<div class="col-xs-12 col-sm-6 col-sm-offset-3  col-md-6 col-md-offset-3"><input type="submit" value="<?php echo $this->lang->line("register");?>" class="btn btn-primary btn-block btn-lg" tabindex="7"></div>
						</div>
					</form>
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
				<h4 class="modal-title" id="myModalLabel"><?php echo $this->lang->line("terms and conditions");?></h4>
			</div>
			<div class="modal-body">
				<?php echo $condition[0]['terms_and_condition']; ?>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" data-dismiss="modal"><?php echo $this->lang->line("i agree");?></button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
