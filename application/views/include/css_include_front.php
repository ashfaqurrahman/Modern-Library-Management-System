<!-- core CSS -->
<link href="<?php echo base_url();?>assets/css/bootstrap.min.css" rel="stylesheet">
 <link href="<?php echo base_url();?>bootstrap/css/datepicker.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/css/font-awesome.min.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/css/animate.min.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/css/main.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/css/custom.css" rel="stylesheet">
<!--[if lt IE 9]>
<script src="<?php echo base_url();?>assets/js/html5shiv.js"></script>
<script src="<?php echo base_url();?>assets/js/respond.min.js"></script>
<![endif]-->     
 
<!-- for RTL support -->
  <?php 
  // if($this->config->item('language')=="arabic") 
  if($this->is_rtl)  
  { ?>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-rtl/3.2.0-rc2/css/bootstrap-rtl.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>assets/css/rtl.css" rel="stylesheet" type="text/css" />       
  <?php
  }
  ?>