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
  <div class="card col-md-10 offset-md-1 col-10 offset-1"  style = "top: 65px; overflow: hidden">
<center>
<script type="text/javascript">
  ( function() {
    if (window.CHITIKA === undefined) { window.CHITIKA = { 'units' : [] }; };
    var unit = {"calltype":"async[2]","publisher":"tylergel","width":320,"height":50,"sid":"Chitika Default"};
    var placement_id = window.CHITIKA.units.length;
    window.CHITIKA.units.push(unit);
    document.write('<div id="chitikaAdBlock-' + placement_id + '"></div>');
}());
</script>
<script type="text/javascript" src="//cdn.chitika.net/getads.js" async></script>
</center>
</div>
</div>
<div class = "row" >
  <div id = "body-element" class="card col-md-6 offset-md-3 col-10 offset-1"  style = "top: 65px; overflow: hidden; background-color: red">
<a class="row waves-effect waves-light btn" href = "http://zipansion.com/1p8Ao" target="_blank">Steamraffle sponsored advertisements</a>
</div>
</div>
  <div class = "row" >
    <div id = "body-element" class="card col-md-10 offset-md-1 col-10 offset-1"  style = "top: 100px;">
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
      <div class="card col-md-10 offset-md-1 col-10 offset-1"  style = "top: 100px;">
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
      <div class="card col-md-10 offset-md-1 col-10 offset-1"  style = "top: 100px;">
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
<div class = "row">
  <div class="card col-md-10 offset-md-1 col-10 offset-1"  style = "top: 100px;">
    <div class = "row "  style="border-style: solid; border-width: 1px;">
      <div class="col-md-4 text-center" >
        <a href = "https://go.oclasrv.com/afu.php?zoneid=1779348" target="_blank">Amazing Ads!</a>
      </div>
      <div class="col-md-4 text-center" >
        Entries: Everyone
      </div>
      <div class="col-md-4 text-center">
        Timeleft: Now
      </div>
    </div>
    <div class = "row" >
      <div class = "col-md-2 col-3 no-gutters" id = "body-element">
        <div class = "col-md-6 col-12 no-gutters">
          <img style = 'max-width: 100%;' class="card-img" src='/webroot/favicon.ico'; class="rounded-circle"; height = "70"; alt="Card image cap" >
        </div>
        <div class = "col-md-12 col-12 no-gutters" style = "font-size: 10px">
          Steamraffles advertisement
        </div>
      </div>
      <div class = "row col-md-10 col-9  no-gutters" id = "body-element" style = ' background-color: #18bc9c'>
        <div class="row col-md-12   no-gutters">
             <a class="row col-md-4 offset-md-4 no-gutters waves-effect waves-light btn" href = "https://go.oclasrv.com/afu.php?zoneid=1779348" target="_blank">Check out this offer! </a>
        </div>
      </div>
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
