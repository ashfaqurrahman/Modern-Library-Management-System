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
			<center><strong class="text-info" style="font-family:'Cooper Black'; font-size:20px"><i class="fa fa-user"></i>Details Information</strong></center>
		</div>
	</div>

	<br/>
	<div class="row">
		<div class="col-md-3 col-lg-3 col-sm-12 col-xs-12 text-center">
			
			<svg id="clock" version="1.1" width="100%" height="100%"
			preserveAspectRatio="xMidYMid meet" viewBox="-50 -50 100 100">
			
			<defs>
				<g id="clockface">
					<circle cx="0" cy="0" r="49" />

					<g id="mark-minute">
						<line x1="0" y1="-44" x2="0" y2="-47" />
					</g>
					<g id="marks5">
						<use xlink:href="#mark-minute" transform="rotate(0)" />
						<use xlink:href="#mark-minute" transform="rotate(6)" />
						<use xlink:href="#mark-minute" transform="rotate(12)" />
						<use xlink:href="#mark-minute" transform="rotate(18)" />
						<use xlink:href="#mark-minute" transform="rotate(24)" />
					</g>

					<use xlink:href="#marks5" transform="rotate(30)" />
					<use xlink:href="#marks5" transform="rotate(60)" />
					<use xlink:href="#marks5" transform="rotate(90)" />
					<use xlink:href="#marks5" transform="rotate(120)" />
					<use xlink:href="#marks5" transform="rotate(150)" />
					<use xlink:href="#marks5" transform="rotate(180)" />
					<use xlink:href="#marks5" transform="rotate(210)" />
					<use xlink:href="#marks5" transform="rotate(240)" />
					<use xlink:href="#marks5" transform="rotate(270)" />
					<use xlink:href="#marks5" transform="rotate(300)" />
					<use xlink:href="#marks5" transform="rotate(330)" />

					<g id="date-display">
						<rect x="23" y="-4" width="8" height="7.5" />
						<text x="27" y="1.8" text-anchor="middle">00</text>
					</g>
				</g>

				<g id="hand">
					<line x1="0" y1="0" x2="0" y2="-40" />
					<circle cx="0" cy="0" r="2" />
				</g>
			</defs>

			<use xlink:href="#clockface" />

			<g id="offset-hours">
				<use id="hour-hand"   xlink:href="#hand" />
			</g>
			<g id="offset-minutes">
				<use id="minute-hand" xlink:href="#hand" />
			</g>
			<g id="offset-seconds">
				<use id="second-hand" xlink:href="#hand" />
			</g>

		</svg><br/>
		<center><strong class="text-info" style="font-family:'Cooper Black'; font-size:16px"><?php echo $info[0]['domain_name']; ?></strong></center>
			
		</div>
		<div class="col-md-9 col-lg-9 col-sm-12 col-xs-12">
		
			<div>

				<!-- Nav tabs -->
				<ul class="nav nav-tabs" role="tablist">
					<li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab"><i class="fa fa-th-large"></i> Basic Information</a></li>
					<li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab"><i class="fa fa-graduation-cap"></i> Domain & Hosting</a></li>
					<li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab"><i class="fa fa-user-plus"></i> Site Information</a></li>
					
				</ul>

				<div class="tab-content">
					<div role="tabpanel" class="tab-pane active" id="home">

						<div class="row">
							<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
								<blockquote>
									<p><i class="fa fa-odnoklassniki"></i> Name</p>
									<footer><?php echo $info[0]['name']; ?></footer>
								</blockquote>
							</div>
							<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
								<blockquote>
									<p><i class="fa fa-mobile-phone"></i> Mobile</p>
									<footer><?php echo $info[0]['mobile']; ?></footer>
								</blockquote>
							</div>
							<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
								<blockquote>
									<p><i class="fa fa-envelope"></i> Email</p>
									<footer><?php echo $info[0]['email']; ?></footer>
								</blockquote>
							</div>
							<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
								<blockquote>
									<p><i class="fa fa-database"></i>Dns</p>
									<footer><?php echo $info[0]['dns']; ?></footer>
								</blockquote>
							</div>
							<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
								<blockquote>
									<p><i class="fa fa-calendar "></i> Date</p>
									<footer><?php echo $info[0]['date']; ?></footer>
								</blockquote>
							</div>
							<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
								<blockquote>
									<p><i class="fa fa-money"></i> Amount</p>
									<footer><?php echo $info[0]['amount']; ?></footer>
								</blockquote>
							</div>

						</div>
						
					</div>
					 
					<div role="tabpanel" class="tab-pane" id="profile">
						<div class="row">
							<div class="row">
							<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
								<blockquote>
									<p><i class="fa fa-bookmark-o"></i> Domain Name</p>
									<footer><?php echo $info[0]['domain_name']; ?></footer>
								</blockquote>
							</div>
							<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
								<blockquote>
									<p><i class="fa fa-calendar-plus-o"></i> Domain Reg. Date</p>
									<footer><?php echo $info[0]['domain_reg_date']; ?></footer>
								</blockquote>
							</div>
							<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
								<blockquote>
									<p><i class="fa fa-calendar-times-o"></i> Domain Exp. Date</p>
									<footer><?php echo $info[0]['domain_expire_date']; ?></footer>
								</blockquote>
							</div>
							<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
								<blockquote>
									<p><i class="fa fa-hdd-o"></i> Hosting Package</p>
									<footer><?php echo $info[0]['hosting_package']; ?></footer>
								</blockquote>
							</div>
							<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
								<blockquote>
									<p><i class="fa fa-calendar-plus-o"></i> Hosting Reg. Date</p>
									<footer><?php echo $info[0]['hosting_reg_date']; ?></footer>
								</blockquote>
							</div>
							<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
								<blockquote>
									<p><i class="fa fa-calendar-times-o"></i> Hosting Exp. Date</p>
									<footer><?php echo $info[0]['hosting_expire_date']; ?></footer>
								</blockquote>
							</div>

						</div>						

						</div>
						
					</div>
					<div role="tabpanel" class="tab-pane" id="messages">
						<div class="row">
							<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
								<blockquote>
									<p><i class="fa fa-wordpress"></i> WP Username</p>
									<footer><?php echo $info[0]['wp_username']; ?></footer>
								</blockquote>
							</div>
							<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
								<blockquote>
									<p><i class="fa fa-key"></i> WP Password</p>
									<footer><?php echo $info[0]['wp_password']; ?></footer>
								</blockquote>
							</div>
							<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
								<blockquote>
									<p><i class="fa fa-wrench"></i> CPanel Username</p>
									<footer><?php echo $info[0]['cpanel_username']; ?></footer>
								</blockquote>
							</div>

							<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
								<blockquote>
									<p><i class="fa fa-key"></i> CPanel Password</p>
									<footer><?php echo $info[0]['cpanel_password']; ?></footer>
								</blockquote>
							</div>							

						</div>
						
					 </div>					
				</div>		
			</div>	
		</div>
	</div>
</div>

<script type="text/javascript">
	window.onload = function() {
  var time     = new Date(),
      midnight = new Date();
  midnight.setHours(0);
  midnight.setMinutes(0);
  midnight.setSeconds(0);

  // Seconds/Minutes/Hours from today:
  var seconds = (time.getTime() - midnight.getTime()) / 1000,
      minutes = seconds / 60,
      hours   = minutes / 60;

  document.getElementById('offset-hours').style.transform   = 'rotate(' + (hours % 12 / 12 * 360) + 'deg)';
  document.getElementById('offset-minutes').style.transform = 'rotate(' + (minutes    / 60 * 360) + 'deg)';
  document.getElementById('offset-seconds').style.transform = 'rotate(' + (seconds    / 60 * 360) + 'deg)';
  
  document.getElementById('date-display').getElementsByTagName('text')[0].innerHTML = time.getDate();
};

</script>
