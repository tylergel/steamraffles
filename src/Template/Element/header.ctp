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

		<div class="container" style = "position: relative; z-index: 5">
			<ul id="gn-menu"  class="gn-menu-main" style = "background-color: <?= $color ?>" >
				<li class="gn-trigger" >
					<a class="gn-icon gn-icon-menu"><span>Menu</span></a>
					<nav class="gn-menu-wrapper" style = "background-color: <?= $color ?>">
						<div class="gn-scroller">
							<ul class="gn-menu" style = "background-color: <?= $color ?>">
								<li>
									<?= $this->Html->link('All Raffles',['controller' => 'Raffles', 'action' => 'index', 'all'], ['class' => 'gn-icon gn-icon-download']); ?>
									<ul class="gn-submenu" style = "background-color: <?= $color ?>">
										<?php foreach($apps as $app) : ?>
											<li>
											 <?= $this->Html->link($app->app,['controller' => 'Raffles', 'action' => 'index', $app->app], ['class' => 'gn-icon gn-icon-download', 'style' => 'padding-left:8px']); ?>
											</li>
										<?php endforeach ?>
										</ul>
								</li>
								<li>
									<?= $this->Html->link('Create Raffle',['controller' => 'Raffles', 'action' => 'create'], ['class' => 'gn-icon gn-icon-download']); ?>
								</li>
								<li>
									<?= $this->Html->link('Completed Raffles',['controller' => 'Raffles', 'action' => 'completed'], ['class' => 'gn-icon gn-icon-download']); ?>
								</li>
								<li>
									<?= $this->Html->link('Top Rafflers',['controller' => 'Raffles', 'action' => 'top'], ['class' => 'gn-icon gn-icon-download']); ?>
								</li>
								<li>
									<?= $this->Html->link('Rules',['controller' => 'About', 'action' => 'rules'], ['class' => 'gn-icon gn-icon-download']); ?>
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
									<div class="dropdown">
										<?=  $this->Html->image($_SESSION['steam_avatarfull'], ['width' => '50px']); ?>
										<div class="dropdown-content">
								      <?= logoutbutton(); ?>
								    </div>
									</div>
								</li>
  				<?php endif;  ?>
			</ul>
		</div>

		<script>
			new gnMenu( document.getElementById( 'gn-menu' ) );
		</script>
	</body>
</html>
