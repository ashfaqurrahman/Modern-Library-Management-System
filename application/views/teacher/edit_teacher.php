
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
             <label class="col-sm-3 control-label">Father's Name *</label>
             <div class="col-sm-9 col-md-6 col-lg-6">
               <input  id="fathers_name"  class="form-control" type="text" value="<?php echo $teacher_info['father_name'];?>"   name="fathers_name">
               <span class="red"><?php echo form_error('fathers_name'); ?></span>
             </div>
           </div>

           <div class="form-group">
             <label class="col-sm-3 control-label">National ID No. </label>
             <div class="col-sm-9 col-md-6 col-lg-6">
               <input  id="national_id" name="national_id" class="form-control" value="<?php echo $teacher_info['national_id'];?>"  type="text"  >
               <span class="red"><?php echo form_error('national_id'); ?></span>
             </div>
           </div>


           <div class="form-group">
             <label class="col-sm-3 control-label">Date of Birth </label>
             <div class="col-sm-9 col-md-6 col-lg-6">
               <input id="dp" name="dob" class="form-control" type="text"  value="<?php echo date('d-m-Y',strtotime($teacher_info['date_of_birth']));?>" >
               <span class="red"><?php echo form_error('dob'); ?></span>
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