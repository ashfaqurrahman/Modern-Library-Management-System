

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
			<center><strong class="text-info" style="font-family:'Cooper Black'; font-size:20px"><i class="fa fa-user"></i><?php echo $this->lang->line("view"); ?> - <?php echo $this->lang->line("book"); ?></strong></center>
		</div>
	</div>
	<br/>
	<!-- setting variables -->
	<div class="row">

		 <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12 text-center">
		    <?php 

		    /*if($info[0]['image']=='' && $info[0]['gender']=="Male") $image=base_url('assets/images/avatar/boy.png'); 
			else if($info[0]['image']=='' && $info[0]['gender']=="Female") $image=base_url('assets/images/avatar/girl.png');*/

			/*else*/ $image = base_url('upload/cover_images').'/'.$info[0]['cover']; ?>

			<img class="img img-thumbnail" style="width:250px; height:320px" src="<?php echo $image; ?>">

			 <h3 class="text-center" style="font-family:'Cooper Black'"> <?php if(isset($info[0]['title'])) echo "{$info[0]['title']}"; ?></h3>
			<h4 class="text-center gray"> <?php if(isset($info[0]['subtitle'])) echo "{$info[0]['subtitle']}"; ?></h4> 

			<?php if($info[0]['status']==1) $availability="<span class='label label-success'>".$this->lang->line("available")."</span>"; else $availability="<span class='label label-danger'>".$this->lang->line("unavailable")."</span>";?> 
			<h4 class="text-center"> <?php echo $availability;?></h4> 

		</div> 

		<div class="col-md-9 col-lg-9 col-sm-12 col-xs-12">

			<div>

				<!-- Nav tabs -->
				<ul class="nav nav-tabs" role="tablist">
					<li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab"><i class="fa fa-th-large"></i> <?php echo $this->lang->line("basic info"); ?></a></li>
					<li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab"><i class="fa fa-info-circle"></i> <?php echo $this->lang->line("other info"); ?></a></li>

				</ul>

				<!--tab one -->

				<div class="tab-content">
					<div role="tabpanel" class="tab-pane active" id="home">

						<div class="row">

							<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
								<blockquote>
									<p><i class="fa fa-circle-o"></i> <?php echo $this->lang->line("ISBN"); ?></p>
									<footer><?php if(isset($info[0]['isbn'])) echo "{$info[0]['isbn']}"; ?></footer>
								</blockquote>
							</div>

							<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
								<blockquote>
									<p><i class="fa fa-circle-o"></i> <?php echo $this->lang->line("call no"); ?></p>
									<footer><?php if(isset($info[0]['call_no'])) echo "{$info[0]['call_no']}"; ?></footer>
								</blockquote>
							</div>

							<div class="col-xs-12">
								<blockquote>
									<p><i class="fa fa-circle-o"></i> <?php echo $this->lang->line("title"); ?></p>
									<footer><?php if(isset($info[0]['title'])) echo "{$info[0]['title']}"; ?></footer>
								</blockquote>
							</div>

							<div class="col-xs-12">
								<blockquote>
									<p><i class="fa fa-circle-o"></i> <?php echo $this->lang->line("subtitle"); ?></p>
									<footer><?php if(isset($info[0]['subtitle'])) echo "{$info[0]['subtitle']}"; ?></footer>
								</blockquote>
							</div>
						
							<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
								<blockquote>
									<p><i class="fa fa-circle-o"></i> <?php echo $this->lang->line("book id"); ?></p>
									<footer><?php if(isset($info[0]['id']))  echo "{$info[0]['id']}"; ?></footer>
								</blockquote>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
								<blockquote>
									<p><i class="fa fa-circle-o"></i> <?php echo $this->lang->line("author"); ?></p>
									<footer><?php if(isset($info[0]['author'])) echo "{$info[0]['author']}"; ?></footer>
								</blockquote>
							</div>
													

							<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
								<blockquote>
									<p>
										<i class="fa fa-circle-o">
										</i>  
										<?php echo $this->lang->line("edition"); ?>
									</p>
									<footer><?php if(isset($info[0]['edition'])) echo "{$info[0]['edition']}"; ?></footer>
								</blockquote>
							</div>

							<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
								<blockquote>
									<p><i class="fa fa-circle-o"></i> <?php echo $this->lang->line("edition year"); ?></p>
									<footer><?php  if(isset($info[0]['edition_year'])) echo "{$info[0]['edition_year']}"; ?></footer>
								</blockquote>
							</div>
						
							

							<div class="col-xs-12">
								<blockquote>
									<p><i class="fa fa-circle-o"></i> <?php echo $this->lang->line("book category"); ?></p>
									<footer>

									<?php		             		
		             		$size_of_all_category = sizeof($all_category);				// extracting array size
		             		$size_of_existing_category = sizeof($existing_category);	
		             		foreach ($all_category as $value)  			// starting a foreach loop to extract category id from all_category
		             		{		             			
		             			for($i=0; $i<$size_of_existing_category; $i++) 	// starting a for loop to match between all and existing category
		             			{		             				
		             				if($value['id'] == $existing_category[$i])	// match contidion
		             				{		             			
		             					if($i != $size_of_existing_category - 1) echo $value['category_name'].", ";	// print , after elements
		             					else echo $value['category_name'];	// not to print , at last element
		             				}
		             			}			             			
		             		 }	
		             		 ?>
									</footer>
								</blockquote>
							</div>
							
						</div> <!-- end row -->
					</div>	<!-- end tab panel -->					

					<!-- tab one close -->

					<!-- tab 2 start -->

					<div role="tabpanel" class="tab-pane" id="profile">						

						<div class="row">

							<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
								<blockquote>
									<p><i class="fa fa-circle-o"></i> <?php echo $this->lang->line("physical form"); ?> </p>
									<footer><?php if(isset($info[0]['physical_form'])) echo "{$info[0]['physical_form']}"; ?></footer>
								</blockquote>
							</div>

							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
								<blockquote>
									<p>
										<i class="fa  fa-circle-o">
										</i> 
										<?php echo $this->lang->line("editor"); ?>
									</p>
									<footer><?php if(isset($info[0]['editor'])) echo "{$info[0]['editor']}"; ?></footer>
								</blockquote>
							</div>

							

							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
								<blockquote>
									<p>
									<i class="fa fa-circle-o">
									</i> 
									<?php echo $this->lang->line("total pages"); ?></p>
									<footer><?php if(isset($info[0]['number_of_pages'])) echo "{$info[0]['number_of_pages']}"; ?>
									</footer>
								</blockquote>
							</div>


							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
								<blockquote>
									<p><i class="fa fa-circle-o"></i> <?php echo $this->lang->line("size"); ?></p>
									<footer><?php  if(isset($info[0]['size1'])) echo "{$info[0]['size1']}"; ?></footer>
								</blockquote>
							</div>

							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
								<blockquote>
									<p><i class="fa fa-circle-o"></i> <?php echo $this->lang->line("series"); ?></p>
									<footer><?php if(isset($info[0]['series'])) echo "{$info[0]['series']}"; ?></footer>
								</blockquote>
							</div>							

							<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
								<blockquote>
									<p>
										<i class="fa fa-circle-o">
										</i> 
										<?php echo $this->lang->line("price"); ?>
										</p>
										<footer>
											<?php if(isset($info[0]['price'])) echo "{$info[0]['price']}"; ?>
										</footer>
									</blockquote>
								</div>
								<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
									<blockquote>
										<p>
											<i class="fa fa-circle-o">
											</i> 
											<?php echo $this->lang->line("location"); ?></p>
											<footer>
												<?php if(isset($info[0]['location'])) echo "{$info[0]['location']}"; ?>
											</footer>
										</blockquote>
								</div>

								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
								<blockquote>
									<p>
										<i class="fa  fa-th-circle-o">
										</i> 
										<?php echo $this->lang->line("clue page"); ?>
									</p>
									<footer><?php if(isset($info[0]['clue_page'])) echo "{$info[0]['clue_page']}"; ?></footer>
								</blockquote>
							</div>

					

							<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
								<blockquote>
									<p><i class="fa fa-circle-o"></i> <?php echo $this->lang->line("publisher"); ?></p>
									<footer><?php if(isset($info[0]['publisher']))  echo "{$info[0]['publisher']}"; ?></footer>
								</blockquote>
							</div>

							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-4">
								<blockquote>
									<p>
										<i class="fa fa-circle-o">
										</i> 
										<?php echo $this->lang->line("publication year - place"); ?></p>
										<footer><?php if(isset($info[0]['publishing_year'])) echo "{$info[0]['publishing_year']} - {$info[0]['publication_place']}"; ?></footer>
								</blockquote>
							</div>
													
							
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
								<blockquote>
									<p>
									<i class="fa fa-circle-o">
									</i> 
									<?php echo $this->lang->line("source of book"); ?></p>
									<footer><?php if(isset($info[0]['source_details'])) echo "{$info[0]['source_details']}"; ?>
									</footer>
								</blockquote>
							</div>
							</div> 

					</div>
					<!-- tab 2 closes -->
				</div> <!-- end tab content -->
			</div>
		</div>
	</div>
</div>



<br/>