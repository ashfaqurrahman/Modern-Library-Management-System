<?php 
    
    if($this->session->userdata('logged_in')!=1)
    redirect('home/index','location');
 ?>
 <section class="content-header">
  <section class="content">
  <?php $this->load->view('admin/theme/message'); ?>

    <div class="box box-info custom_box">

      <div class="box-header">      
        <h3 class="box-title">
          <i class="fa fa-plus-circle">         	
          </i>
          Accounts
        </h3>
      </div>
     <div class="box-body background_white">
       <table style='width:100%'class='table table-bordered table-hover table-stripped'>
          <tr>            
            <th class='text-left'>SL</th>
            <th class='text-left'>Name</th>
            <th class='text-left'>Email</th>					
          </tr>
          <?php 

          	foreach ($info as $value)
          	 {
          	 	echo "<tr>";
          		echo "<td>".$value['id']."</td.>";
          		echo "<td>".$value['username']."</td.>";
          		echo "<td>".$value['email']."</td.>";
          		echo "</tr>";		
          	}


           ?>

      </table><br/>
    <?php echo $links; ?>
    </div>    

    </div>
    <span class= "pull-right"> <a class="btn btn-warning"  title="Add Teacher" href="<?php echo site_url('teacher/create_account');?>">
    <i class="fa fa-plus-circle"></i>Create Account</a></span>
  </section>
</section>