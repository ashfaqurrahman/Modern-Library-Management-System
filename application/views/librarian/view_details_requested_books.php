

<style >
	.own{
		height:40px;padding-top: 8px;border: 0px solid #000000; background: rgba(255,255,255,1);background: -moz-linear-gradient(top, rgba(255,255,255,1) 0%, rgba(255,255,255,1) 17%, rgba(246,246,246,1) 43%, rgba(239,239,239,1) 89%, rgba(237,237,237,1) 100%);
		background: -webkit-gradient(left top, left bottom, color-stop(0%, rgba(255,255,255,1)), color-stop(17%, rgba(255,255,255,1)), color-stop(43%, rgba(246,246,246,1)), color-stop(89%, rgba(239,239,239,1)), color-stop(100%, rgba(237,237,237,1)));
		background: -webkit-linear-gradient(top, rgba(255,255,255,1) 0%, rgba(255,255,255,1) 17%, rgba(246,246,246,1) 43%, rgba(239,239,239,1) 89%, rgba(237,237,237,1) 100%);
		background: -o-linear-gradient(top, rgba(255,255,255,1) 0%, rgba(255,255,255,1) 17%, rgba(246,246,246,1) 43%, rgba(239,239,239,1) 89%, rgba(237,237,237,1) 100%);
		background: -ms-linear-gradient(top, rgba(255,255,255,1) 0%, rgba(255,255,255,1) 17%, rgba(246,246,246,1) 43%, rgba(239,239,239,1) 89%, rgba(237,237,237,1) 100%);
		background: linear-gradient(to bottom, rgba(255,255,255,1) 0%, rgba(255,255,255,1) 17%, rgba(246,246,246,1) 43%, rgba(239,239,239,1) 89%, rgba(237,237,237,1) 100%);
		filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ffffff', endColorstr='#ededed', GradientType=0 );

	}
</style>


