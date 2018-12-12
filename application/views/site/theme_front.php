<?php $this->load->view("site/header"); ?>

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

<?php $this->load->view($body); ?>
<?php $this->load->view("site/footer"); ?> 

<script type="text/javascript">
	$("document").ready(function(){
		$(".before_flip").hover(
			function(){

				$(".flip_overlay").css("display","none");
				if($(this).next().css("display")!="block")
					$(this).next().slideDown("slow");
			},

			function(){				
				if(!$(this).is(':hover'))
				{
					$(this).next().slideUp("slow");
				}	
			}

			);	
	    });

	var body = document.body,
    timer;

	window.addEventListener('scroll', function() {
	  clearTimeout(timer);
	  if(!body.classList.contains('disable-hover')) {
	    body.classList.add('disable-hover')
	  }
	  
	  timer = setTimeout(function(){
	    body.classList.remove('disable-hover')
	  },300);
	}, false)
</script>
