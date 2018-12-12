<?php 
	$pdf = explode('/', $pdf_link);
	$pdf = array_pop($pdf);
	$pdf = trim($pdf);
	$link = base_url()."upload/e_books/viewer.html?file=".$pdf;
?>
<br>
<br>
<div class="row">
	<div class="col-xs-12 text-center">
		<a class="btn btn-lg btn-info" href="<?php echo $link; ?>">Please clik this button again to read pdf</a>
	</div>
</div>