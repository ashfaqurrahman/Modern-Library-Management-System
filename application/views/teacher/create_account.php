<?php 
    
    if($this->session->userdata('logged_in')!=1)
    redirect('home/index','location');
 ?>
<section class="content-header">
   <section class="content">
     <div class="box box-info custom_box">
      
       <div class="box-header">
         <h3 class="box-title"><i class="fa fa-plus-circle"></i> Create Account</h3>
       </div><!-- /.box-header -->
              <!-- form start -->

         <form class="form-horizontal" enctype="multipart/form-data" action="<?php echo site_url().'teacher/create_account_action';?>" method="POST" >
          <div class="box-body"> 

          
           <div class="form-group">
             <label class="col-sm-3 control-label">User Name*</label>
             <div class="col-sm-9 col-md-6 col-lg-6">
               <input  id="username"  class="form-control" type="text"    name="username">
               <span class="red"><?php echo form_error('username'); ?></span>
             </div>
           </div>

           <div class="form-group">
             <label class="col-sm-3 control-label">Email* </label>
             <div class="col-sm-9 col-md-6 col-lg-6">
               <input  id="email" name="email" class="form-control"   type="text"  >
               <span class="red"><?php echo form_error('email'); ?></span>
             </div>
           </div> 


           <div class="form-group">
             <label class="col-sm-3 control-label">Password*</label>
             <div class="col-sm-9 col-md-6 col-lg-6">
               <input  id="password" name="password" class="form-control"   type="password"  >
               <span class="red"><?php echo form_error('password'); ?></span>
             </div>
           </div> 

            <div class="form-group">
             <label class="col-sm-3 control-label">Confirm Password*</label>
             <div class="col-sm-9 col-md-6 col-lg-6">
               <input  id="confirm_password" name="confirm_password" class="form-control"   type="password"  >
               <span class="red"><?php echo form_error('confirm_password'); ?></span>
             </div>
           </div>          
           
           </div>

         </div><!-- /.box-body --> 
         <div class="box-footer">
            <div class="form-group">
             <div class="col-sm-12 text-center">
               <input id="submit" type="submit" class="btn btn-warning btn-lg" value="Create Account"/>  
              
             </div>
           </div>                  
         </div><!-- /.box-footer -->         
         </div><!-- /.box-info -->   
        </form>         
     </div>
   </section>
</section>