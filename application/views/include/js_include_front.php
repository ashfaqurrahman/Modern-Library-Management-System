<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.js"></script>
<!-- end of for modal effect -->
<script type="text/javascript" src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>bootstrap/js/bootstrap-datepicker.js"></script>


<script src="<?php echo base_url();?>plugins/xregexp/xregexp.js" type="text/javascript"></script>

<?php if($this->is_rtl){ ?>

<script type="text/javascript">

$('document').ready(function() {
	$('*').each(function() {	
	   if(!isRTL($(this).text())){
	      $(this).not("input").addClass('ltr');
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

