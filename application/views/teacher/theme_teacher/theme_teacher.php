<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">    
    <title><?php echo $this->config->item('product_name')." | ".$page_title;?></title>
    <link rel="shortcut icon" href="<?php echo base_url()?>img/favicon.ico">
    <?php $this->load->view('include/css_include_back');?>
	  <?php $this->load->view('include/js_include_back');?>
    <link rel="shortcut icon" href="<?php echo base_url();?>assets/images/favicon.png"> 
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/clock_style.css">	
  </head>
  <body class="skin-blue sidebar-mini">
    <div class="wrapper">

      <?php $this->load->view('teacher/theme_teacher/header');?>

      <!-- Left side column. contains the logo and sidebar -->
      <?php $this->load->view('teacher/theme_teacher/sidebar'); ?>

      <!-- Content Wrapper. Contains page content --> 
      <div class="content-wrapper">
  		<?php 
        if($crud==1) 
			$this->load->view('teacher/theme_teacher/theme_crud',$output); 
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
      <?php $this->load->view('teacher/theme_teacher/footer');?>
    <!-- Footer -->
  </body>
</html>
