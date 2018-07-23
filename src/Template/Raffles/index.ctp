<!DOCTYPE html>
<html>

<?= $this->Flash->render();  ?>
<body   style = "background: url('<?= $this->Url->image($mode . '.png'); ?>') no-repeat center center fixed;
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    background-size: cover;
    height: 100%;  background-attachment: fixed;">
    
  <div class = "row" >
    <div id = "body-element" class="card col-md-10 offset-md-1 col-10 offset-1"  style = "top: 10px;">
      <div class="row card-title col-md-10" >
        <h5 class = "col-md-4 col-12 text-center"><?= $mode ?> raffles</h5>
        <h5 class="dropdown show col-md-4 col-12 text-center" >
          <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Change Game
          </a>
          <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
            <a class="dropdown-item" href="all">All</a>
            <?php foreach($apps as $app) { ?>
              <a class='dropdown-item' href= <?= $this->Url->build( array('controller' => 'Raffles', 'action' => 'index', $app->app) ) ?>><?=$app->app?></a>
            <?php } ?>
          </div>
        </h5>
        <h5 class = "col-md-4 col-12 text-center">
          <a href = "<?= $this->Url->build( array('controller' => 'Raffles', 'action' => 'create', $mode) ) ?>" ><i class="fa fa-plus-circle" style = 'color: black' aria-hidden="true">Create Raffle</i></a>
        </h5>
      </div>
    </div>
  </div>
  <?php if(empty($rafflearray)) : ?>
    <div class = "row">
      <div class="card col-md-10 offset-md-1 col-10 offset-1"  style = "top: 10px;">
        <div class = "row "  style="border-style: solid; border-width: 1px;">

        </div>
        <div class = "row no-gutters" >
          <div class = "col-md-2 col-3" id = "body-element">
            <div class = "col-md-6 col-12 no-gutters">
              <img style = 'max-width: 100%;' class="card-img" src='/webroot/favicon.ico'; class="rounded-circle"; height = "70"; alt="Card image cap" >
            </div>
            <div class = "col-md-12 col-12 no-gutters" style = "font-size: 10px">
              Steamraffles Alert
            </div>
          </div>
          <div class = "row col-md-10 col-9  no-gutters" id = "body-element" style = 'background-color: #18bc9c'>
            <div class="row col-md-12">
                 <div class="row col-md-6 offset-md-3">
                   There are currently no raffles here! Sorry ):
                 </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  <?php endif; ?>

  <?php foreach($rafflearray as $raffle) :  ?>
    <div class = "row" >
      <div class="card col-md-10 offset-md-1 col-10 offset-1"  style = "top: 10px;">
        <div class = "row "  style="border-style: solid; border-width: 1px;">
          <div class="col-md-4 text-center" >
            <?= $this->Html->link($raffle['title'], ['controller' => 'Raffles', 'action' => 'view', $raffle['id']]); ?>
          </div>
          <div class="col-md-4 text-center" >
            Entries: <?= $raffle['entry'] ?>/ <?= $raffle['entries']; ?>
          </div>
          <?php if($raffle['inactive'] == '0') : ?>
          <div class="aclass col-md-4 text-center" id = <?= $raffle['id'] ?> name = <?= $raffle['time']; ?>>
            Timeleft:
          </div>
        <?php endif ?>
        <?php if($raffle['inactive'] == '1') : ?>
        <div class="col-md-4 text-center"?>>
         raffle is completed
        </div>
      <?php endif ?>
        </div>
        <div class = "row" >
          <div class = "col-md-2 col-3   no-gutters" id = "body-element">
            <div class = "col-md-6 col-12 no-gutters">
              <a href = "<?= $this->Url->build( array('controller' => 'users', 'action' => 'profile', $raffle['userid']) ) ?>">
                <img style = 'max-width: 100%;' class="card-img" src='<?= $raffle['avatar'] ?>'; class="rounded-circle"; height = "70"; alt="Card image cap" >
              </a>
            </div>
            <div class = "col-md-12 col-12 no-gutters" style = "font-size: 10px">
              <?= $raffle['steamname'] ?>
            </div>
          </div>
          <div class = "row col-md-10 col-9 no-gutters" style = 'background-color: gray'>
              <?php
                foreach($raffle['items'] as $raffle) {
                  $name = 'https://steamcommunity.com/economy/image/';
                  $name .= $raffle['icon'];
                  $iname = $raffle['name'];
                  echo "<div class = 'col-md-1 col-2' ;><img style = 'max-width: 100%;' data-toggle='tooltip'; data-placement='top'; title='$iname'; src = $name></img></div>";
                }
              ?>
          </div>
        </div>
      </div>
    </div>
  <?php endforeach;  ?>

  <!-- Ad -->
  <div id = "amazon-ad" class="card col-md-10 offset-md-1 col-10 offset-1" style = "top: 20px ;background-color:white; ">
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
</body>
</html>
<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
});
<?php include 'timer.js'; ?>
</script>
