<html>
<?php include 'ads/banner1.html'; ?>
<body style = "background-color: #18bc9c">
<div class = "container-fluid col-md-10 offset-md-1">
  <div class="panel panel-default col-md-12" style = "background-color: white; margin-top: 10px">
    <div  class = "panel-heading text-center"><h1>Top ranked rafflers</h1></div>
      <div class = "row" id = 'body-element'>
        <div class = "col-md-12 text-center">
          <a  class="waves-effect waves-light btn col-md-2 col-12"  href = "<?= $this->Url->build( array('controller' => 'raffles', 'action' => 'top', 'score') ) ?>">Overall</a>
          <a  class="waves-effect waves-light btn col-md-2 col-12" href = "<?= $this->Url->build( array('controller' => 'raffles', 'action' => 'top', 'donated') ) ?>">Top donators</a>
          <a  class="waves-effect waves-light btn col-md-3 col-12"  href = "<?= $this->Url->build( array('controller' => 'raffles', 'action' => 'top', 'number') ) ?>">Most Raffles created</a>
          <a  class="waves-effect waves-light btn col-md-2 col-12" href = "<?= $this->Url->build( array('controller' => 'raffles', 'action' => 'top', 'likes') ) ?>">Most likes</a>
          <a  class="waves-effect waves-light btn col-md-2 col-12"  href = "<?= $this->Url->build( array('controller' => 'raffles', 'action' => 'top', 'toclaim') ) ?>">Most Referred</a>
        </div>
      </div>
      <br>
      <div class="row panel-body ">
        <?php $i = 0; ?>
        <?php  foreach($toparr as $top) : $i++; ?>
                <div class="row col-md-12 col-12">
                  <div class = "col-1">
                  <?= $i ?>)
                </div>
                  <?php 
                    if($top['steamid']) {
                      $url = file_get_contents("https://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=".$key."&steamids=".$top['steamid']);
                      $content = json_decode($url, true);
                      $ava = $content['response']['players'][0]['avatar'];
                      $persona = $content['response']['players'][0]['personaname'];
                    ?>
                    <div class = 'col-md-3 col-11 text-center'>
                      <a href = "<?= $this->Url->build( array('controller' => 'users', 'action' => 'profile', $top['id']) ) ?>">
                        <img src = '<?= $ava ?>' width = '100' height = '100'>
                      </a>
                    </div>
                    <div class = 'col-md-8 col-12 text-center'> <?= $persona ?>'s score: <?= $top[$data] ?></div>
                    <?php } ?>
                </div>
        <?php endforeach;  ?>
      </div>
  </div>
</div>
</body>
</html>
