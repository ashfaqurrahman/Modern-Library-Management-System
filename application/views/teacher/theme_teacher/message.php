<?php 
	if($this->session->flashdata('success_message')==1)
	echo "<div class='alert alert-success text-center'><h4 style='margin:0;'><i class='fa fa-check-circle'></i> Your data has been successfully stored into the database. </h4></div>";
	
	if($this->session->flashdata('warning_message')==1)
	echo "<div class='alert alert-warning text-center'><h4 style='margin:0;'><i class='fa fa-warning'></i> Something went wrong, please try again. </h4></div>";

	if($this->session->flashdata('error_message')==1)
	echo "<div class='alert alert-danger text-center'><h4 style='margin:0;'><i class='fa fa-remove'></i> Your data has been failed to stored into the database. </h4></div>";
	
?>