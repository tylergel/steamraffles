<!DOCTYPE html>

<html lang="en">
<?= $this->Flash->render() ?>

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
  </head>

  <!-- Accept terms module -->
  <?php if($notaccepted) : ?>
      <div id="myModal" class="modal col-md-8 offset-md-2"  style = "background-color: white; ">
        <div class="modal-header">
        <a href="#" class="js-close-modal">Close</a>
        </div>
        <div class="modal-content">
        <p id = 'regTitle'>Loading privacy policy...</p>
        </div>
        <div class="modal-footer">
          <a href="#" class="js-close-modal">Close</a>
          <form method = "post"><input type = "submit" value = "I agree" name = "I agree"></form>
        </div>
      </div>


  <?php endif ?>

  <body>
    <!-- Header -->
    <header id = "body-element" class="masthead text-white" style =" background-color:#18bc9c!important;">
      <?php foreach($news as $new) : ?>
      <div class="alert alert-danger" role="alert" style = "margin-top: 0px">
          <strong><?= $new['title']; ?></strong> <?= $new['news'] ?>
      </div>
    <?php endforeach ?>
    <div class = "container">
        <div class = "row">
          <div class = "col-md-6">
            <div class = "row">
              <div class = "col-md-12 text-center">
                <h1 style = "font-size:2rem;">Welcome to Steamraffles!</h1>
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
              <p>
              <div class = "col-md-12 text-center">
                <a href = <?= $this->Url->build(['controller' => 'About','action' => 'sponsors']);?> class="waves-effect waves-light btn">View our sponsors</a>
              </div>
            </p>
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
              <a href = "<?= $this->Url->build( array('controller' => 'users', 'action' => 'profile', $lateststeamid, '1') ) ?>">

              <img alt = "winner" src = <?= $latest ?> width = '50' height = '50'></img>
            </a>
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
        <div class="panel panel-default col-md-12" style = "background-color:#DEF2F1; ">
          <div class = "row" >
            <div class="col-md-10 no-gutters text-center" >
              <?= $this->Html->link($raffle['title'], ['controller' => 'Raffles', 'action' => 'view', $raffle['id']]); ?>
            </div>
          </div>
          <div class = "row" >
            <div class = "col-md-2 col-4">
              <div class = "col-12 no-gutters text-center">
                <a href = "<?= $this->Url->build( array('controller' => 'users', 'action' => 'profile', $raffle['steamid'], '1') ) ?>">

                <img alt = "<?= $raffle['steamname']; ?>" style = 'width: 50px;' class="card-img" src='<?= $raffle['avatar'] ?>'; class="rounded-circle"; height = "50px"; alt="Card image cap" >
              </a>
              </div>
              <div class = "col-12 no-gutters text-center" style = "font-size: 10px">
                <?= $raffle['steamname'] ?>
              </div>
            </div>
            <div class = "row col-md-10 col-8  no-gutters">
              <?php
                foreach($raffle['items'] as $raff) {
                  $name = 'https://steamcommunity.com/economy/image/';
                  $name .= $raff['icon'];
                  $iname = $raff['name'];
                  echo "<div class = 'col-md-1 col-2' ;><img style = 'max-width: 100%;' data-toggle='tooltip'; data-placement='top'; title='$iname'; src = $name></img></div>";
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
        <div id = "amazon-ad" class="card col-md-12" style = "background-color:#DEF2F1; ">
          <div class = "card-header text-center">
            <p>Steamraffles advertisement</p>
          </div>
          <div class = "row card-body">
            <div class = "col-md-4">
              <iframe style="width:120px;height:240px;" marginwidth="0" marginheight="0" scrolling="no" frameborder="0" src="//ws-na.amazon-adsystem.com/widgets/q?ServiceVersion=20070822&OneJS=1&Operation=GetAdHtml&MarketPlace=US&source=ac&ref=tf_til&ad_type=product_link&tracking_id=17147-20&marketplace=amazon&region=US&placement=B01LXC1QL0&asins=B01LXC1QL0&linkId=6e5d8ac7887f76c5cd2827a85ac44c5f&show_border=false&link_opens_in_new_window=true&price_color=333333&title_color=0066c0&bg_color=ffffff">
    </iframe>
            </div>
            <div id = "hide-mobile" class = "col-md-4">
              <iframe style="width:120px;height:240px;" marginwidth="0" marginheight="0" scrolling="no" frameborder="0" src="//ws-na.amazon-adsystem.com/widgets/q?ServiceVersion=20070822&OneJS=1&Operation=GetAdHtml&MarketPlace=US&source=ac&ref=tf_til&ad_type=product_link&tracking_id=17147-20&marketplace=amazon&region=US&placement=B07DN8YWLW&asins=B07DN8YWLW&linkId=441e933221b61046a6c41de321680ef3&show_border=false&link_opens_in_new_window=true&price_color=333333&title_color=0066c0&bg_color=ffffff">
    </iframe>
            </div>
            <div id = "hide-mobile" class = "col-md-4">
              <iframe style="width:120px;height:240px;" marginwidth="0" marginheight="0" scrolling="no" frameborder="0" src="//ws-na.amazon-adsystem.com/widgets/q?ServiceVersion=20070822&OneJS=1&Operation=GetAdHtml&MarketPlace=US&source=ac&ref=tf_til&ad_type=product_link&tracking_id=17147-20&marketplace=amazon&region=US&placement=B016MAK38U&asins=B016MAK38U&linkId=e40e0a0bf316376f516531d437631900&show_border=false&link_opens_in_new_window=true&price_color=333333&title_color=0066c0&bg_color=ffffff">
    </iframe>
            </div>
          </div>
      </div>
    </section>

    <!-- About Section -->
    <section class="text-white mb-0" id="about" style =" background-color:#18bc9c!important">
      <div class="container">
        <h2 class="text-center text-uppercase text-white">About us</h2>
        <div class="row">
          <div class="col-lg-12 text-center">
            <p class="lead">Steamraffles is a legit giveaway site.  We do giveaways mostly ever day.  Win free items, and get free items for every friend you refer!</p>
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
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
});
//call the specific div (modal)
    $(window).on('load',function(){
        $('#myModal').modal('show');
    });
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

$(".js-close-modal").click(function(){
$('#myModal').modal('toggle');
});
<?php include 'timer.js'; ?>
</script>
