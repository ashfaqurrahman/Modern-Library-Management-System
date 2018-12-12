<?php 
    
    if($this->session->userdata('logged_in')!=1)
    redirect('home/index','location');
 ?>
<section class="content-header">
   <section class="content">
     <?php
          if($this->session->flashdata('success_message')==1)
           $this->load->view('teacher/theme_teacher/message');
       ?>

     <div class="box box-info custom_box">      

       <div class="box-header">
         <h3 class="box-title"><i class="fa fa-plus-circle"></i>Manage Package</h3>
       </div><!-- /.box-header -->
              <!-- form start -->

         <form class="form-horizontal" enctype="multipart/form-data" action="<?php echo site_url().'teacher/manage_package_action';?>" method="POST" >
          <div class="box-body"> 


          <div class="form-group">
             <label class="col-sm-3 control-label">Name*</label>
             <div class="col-sm-9 col-md-6 col-lg-6">
               <input  id="name"  class="form-control" type="text"    name="name" value="<?php echo set_value('name');?>" >
               <span class="red"><?php echo form_error('name'); ?></span>
             </div>
           </div>

           <div class="form-group">
             <label class="col-sm-3 control-label">Domain Name*</label>
             <div class="col-sm-9 col-md-6 col-lg-6">
               <input  id="domain_name" name="domain_name" class="form-control"   type="text" value="<?php echo set_value('domain_name');?>"   >
               <span class="red"><?php echo form_error('domain_name'); ?></span>
             </div>
           </div> 


           <div class="form-group">
             <label class="col-sm-3 control-label">Domain Ragistration Date</label>
             <div class="col-sm-9 col-md-6 col-lg-6">
               <input  id="domain_reg_date" name="domain_reg_date" class="form-control datepicker1"   type="text" value="<?php echo set_value('domain_reg_date');?>"   >
               <span class="red"><?php echo form_error('domain_reg_date'); ?></span>
             </div>
           </div> 

            <div class="form-group">
             <label class="col-sm-3 control-label">Domain Expire Date*</label>
             <div class="col-sm-9 col-md-6 col-lg-6">
               <input  id="domain_exp_data" name="domain_exp_data" class="form-control datepicker1"   type="text" value="<?php echo set_value('domain_exp_data');?>"   >
               <span class="red"><?php echo form_error('domain_exp_data'); ?></span>
             </div>
           </div>         

          
           <div class="form-group">
             <label class="col-sm-3 control-label">Hosting Package*</label>
             <div class="col-sm-9 col-md-6 col-lg-6">
               <input  id="hosting_package"  class="form-control" type="text"    name="hosting_package" value="<?php echo set_value('hosting_package');?>" >
               <span class="red"><?php echo form_error('hosting_package'); ?></span>
             </div>
           </div>

           <div class="form-group">
             <label class="col-sm-3 control-label">Hosting Registration Date*</label>
             <div class="col-sm-9 col-md-6 col-lg-6">
               <input  id="hosting_reg_date" name="hosting_reg_date" class="form-control datepicker1"   type="text" value="<?php echo set_value('hosting_reg_date');?>"   >
               <span class="red"><?php echo form_error('hosting_reg_date'); ?></span>
             </div>
           </div> 


           <div class="form-group">
             <label class="col-sm-3 control-label">Hosting Expire Date*</label>
             <div class="col-sm-9 col-md-6 col-lg-6">
               <input  id="hosting_exp_date" name="hosting_exp_date" class="form-control datepicker1"   type="text"  value="<?php echo set_value('hosting_exp_date');?>"  >
               <span class="red"><?php echo form_error('hosting_exp_date'); ?></span>
             </div>
           </div> 

            <div class="form-group">
             <label class="col-sm-3 control-label">WP Username*</label>
             <div class="col-sm-9 col-md-6 col-lg-6">
               <input  id="wp_username" name="wp_username" class="form-control"   type="text" value="<?php echo set_value('wp_username');?>"   >
               <span class="red"><?php echo form_error('wp_username'); ?></span>
             </div>
           </div> 

           <div class="form-group">
             <label class="col-sm-3 control-label">WP Password*</label>
             <div class="col-sm-9 col-md-6 col-lg-6">
               <input  id="wp_password" name="wp_password" class="form-control"   type="text" value="<?php echo set_value('wp_password');?>"   >
               <span class="red"><?php echo form_error('wp_password'); ?></span>
             </div>
           </div>

             <div class="form-group">
             <label class="col-sm-3 control-label">C-Panel Username*</label>
             <div class="col-sm-9 col-md-6 col-lg-6">
               <input  id="cpanel_username" name="cpanel_username" class="form-control"   type="text" value="<?php echo set_value('cpanel_username');?>"   >
               <span class="red"><?php echo form_error('cpanel_username'); ?></span>
             </div>
           </div> 

           <div class="form-group">
             <label class="col-sm-3 control-label">C-Panel Password*</label>
             <div class="col-sm-9 col-md-6 col-lg-6">
               <input  id="cpanel_password" name="cpanel_password" class="form-control"   type="text"  value="<?php echo set_value('cpanel_password');?>"  >
               <span class="red"><?php echo form_error('cpanel_password'); ?></span>
             </div>
           </div>  

           <div class="form-group">
             <label class="col-sm-3 control-label">DNS*</label>
             <div class="col-sm-9 col-md-6 col-lg-6">
               <input  id="dns" name="dns" class="form-control"   type="text"  value="<?php echo set_value('dns');?>"  >
               <span class="red"><?php echo form_error('dns'); ?></span>
             </div>
           </div> 

            <div class="form-group">
             <label class="col-sm-3 control-label">Mobile No.*</label>
             <div class="col-sm-9 col-md-6 col-lg-6">
               <input  id="mobile" name="mobile" class="form-control"   type="text" value="<?php echo set_value('mobile');?>"   >
               <span class="red"><?php echo form_error('mobile'); ?></span>
             </div>
           </div>  

           <div class="form-group">
             <label class="col-sm-3 control-label">Email*</label>
             <div class="col-sm-9 col-md-6 col-lg-6">
               <input  id="email" name="email" class="form-control"   type="text"  value="<?php echo set_value('email');?>"  >
               <span class="red"><?php echo form_error('email'); ?></span>
             </div>
           </div>  

           <div class="form-group">
             <label class="col-sm-3 control-label">Amount*</label>
             <div class="col-sm-9 col-md-6 col-lg-6">
               <input  id="amount" name="amount" class="form-control"   type="text"  value="<?php echo set_value('amount');?>"  >
               <span class="red"><?php echo form_error('amount'); ?></span>
             </div>
           </div> 
           
           
           </div>

         </div><!-- /.box-body --> 
         <div class="box-footer">
            <div class="form-group">
             <div class="col-sm-12 text-center">
               <input id="submit" type="submit" class="btn btn-warning btn-lg" value="Save Data"/>  
              
             </div>
           </div>                  
         </div><!-- /.box-footer -->         
         </div><!-- /.box-info -->   
        </form>         
     </div>
   </section>
</section>

<script>
$j("document").ready(function(){
  
   $('.datepicker1').datepicker({format: "dd/mm/yyyy"});    
  
});
</script>

