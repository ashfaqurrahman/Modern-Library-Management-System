<section class="content-header">
   <section class="content">
   	<div class="row">
			<div class="col-xs-12">

				<div class="row">
					<div class="text-center"><h2 style="font-weight:900;"><?php echo $this->lang->line('total issued books + Expired but not returned books');?></h2></div>
					<div id="div_for_circle_chart"></div>
				</div>

				<!-- total report section -->
				<div class="row">
					<div class="text-center"><h2 style="font-weight:900;"><?php echo $this->lang->line('overall report');?></h2></div>

					<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">

						<div class="small-box bg-blue">
							<div class="inner">
								<h3><?php echo $num_of_book; ?></h3>
								<p><?php echo $this->lang->line('total number of books');?></p>
							</div>
							<div class="icon">
								<i class="fa fa-book"></i>
							</div>
							<a target="_blank" href="<?php echo base_url()."dashboard/book_list"; ?>" class="small-box-footer">
								<?php echo $this->lang->line('more information');?> <i class="fa fa-arrow-circle-right"></i>
							</a>
						</div>
					</div>

					<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">

						<div class="small-box bg-yellow">
							<div class="inner">
								<h3><?php echo $num_issue_book; ?></h3>
								<p><?php echo $this->lang->line('total number of issued books');?></p>
							</div>
							<div class="icon">
								<i class="fa fa-book"></i><i class="fa fa-mail-forward"></i>
							</div>
							<a target="_blank" href="<?php echo base_url()."dashboard/circulation"; ?>" class="small-box-footer">
								<?php echo $this->lang->line('more information');?> <i class="fa fa-arrow-circle-right"></i>
							</a>
						</div>
					</div>

					<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">

						<div class="small-box bg-aqua">
							<div class="inner">
								<h3><?php echo $num_member; ?></h3>
								<p><?php echo $this->lang->line('total number of members');?></p>
							</div>
							<div class="icon">
								<i class="ion ion-person-add"></i>
							</div>
							<a target="_blank" href="<?php echo base_url()."dashboard/config_member"; ?>" class="small-box-footer">
								<?php echo $this->lang->line('more information');?> <i class="fa fa-arrow-circle-right"></i>
							</a>
						</div>
					</div>

				</div>
				

				<!-- end of total report section -->

				<!-- Todays report section -->
				<div class="row">
					<div class="text-center"><h2 style="font-weight:900;"><?php echo $this->lang->line("today's report");?></h2></div>
					<div class="col-xs-12 col-sm-12 col-md-3 col-xs-12 col-sm-12 col-md-3 col-lg-3">

						<div class="small-box bg-blue">
							<div class="inner">
								<h3><?php echo $num_add_book_today; ?></h3>
								<p><?php echo $this->lang->line("today's added books");?></p>
							</div>
							<div class="icon">
								<i class="fa fa-book"></i>
							</div>
							<a target="_blank" href="<?php echo base_url()."dashboard/book_list"; ?>" class="small-box-footer">
								<?php echo $this->lang->line('more information');?> <i class="fa fa-arrow-circle-right"></i>
							</a>
						</div>
					</div>

					<div class="col-xs-12 col-sm-12 col-md-3 col-xs-12 col-sm-12 col-md-3 col-lg-3">

						<div class="small-box bg-yellow">
							<div class="inner">
								<h3><?php echo $num_today_issue_book; ?></h3>
								<p><?php echo $this->lang->line("today's issued books");?></p>
							</div>
							<div class="icon">
								<i class="fa fa-book"></i><i class="fa fa-mail-forward"></i>
							</div>
							<a target="_blank" href="<?php echo base_url()."dashboard/circulation"; ?>" class="small-box-footer">
								<?php echo $this->lang->line('more information');?> <i class="fa fa-arrow-circle-right"></i>
							</a>
						</div>
					</div>

					<div class="col-xs-12 col-sm-12 col-md-3 col-xs-12 col-sm-12 col-md-3 col-lg-3">

						<div class="small-box bg-aqua">
							<div class="inner">
								<h3><?php echo $num_today_return_book; ?></h3>
								<p><?php echo $this->lang->line("today's returned books");?></p>
							</div>
							<div class="icon">
								<i class="fa fa-book"></i><i class="fa fa-mail-reply"></i>
							</div>
							<a target="_blank" href="<?php echo base_url()."dashboard/circulation"; ?>" class="small-box-footer">
								<?php echo $this->lang->line('more information');?> <i class="fa fa-arrow-circle-right"></i>
							</a>
						</div>
					</div>

					<div class="col-xs-12 col-sm-12 col-md-3 col-xs-12 col-sm-12 col-md-3 col-lg-3">

						<div class="small-box bg-orange">
							<div class="inner">
								<h3><?php echo $num_today_add_member; ?></h3>
								<p><?php echo $this->lang->line("today's added members");?></p>
							</div>
							<div class="icon">
								<i class="ion ion-person-add"></i>
							</div>
							<a target="_blank" href="<?php echo base_url()."dashboard/config_member"; ?>" class="small-box-footer">
								<?php echo $this->lang->line('more information');?> <i class="fa fa-arrow-circle-right"></i>
							</a>
						</div>
					</div>
				</div>
				
				<!--end of Todays report section -->

				<!-- monthly report section -->
				<div class="row">
					<div class="text-center"><h2 style="font-weight:900;"><?php echo $this->lang->line("current month's report");?></h2></div>
					<div class="col-xs-12 col-sm-12 col-md-3 col-xs-12 col-sm-12 col-md-3 col-lg-3">

						<div class="small-box bg-blue">
							<div class="inner">
								<h3><?php echo $num_add_book_this_month; ?></h3>
								<p><?php echo $this->lang->line("this month's added book");?></p>
							</div>
							<div class="icon">
								<i class="fa fa-book"></i>
							</div>
							<a target="_blank" href="<?php echo base_url()."dashboard/book_list"; ?>" class="small-box-footer">
								<?php echo $this->lang->line('more information');?> <i class="fa fa-arrow-circle-right"></i>
							</a>
						</div>
					</div>

					<div class="col-xs-12 col-sm-12 col-md-3 col-xs-12 col-sm-12 col-md-3 col-lg-3">

						<div class="small-box bg-yellow">
							<div class="inner">
								<h3><?php echo $num_issue_book_this_month; ?></h3>
								<p><?php echo $this->lang->line("this month's issued book");?></p>
							</div>
							<div class="icon">
								<i class="fa fa-book"></i><i class="fa fa-mail-forward"></i>
							</div>
							<a target="_blank" href="<?php echo base_url()."dashboard/circulation"; ?>" class="small-box-footer">
								<?php echo $this->lang->line('more information');?> <i class="fa fa-arrow-circle-right"></i>
							</a>
						</div>
					</div>

					<div class="col-xs-12 col-sm-12 col-md-3 col-xs-12 col-sm-12 col-md-3 col-lg-3">

						<div class="small-box bg-aqua">
							<div class="inner">
								<h3><?php echo $num_return_book_this_month; ?></h3>
								<p><?php echo $this->lang->line("this month's returned book");?></p>
							</div>
							<div class="icon">
								<i class="fa fa-book"></i><i class="fa fa-mail-reply"></i>
							</div>
							<a target="_blank" href="<?php echo base_url()."dashboard/circulation"; ?>" class="small-box-footer">
								<?php echo $this->lang->line('more information');?> <i class="fa fa-arrow-circle-right"></i>
							</a>
						</div>
					</div>

					<div class="col-xs-12 col-sm-12 col-md-3 col-xs-12 col-sm-12 col-md-3 col-lg-3">

						<div class="small-box bg-orange">
							<div class="inner">
								<h3><?php echo $num_add_member_this_month; ?></h3>
								<p><?php echo $this->lang->line("this month's added member");?></p>
							</div>
							<div class="icon">
								<i class="ion ion-person-add"></i>
							</div>
							<a target="_blank" href="<?php echo base_url()."dashboard/config_member"; ?>" class="small-box-footer">
								<?php echo $this->lang->line('more information');?> <i class="fa fa-arrow-circle-right"></i>
							</a>
						</div>
					</div>
				</div>
				
				<!--end of monthly report section -->

				

				<div class="row">
					<div class="text-center"><h2 style="font-weight:900;"><?php echo $this->lang->line('issued and returned report for last 12 months');?></h2></div>
					<div id='div_for_bar'></div>
				</div>

				
				
				
				
				<?php
				
  						// $bar=array("0"=>array("y"=>2014,"a"=>100,"b"=>50),"1"=>array("y"=>2015,"a"=>100,"b"=>50));
				$bar = $chart_bar;
				$circle_bir = array(
					'0' => array(
						'label'=>$this->lang->line('expired but not returned'),
						'value'=>$not_returned[0]['not_returned']
						),
					'1' =>array(
						'label'=>$this->lang->line('total issued'),
						'value'=>$total_issued[0]['total_issued']
						
						)
					
					);
				
				 ?>
				
				
				

			</div>
		</div>
   </section>
</section>


<script>
var total_issued_dis="<?php echo $this->lang->line('number total issued'); ?>";
var total_retuned_dis="<?php echo $this->lang->line('number total returned'); ?>";
Morris.Bar({
  element: 'div_for_bar',
  data: <?php echo json_encode($bar); ?>,
  xkey: 'year',
  ykeys: ['total_issue', 'total_return'],
  labels: [total_issued_dis, total_retuned_dis]
});

Morris.Donut({
  element: 'div_for_circle_chart',
  data: <?php echo json_encode($circle_bir); ?>
});
</script>






