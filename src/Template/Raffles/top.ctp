<html>

<div class = "container" style = " margin-top:100px;">
  <a target = "_blank" href="https://www.dpbolvw.net/click-8847778-13396680" >
  <img style = "width: 100%;" src="https://www.ftjcfx.com/image-8847778-13396680" alt=""  border="0"/></a>
</div>

<body style = "background-color: #18bc9c">

<div class="panel panel-default col-md-10 offset-1" style = "background-color: white; margin-top: 10px">
  <div  class = "panel-heading text-center"><h1>Top ranked rafflers</h1></div>
    <div class = "row" id = 'body-element'>
      <div class = "col-md-12 text-center">
        <a  class="waves-effect waves-light btn"  href = "<?= $this->Url->build( array('controller' => 'raffles', 'action' => 'top', 'score') ) ?>">Overall</a>
        <a  class="waves-effect waves-light btn" href = "<?= $this->Url->build( array('controller' => 'raffles', 'action' => 'top', 'donated') ) ?>">Top donators</a>
        <a  class="waves-effect waves-light btn"  href = "<?= $this->Url->build( array('controller' => 'raffles', 'action' => 'top', 'number') ) ?>">Most Raffles created</a>
        <a  class="waves-effect waves-light btn" href = "<?= $this->Url->build( array('controller' => 'raffles', 'action' => 'top', 'likes') ) ?>">Most likes</a>
        <a  class="waves-effect waves-light btn"  href = "<?= $this->Url->build( array('controller' => 'raffles', 'action' => 'top', 'toclaim') ) ?>">Most Referred</a>
      </div>
    </div>
    <br>
    <div class="row panel-body ">
      <?php $i = 0; ?>
      <?php  foreach($toparr as $top) : $i++; ?>
              <div class="row col-md-12">
                <?= $i ?>
                <?php
                  if($top['steamid']) {
                    $url = file_get_contents("https://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=".$key."&steamids=".$top['steamid']);
                    $content = json_decode($url, true);
                    $ava = $content['response']['players'][0]['avatar'];
                    $persona = $content['response']['players'][0]['personaname'];
                  ?>
                  <div class = 'col-md-3 col-12'>
                    <a href = "<?= $this->Url->build( array('controller' => 'users', 'action' => 'profile', $top['id']) ) ?>">
                      <img src = '<?= $ava ?>' width = '100' height = '100'>
                    </a>
                  </div>
                  <div class = 'col-md-8 col-12'> <?= $persona ?>'s score: <?= $top[$data] ?></div>
                  <?php } ?>
              </div>
      <?php endforeach;  ?>
    </div>
</div>
</body>
</html>
