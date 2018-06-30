<!DOCTYPE html>

<html lang="en">
<?= $this->Flash->render() ?>

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Raffles website</title>
  </head>

  <!-- Accept terms module -->
  <?php if($notaccepted) : ?>
    <div id="myModal" class="modal col-md-8 offset-md-2">
      <div class="modal-content" style = "overflow-y: scroll; max-height: 60%">
        <h4>Please accept our privacy policy to continue using the site.</h4>
        <p id = 'regTitle'>Loading privacy policy...</p>
      </div>
      <div class="modal-footer">
        <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Close</a>
        <form method = "post"><input type = "submit" value = "I agree" name = "I agree"></form>
      </div>
    </div>
  <?php endif ?>

  <body>
    <!-- Header -->
    <header id = "body-element" class="masthead text-white" style =" background-color:#18bc9c!important">
      <div class = "container">
        <div class = "row">
          <div class = "col-md-6">
            <div class = "row">
              <div class = "col-md-12 text-center">
                <h4 style = "font-size:2rem;">Welcome to Steamraffles!</h4>
              </div>
            </div>
              <div class = "row">
                <div class = "col-md-12 text-center">
                  <h5 style = "font-size:1rem;">A raffle site for the community.  Raffles every day.</h5>
                </div>
              </div>
              <div class = "col-md-12 text-center">
                <a href = <?= $this->Url->build(['controller' => 'raffles','action' => 'index']);?> class="waves-effect waves-light btn">View all raffles</a>
              </div>
          </div>
          <div class = "col-md-6">
            <div class = "row">
              <div class = "col-md-12 text-center">
                <h4 style = "font-size:1rem;">Join our community</h4>
              </div>
            </div>
            <div class = "col-md-12 text-center">
              <a href =  "https://steamcommunity.com/groups/gamegifts" class="btn btn-danger">Steam group</a>
            </div>
            <div class = "row">
              <div class = "col-md-12 text-center">
                <h4 style = "font-size:1rem;">Latest winner: <?= $ava ?></h4>
              </div>
            </div>
            <div class = "col-md-12 text-center">
              <img src = <?= $latest ?> width = '50' height = '50'></img>
            </div>
          </div>
        </div>
      </div>
    </header>

    <!-- Show 3 newest raffles -->
    <section id = "body-element" class="portfolio" id="portfolio" style = 'background-color:white;'>
      <h2 class="text-center" style = "font-color:white">Newest Raffles</h2>
      <div class="container">
        <?php foreach($raffles as $raffle) : ?>
        <div class="card col-md-12" style = "background-color:#DEF2F1; ">
          <div class = "row" >
            <div class="col-md-10 no-gutters text-center" >
              <?= $this->Html->link($raffle['title'], ['controller' => 'Raffles', 'action' => 'view', $raffle['id']]); ?>
            </div>
          </div>
          <div class = "row no-gutters" >
            <div class = "col-md-2 col-3">
              <div class = "col-md-6 col-12 no-gutters">
                <img style = 'max-width: 100%;' class="card-img" src='<?= $raffle['avatar'] ?>'; class="rounded-circle"; height = "70"; alt="Card image cap" >
              </div>
              <div class = "col-md-12 col-12 no-gutters" style = "font-size: 10px">
                <?= $raffle['steamname'] ?>
              </div>
            </div>
            <div class = "row col-md-10 col-9  no-gutters">
              <?php
                foreach($raffle['items'] as $raff) {
                  $name = 'https://steamcommunity.com/economy/image/';
                  $name .= $raff['name'];
                  echo "<div class = 'col-md-1 col-2' ;><img style = 'max-width: 100%;' src = $name></img></div>";
                }
              ?>
            </div>
          </div>
        </div>
        <div class = "row">
          <div class="col-md-4 col-12 text-center" style = "font-color: white; font-size: .75rem">
            Entries: <?= $raffle['entry']; ?>/ <?= $raffle['entries']; ?>
          </div>
          <?php if(isset($_SESSION['steamid'])) : ?>
            <div class="col-md-4 col-12 text-center" style = "font-color: white; font-size: .75rem">
              <a href = <?= $this->Url->build(['controller' => 'raffles','action' => 'view', $raffle['id']]);?>><button type="button" class="waves-effect waves-light btn">Enter now</button></a>
            </div>
          <?php endif ?>
          <?php if(!isset($_SESSION['steamid'])) : ?>
            <div class="col-md-4 col-12 text-center" style = "font-color: white; font-size: .75rem">
              <button type="button" class="waves-effect waves-light btn">You must sign in</button>
            </div>
          <?php endif ?>
          <div class="aclass col-md-4 col-12 text-center" style = "font-color: white; font-size: .75rem" name = <?= $raffle['time']; ?> id = <?= $raffle['id'] ?>></div>
        </div>
        <?php endforeach; ?>

        <!-- Ad -->
        <div class="card col-md-12" style = "background-color:#DEF2F1; ">
          <div class = "row" >
            <div class="col-md-10 no-gutters text-center" >
              <a href = "https://go.oclasrv.com/afu.php?zoneid=1779348" target="_blank">Great ad!  We hope :)</a>
            </div>
          </div>
          <div class = "row no-gutters" >
            <div class = "col-md-3 col-4">
              <div class = "col-md-6 col-12 no-gutters">
                <img style = 'max-width: 100%;' class="card-img" src='/webroot/favicon.ico'; class="rounded-circle"; height = "70"; alt="Card image cap" >
              </div>
              <div class = "col-md-12 col-12 no-gutters" style = "font-size: 10px">
                Steamraffles Advertisement
              </div>
            </div>
            <div class = "row col-md-9 col-8  no-gutters">
              <a class="waves-effect waves-light btn pull-right" href = "https://go.oclasrv.com/afu.php?zoneid=1779348" target="_blank">Cool offer! </a>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- About Section -->
    <section class="text-white mb-0" id="about" style =" background-color:#18bc9c!important">
      <div class="container">
        <h2 class="text-center text-uppercase text-white">How it works</h2>
        <hr class="star-light mb-5">
        <div class="row">
          <div class="col-lg-12 text-center">
            <p class="lead">Choose the game of your choice, and enter the raffle.  All raffles are free to enter, and can be viewed here.  Upon winning, you will receive your prize in the way specified for that game.</p>
          </div>
        </div>
      </div>
    </section>

    <!-- Footer -->
    <div class="copyright py-4 text-center text-white">
      <div class="container">
        <small><?= $this->Html->link('Privacy Policy', ['controller' => 'About', 'action' => 'privacy']); ?></small>
        <small>&nbsp;&nbsp;&nbsp;</small>
        <small><?= $this->Html->link('Terms of Service', ['controller' => 'About', 'action' => 'terms']); ?></small>
        <small><br></small>
        <small>This site is not affiliated with Valve or Steam</small>
      </div>
    </div>
  </body>

</html>

<script>
$('.modal').modal({
    dismissible: true
});

//call the specific div (modal)
$('#myModal').modal('open');
var getHTML = function ( url, callback ) {

	// Feature detection
	if ( !window.XMLHttpRequest ) return;

	// Create new request
	var xhr = new XMLHttpRequest();

	// Setup callback
	xhr.onload = function() {
		if ( callback && typeof( callback ) === 'function' ) {
			callback( this.responseXML );
		}
	}

	// Get the HTML
	xhr.open( 'GET', url );
	xhr.responseType = 'document';
	xhr.send();

};
getHTML( 'privacies.html', function (response) {
	$("#regTitle").html(response.documentElement.innerHTML);
});
<?php include 'timer.js'; ?>
</script>
