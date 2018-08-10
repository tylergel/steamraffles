<!DOCTYPE html>

<?php  require ('steamauth/steamauth.php'); $color = "#F5F9FA"?>

<html lang="en" class="no-js">
	<head>

		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Steam Raffles</title>
		<link rel="shortcut icon" href="../favicon.ico">
	</head>

	<body>

		<div class="container" style = "position: relative; z-index: 5; ">
			<ul id="gn-menu"  class="gn-menu-main" style = "background-color: <?= $color ?>" >
				<li class="gn-trigger" >
					<a class="gn-icon gn-icon-menu"><span>Menu</span></a>
					<nav class="gn-menu-wrapper" style = "background-color: <?= $color ?>">
						<div class="gn-scroller">
							<ul class="gn-menu" style = " background-color: <?= $color ?>">

								<li>
									<i class="fa fa-money fa-2x" style = "float: left; margin-top: 15px;" aria-hidden="true"></i><?= $this->Html->link('All Raffles',['controller' => 'Raffles', 'action' => 'index', 'all'], ['style' => 'font-size: 20px']); ?>
									<!--
									<ul class="" style = "background-color: <?= $color ?>">
										<?php foreach($apps as $app) : ?>
											<li>
											 <?= $this->Html->link($app->app,['controller' => 'Raffles', 'action' => 'index', $app->app], ['style' => 'padding-left:58px']); ?>
											</li>
										<?php endforeach ?>
										</ul>
										-->
								</li>

								<li>
									<i class="fa fa-plus fa-2x" style = "float: left; margin-top: 15px;" aria-hidden="true"></i><?= $this->Html->link('Create Raffle',['controller' => 'Raffles', 'action' => 'create']); ?>
								</li>
								<li>
									<i class="fa fa-check fa-2x" style = "float: left; margin-top: 15px;" aria-hidden="true"></i><?= $this->Html->link('Completed Raffles',['controller' => 'Raffles', 'action' => 'completed']); ?>
								</li>
								<li>
									<i class="fa fa-star fa-2x" style = "float: left; margin-top: 15px;" aria-hidden="true"></i><?= $this->Html->link('Top Rafflers',['controller' => 'Raffles', 'action' => 'top']); ?>
								</li>
								<li>
									<i class="fa fa-trophy fa-2x" style = "float: left; margin-top: 15px;" aria-hidden="true"></i><?= $this->Html->link('Refer a friend',['controller' => 'Users', 'action' => 'rewards']); ?>
								</li>
								<li>
									<i class="fa fa-heart fa-2x" style = "float: left; margin-top: 15px;" aria-hidden="true"></i><?= $this->Html->link('Donate',['controller' => 'Users', 'action' => 'donations']); ?>
								</li>
								<li>
									<i class="fa fa-birthday-cake fa-2x" style = "float: left; margin-top: 15px;" aria-hidden="true"></i><?= $this->Html->link('Sponsors',['controller' => 'About', 'action' => 'sponsors']); ?>
								</li>
								<li>
									<i class="fa fa-info-circle fa-2x" style = "float: left; margin-top: 15px;" aria-hidden="true"></i><?= $this->Html->link('Rules',['controller' => 'About', 'action' => 'rules']); ?>
								</li>
								<li>
									<i class="fa fa-info-circle fa-2x" style = "float: left; margin-top: 15px;" aria-hidden="true"></i><?= $this->Html->link('Contact Us',['controller' => 'About', 'action' => 'contact']); ?>
								</li>

							</ul>
						</div>
					</nav>
				</li>
				<li><a href="<?= $redirecturl; ?>">Home</a></li>
					<?php if(!isset($_SESSION['steamid'])) : ?>
                  <li><span><?= loginbutton(); ?></span></li>
        	<?php endif; ?>
					<?php if(isset($_SESSION['steamid'])) : ?>
					<?php include ('steamauth/userInfo.php'); ?>
								<li>
									<div class="btn-group">
									  <?=  $this->Html->image($_SESSION['steam_avatarfull'], ['class' => 'dropdown-toggle', 'type' => 'button', 'data-toggle' => 'dropdown', 'height' => '50px', 'width' => '50px', 'right' => '0px']); ?>
									  <div class="dropdown-menu" style = "height: 200px !important; font-size: 12px">
									    <a class="dropdown-item" style = "height: 50px !important; font-size: 12px" href="<?= $this->Url->build( array('controller' => 'users', 'action' => 'profile', $_SESSION['steamid'], '1') ) ?>">My profile</a>
											<div class="dropdown-divider"></div>
											<a class="dropdown-item" style = "height: 50px !important; font-size: 12px" href="<?= $this->Url->build( array('controller' => 'raffles', 'action' => 'index', 'all', $_SESSION['steamid']) ) ?>">My raffles</a>
											<div class="dropdown-divider"></div>
											<a class="dropdown-item" style = "height: 50px !important; font-size: 12px" href="#"><?= logoutbutton() ?></a>

									  </div>
									</div>



								</li>
  				<?php endif;  ?>
			</ul>
		</div>

		<script>
		$("#picture").click( function() {
    document.getElementById("myDropdown").classList.toggle("show");
});

// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {

    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}
			new gnMenu( document.getElementById( 'gn-menu' ) );
		</script>

	</body>
</html>
