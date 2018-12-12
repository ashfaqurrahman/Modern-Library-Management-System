	
<section>				
	<div class="section-header">
		<h2 class="section-title text-center blue">
			<i class="fa fa-refresh fa-2x blue"> Renew Package</i> <?php echo "<br/>".$info[0]['name']; ?>
		</h2>
	</div>
</section>
<br/>	
<br/>	
<div class="container-fluid">
	<form method = "POST" action = "<?php echo site_url().'teacher/renew_package_action';?>">
		<input name = "id"  value = "<?php echo $info[0]['id']; ?>" style = "display:none" type = "text"/>
		<input name = "hosting_previous"  value = "<?php echo $info[0]['hosting_expire_date']; ?>" style = "display:none" type = "text"/>
		<input name = "domain_previous"  value = "<?php echo $info[0]['domain_expire_date']; ?>" style = "display:none" type = "text"/>
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-5 col-md-offset-1 col-lg-5 col-lg-offset-1 padded background_white border_gray" style = "height:250px">				
				<span class="no_list_style text-justify"><h6 class="column-title"><i class="fa fa-server fa-2x blue"> Renew Hosting Package</i></h6></span>	
				<div class="form-group">
				<label for="sel1" class="blue">Select Duration</label>
					<select class="form-control" id="sel1" name = "hosting_renew">
						<option value="">-Select-</option>
						<option value="1">1 Year</option>
						<option value="2">2 Year</option>
						<option value="3">3 Year</option>
						<option value="4">4 Year</option>
						<option value="5">5 Year</option>
					</select>
					<div class="form-group">
					<label for="usr" class = "blue">Amount</label>
						<input type="number" class="form-control" id="hosting_amount" name="hosting_amount">
					</div>
				</div>			
			</div>


			<div class="col-xs-12 col-sm-12 col-md-5 col-lg-5 padded how_it_works background_white border_gray text-justify" style = "height:250px">						
				<span class="no_list_style"><h6 class="column-title"><i class="fa fa-file-code-o fa-2x blue"> Renew Domain Name</i></h6></span>
				<div class="form-group">
				<label for="sel2" class="blue">Select Duration</label>
					<select class="form-control" id="sel2" name = "domain_renew">
						<option value="">-Select-</option>
						<option value="1">1 Year</option>
						<option value="2">2 Year</option>
						<option value="3">3 Year</option>
						<option value="4">4 Year</option>
						<option value="5">5 Year</option>
					</select>
					<div class="form-group">
					<label for="usr" class = "blue">Amount</label>
						<input type="number" class="form-control" id="domain_amount" name="domain_amount">
					</div>
				</div>
			</div>

		</div>
		<br/><center><input type = "submit" name = "submit" id = "submit" value = "submit" class = "btn btn-info row-centered col-centered"/></center>
	</form>
</div>
