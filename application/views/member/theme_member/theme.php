<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title><?php echo $this->config->item('product_name')." | ".$page_title;?></title>
    <?php $this->load->view('include/css_include_back');?>
	  <?php $this->load->view('include/js_include_back');?>
    <link rel="shortcut icon" href="<?php echo base_url();?>assets/images/favicon.png"> 	
  </head>
  <body class="skin-blue sidebar-mini">
    <div class="wrapper">

      <?php $this->load->view('member/theme_member/header');?>

      <!-- for RTL support -->
      <?php 
      //if($this->config->item('language')=="arabic")  
      if($this->is_rtl) 
      { ?>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-rtl/3.2.0-rc2/css/bootstrap-rtl.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url();?>css/rtl.css" rel="stylesheet" type="text/css" />       
      <?php
      }
      ?>

      <!-- Left side column. contains the logo and sidebar -->
      <?php $this->load->view('member/theme_member/sidebar'); ?>

      <!-- Content Wrapper. Contains page content --> 
      <div class="content-wrapper">
  		<?php 
        if($crud==1) 
			$this->load->view('member/theme_member/theme_crud',$output); 
        else 
			$this->load->view($body);
      ?>  
      </div><!-- /.content-wrapper -->

      <!-- footer was here -->

      <!-- Control Sidebar -->
      <?php //$this->load->view('theme/control_sidebar');?>
      <!-- /.control-sidebar -->

      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>
    </div><!-- ./wrapper -->

    <!-- Footer -->
      <?php $this->load->view('member/theme_member/footer');?>
    <!-- Footer -->
  </body>
</html>