<div class="container-fluid">
	<div class="row">
		<div class="col-xs-12 own">
			<center><strong class="text-info" style="font-family:'Cooper Black'; font-size:20px"><i class="fa fa-user"></i>Book Details</strong></center>
		</div>
	</div>
	<br/>
	<!-- setting variables -->
	<div class="row">

		<!-- <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12 text-center">
		    <?php if($info[0]['image']=='' && $info[0]['gender']=="Male") $image=base_url('assets/images/avatar/boy.png'); 
			else if($info[0]['image']=='' && $info[0]['gender']=="Female") $image=base_url('assets/images/avatar/girl.png');
			else $image=base_url('upload/student').'/'.$info[0]['image']; ?>
			<img class="img img-thumbnail" style="width:250px; height:275px" src="<?php echo $image; ?>">
			<h3 class="text-center" style="font-family:'Cooper Black'"><?php if(isset($info[0]['name'])) echo "{$info[0]['name']}"; ?></h3>
			<h4 class="text-center gray">Student ID: <?php if(isset($info[0]['student_id'])) echo "{$info[0]['student_id']}"; ?></h4>
		</div> -->

		<div class="col-md-9 col-lg-9 col-sm-12 col-xs-12">

			<div>

				<!-- Nav tabs -->
				<ul class="nav nav-tabs" role="tablist">
					<li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab"><i class="fa fa-th-large"></i> Basic Info</a></li>
					<li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab"><i class="fa fa-graduation-cap"></i> Gurdian Info</a></li>
					<li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab"><i class="fa fa-user-plus"></i> Academic Info</a></li>

				</ul>

				<!--tab one -->

				<div class="tab-content">
					<div role="tabpanel" class="tab-pane active" id="home">

						<div class="row">

							<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
								<blockquote>
									<p><i class="fa fa-user"></i> id</p>
									<footer><?php if(isset($info[0]['id'])) echo "{$info[0]['id']}"; ?></footer>
								</blockquote>
							</div>

							<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
								<blockquote>
									<p><i class="fa fa-user"></i> Member ID</p>
									<footer><?php if(isset($info[0]['member_id'])) echo "{$info[0]['member_id']}"; ?></footer>
								</blockquote>
							</div>

							<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
								<blockquote>
									<p><i class="fa fa-user"></i> Book Title</p>
									<footer><?php if(isset($info[0]['book_title'])) echo "{$info[0]['book_title']}"; ?></footer>
								</blockquote>
							</div>
						</div>

						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
								<blockquote>
									<p><i class="fa fa-male"></i> Author</p>
									<footer><?php if(isset($info[0]['author'])) echo "{$info[0]['author']}"; ?></footer>
								</blockquote>
							</div>

							<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
								<blockquote>
									<p><i class="fa fa-male"></i> edition</p>
									<footer><?php if(isset($info[0]['edition']))  echo "{$info[0]['edition']}"; ?></footer>
								</blockquote>
							</div>
						</div>

						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
								<blockquote>
									<p><i class="fa fa-female"></i> note form </p>
									<footer><?php if(isset($info[0]['note'])) echo "{$info[0]['note']}"; ?></footer>
								</blockquote>
							</div>

							<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
								<blockquote>
									<p><i class="fa fa-female"></i> date Year</p>
									<footer><?php  if(isset($info[0]['date'])) echo "{$info[0]['date']}"; ?></footer>
								</blockquote>
							</div>
						</div>

						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
								<blockquote>
									<p><i class="fa fa-envelope"></i> reply No.</p>
									<footer><?php if(isset($info[0]['reply'])) echo "{$info[0]['reply']}"; ?></footer>
								</blockquote>
							</div>

							<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
								<blockquote>
									<p><i class="fa fa-mobile-phone"></i> Category</p>
									<footer><?php if(isset($info[0]['status'])) echo "{$info[0]['status']}"; ?></footer>								
								</blockquote>
							</div>
							
						</div> <!-- end row -->
					</div>	<!-- end tab panel -->					

					<!-- tab one close -->

					<!-- tab 2 start -->

					<div role="tabpanel" class="tab-pane" id="profile">						

						<div class="row">

							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
								<blockquote>
									<p><i class="fa fa-user"></i> Series</p>
									<footer><?php if(isset($info[0]['series'])) echo "{$info[0]['series']}"; ?></footer>
								</blockquote>
							</div>

							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
								<blockquote>
									<p><i class="fa fa-chain"></i> size</p>
									<footer><?php  if(isset($info[0]['size'])) echo "{$info[0]['size']}"; ?></footer>
								</blockquote>
							</div>

							<!-- <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
								<blockquote>
									<p><i class="fa fa-anchor"></i> Present Address</p>
									<footer>

										<?php 
										if (isset($info[0]['gurdian_present_village']) && isset($info[0]['gurdian_present_post'])
											&& isset($info[0]['gurdian_present_thana_name']) && isset($info[0]['gurdian_present_district_name']))
										{
											echo
											"{$info[0]['gurdian_present_village']}".
											", ".
											"{$info[0]['gurdian_present_post']}".
											", ".
											"{$info[0]['gurdian_present_thana_name']}".
											", ".
											"{$info[0]['gurdian_present_district_name']}"
											; 
										}										 
										?>

									</footer>
								</blockquote>
							</div> -->

							<!-- <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
								<blockquote>
									<p>
										<i class="fa fa-home">											
										</i>
										 Permanent Address
									</p>
									<footer>
										<?php
										if (isset($info[0]['gurdian_permanent_village']) && isset($info[0]['gurdian_permanent_post'])
											&& isset($info[0]['gurdian_permanent_thana_name']) && isset($info[0]['gurdian_permanent_district_name']))
										{
											echo
											"{$info[0]['gurdian_permanent_village']}".
											", ".
											"{$info[0]['gurdian_permanent_post']}".
											", ".
											"{$info[0]['gurdian_permanent_thana_name']}".
											", ".
											"{$info[0]['gurdian_permanent_district_name']}"
											;
										}  
										?>
									</footer>
								</blockquote>
							</div> -->

							<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
								<blockquote>
									<p>
										<i class="fa fa-mobile">
										</i> 
										Price
										</p>
										<footer>
											<?php if(isset($info[0]['price'])) echo "{$info[0]['price']}"; ?>
										</footer>
									</blockquote>
								</div>
								<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
									<blockquote>
										<p>
											<i class="fa fa-envelope">
											</i> 
											Location</p>
											<footer>
												<?php if(isset($info[0]['location'])) echo "{$info[0]['location']}"; ?>
											</footer>
										</blockquote>
									</div>
								</div> 
					</div>
					<!-- tab 2 closes -->

					<!-- tab three starts -->	
					<div role="tabpanel" class="tab-pane" id="messages">

						<div class="row">

							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-4">
								<blockquote>
									<p>
										<i class="fa  fa-th-large">
										</i> 
										Clue Page
									</p>
									<footer><?php if(isset($info[0]['clue_page'])) echo "{$info[0]['clue_page']}"; ?></footer>
								</blockquote>
							</div>

							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-4">
								<blockquote>
									<p>
										<i class="fa  fa-building">
										</i> 
										Editor
									</p>
									<footer><?php if(isset($info[0]['editor'])) echo "{$info[0]['editor']}"; ?></footer>
								</blockquote>
							</div>

							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-4">
								<blockquote>
									<p>
										<i class="fa fa-columns">
										</i>  
										Edition
									</p>
									<footer><?php if(isset($info[0]['edition'])) echo "{$info[0]['edition']}"; ?></footer>
								</blockquote>
							</div>

							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-4">
								<blockquote>
									<p>
										<i class="fa fa-bell-o">
										</i> 
										Publishing Year</p>
										<footer><?php if(isset($info[0]['publishing_year'])) echo "{$info[0]['publishing_year']}"; ?></footer>
								</blockquote>
							</div>

							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-4">
								<blockquote>
								<p>
									<i class="fa fa-clock-o">
									</i> 
									Publication Place</p>
									<footer><?php if(isset($info[0]['publication_place']))  echo "{$info[0]['publication_place']}"; ?>
									</footer>
								</blockquote>
							</div>

							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-4">
								<blockquote>
									<p>
									<i class="fa fa-pencil-square-o">
									</i> 
									Total Pages</p>
									<footer><?php if(isset($info[0]['number_of_pages'])) echo "{$info[0]['number_of_pages']}"; ?>
									</footer>
								</blockquote>
							</div>

							<!-- <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
								<blockquote>
									<p>
										<i class="fa fa-book">
										</i> 
										Course
									</p>
									<footer><?php if(isset($info[0]['courses']))
													{	
														$z = $info[0]["courses"];
														echo str_replace("__", ",", $z);
													} ?></footer>
								</blockquote>
							</div> -->

							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
								<blockquote>
									<p>
									<i class="fa fa-pencil">
									</i> 
									Source</p>
									<footer><?php if(isset($info[0]['source_details'])) echo "{$info[0]['source_details']}"; ?>
									</footer>
								</blockquote>
							</div>
						</div> <!-- END ROW -->
					</div>	<!-- end tab panel -->
				</div> <!-- end tab content -->
			</div>
		</div>
	</div>
</div>



<br/>