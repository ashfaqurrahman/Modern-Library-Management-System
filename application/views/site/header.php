<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $this->config->item('product_name')." | ".$page_title;?></title>      
    <link rel="shortcut icon" href="<?php echo base_url();?>assets/images/favicon.png"/>    
    <link href="<?php echo base_url();?>assets/css/bootstrap.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/css/bootstrap-theme.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/css/animate.min.css" rel="stylesheet">
    <!-- custom css -->    
    <link href="<?php echo base_url();?>assets/css/site/style.css" rel="stylesheet">    
    <link href="<?php echo base_url();?>assets/css/site/sidemenu.css" rel="stylesheet"> 
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	

<!--This is for RTL support-->
<script src="<?php echo base_url();?>plugins/xregexp/xregexp.js" type="text/javascript"></script>

<?php if($this->is_rtl){ ?>

<script type="text/javascript">

$('document').ready(function() {
$('*').each(function() {	
   if(!isRTL($(this).text())){
	$(this).not("input,textarea").addClass('ltr');
	}
});
});


function isInt(value) {

   var er = /^-?[0-9]+$/;

   return er.test(value);
}


function isRTL(str) {

   var isArabic = XRegExp('[\\p{Arabic}]');
   var partArabic = 0;
   var rtlIndex = 0;

/**This for check if any of the text is numberic then don't make it RTL***/
var is_int=0;

   var isRTL = false;

   for(i=0;i<str.length;i++){
       if(isArabic.test(str[i]))
           partArabic++;

if(isInt(str[i])){
is_int=1;
}

   }

/**if any character is arabic and also check if no integer there , then it is RTL**/
   if(partArabic > 0 && is_int==0) {
       isRTL = true;
   }
   return isRTL;
}

</script>

<?php  } ?>


<!--End of rtl support code-->
	
	
	
	
	
</head>
<body>
<div class="container-fluid header_container">
  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
      <h1><a <?php if($this->is_rtl) echo "style='float:right;margin-bottom:20px;'";?> href="<?php echo site_url(); ?>"><img src="<?php echo base_url();?>assets/images/logo.png" alt="<?php echo $this->config->item('product_name');?>" class="img-responsive"></a></h1>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
        <!-- <div class="form-group">
            <label id="language_label">Language</label>               
              <?php 
              $select_lan="english";
              if($this->session->userdata("selected_language")=="") $select_lan=$this->config->item("language");
              else $select_lan=$this->session->userdata("selected_language");
              echo form_dropdown('language',$language_info,$select_lan,'class="form-control" id="language_change"');  ?>              
              <span class="red"><?php echo form_error('language'); ?></span>           
         </div>  -->
    </div>


  </div> <!-- end row title -->
  <div class="row">
    <div class="col-md-12 no_padding">
      <nav class="navbar navbar-default">
        <div class="container-fluid">
          <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#"><img style="height:20px;" src="<?php echo base_url();?>assets/images/logo.png" class="logo"></a>
          </div>
          <?php $current=$this->uri->segment(2); ?>
          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
              <li <?php if($current=="" || $current=="index") echo "class='active'"; ?>><a href="<?php echo site_url('home');?>"><?php echo $this->lang->line("home"); ?></a></li>
              <li <?php if($current=="book") echo "class='active'"; ?>><a href="<?php echo site_url('home/book');?>"><?php echo $this->lang->line("books"); ?></a></li>
              <li <?php if($current=="contact" || $current=="email_contact") echo "class='active'"; ?>><a href="<?php echo site_url('home/contact');?>"><?php echo $this->lang->line("contact us"); ?></a></li>

          
                  
                  
             

              <li <?php if($this->session->userdata('logged_in') !=1){            

                    if($current=="registration" || $current=="registration_action") echo "class='active'"; ?>><a href="<?php echo site_url();?>home/registration"><?php echo $this->lang->line("registration");} ?></a></li>

              <li><a  href="<?php echo site_url();?>home/login"><?php echo $this->lang->line("login"); ?></a></li>
            </ul>
          </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
      </nav>
    </div>
  </div> <!-- end row navbar -->
</div> <!-- end container header -->




<script type="text/javascript">
  $(document).ready(function() {
    $("#language_change").change(function(){
      var language=$(this).val();
      $("#language_label").html("Loading Language...");
      $.ajax({
        url: '<?php echo site_url("home/language_changer");?>',
        type: 'POST',
        data: {language:language},
        success:function(response){
            $("#language_label").html("Language");
            location.reload(); 
        }
      })
      
    });
  });
</script>