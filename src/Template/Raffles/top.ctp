<html>

<body class = "background">

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
      <div  class="row card-title col-md-10" >
        <?= $this->Flash->render() ?>
        <h5 class = "col-md-4 col-12">Top rafflers</h5>
      </div>
    </div>
  </div>
  <?php $i = 0; ?>
  <?php  foreach($toparr as $top) : $i++; ?>
    <div class = "row" >
      <div class="card col-md-10 offset-md-1 col-10 offset-1"  style = "top: 100px;">
        <div class = "row">
          <div class="row col-md-12"><?= $i ?>
            <?php
              if($top['steamid']) {
                $url = file_get_contents("https://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=".$key."&steamids=".$top['steamid']);
                $content = json_decode($url, true);
                $ava = $content['response']['players'][0]['avatar'];
                $persona = $content['response']['players'][0]['personaname'];
                $number = $top['number'];
                ?>
                <div class = 'col-md-3 col-12'>
              <a href = "<?= $this->Url->build( array('controller' => 'users', 'action' => 'profile', $top['id']) ) ?>">
                <img src = '<?= $ava ?>' width = '100' height = '100'>
                </a>
                </div>
                <div class = 'col-md-8 col-12'> <?= $persona ?> has created <?= $number ?> raffles</div>
                <?php
              }
            ?>
          </div>
        </div>
      </div>
    </div>
  <?php endforeach;  ?>

<div class = "row" >
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
      <div class = "col-md-2 col-3" id = "body-element">
        <div class = "col-md-6 col-12 no-gutters">
          <img style = 'max-width: 100%;' class="card-img" src='/webroot/favicon.ico'; class="rounded-circle"; height = "70"; alt="Card image cap" >
        </div>
        <div class = "col-md-12 col-12 no-gutters" style = "font-size: 10px">
          Steamraffles advertisement
        </div>
      </div>
      <div class = "row col-md-10 col-9  no-gutters" id = "body-element" style = 'background-color: #18bc9c'>
        <div class="row col-md-12 no gutters">
             <a class="row no gutters col-md-4 offset-md-4 waves-effect waves-light btn" href = "https://go.oclasrv.com/afu.php?zoneid=1779348" target="_blank">Check out this offer! </a>
        </div>
      </div>
    </div>
  </div>
</div>

</body>
</html>
