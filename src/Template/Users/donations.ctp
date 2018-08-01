<html>

<?php include 'ads/banner1.html'; ?>
<body style = "background-color: #18bc9c">
<div class = "container-fluid col-md-10 offset-md-1">
  <div class="panel panel-default" style = "background-color: white; margin-top: 10px">
    <div class = "panel-heading text-center"><h1>Show your love by donating</h1></div>
      <div class = "panel-body">
          <div  class = "col-md-12 text-center" >
            Hey everyone! Donations keep this website alive.  If you are feeling kind, feel free to donate.  It is greatly appreciated. :D
          </div>
          <a href = "https://steamcommunity.com/tradeoffer/new/?partner=98405119&token=DroQxIW6">
            <div  class = "col-md-4 offset-md-4 btn btn-danger text-center" target="_blank">I appreciate this site! <i class="fa fa-heart" aria-hidden="true"></i><i class="fa fa-heart" aria-hidden="true"></i></div>
          </a>
      </div>
  </div>
  <div class="panel panel-default" style = "background-color: white; margin-top: 20px">
    <div  class = "panel-heading text-center"><h1>Recent Donators</h1></div>
    <br>
    <div class="row panel-body ">
      <?php foreach($donators as $don) :
        $url = file_get_contents("https://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=".$key."&steamids=".$don->steamid);
      	$content = json_decode($url, true);
        ?>

      <div class = "row col-md-12" >
        <div class = 'col-md-4'>
          <a href = <?= $this->Url->build( array('controller' => 'users', 'action' => 'profile', $don->id) ) ?>>
            <img src = <?= $content['response']['players'][0]['avatarmedium'] ?> style = "width: 50px; height: 50px">
            <?= $content['response']['players'][0]['personaname'] ?>
          </a>
        </div>
        <div class = 'col-md-8 text-center'>
          Total donations: <?= $don->donated ?>
        </div>
      </div>
      <?php endforeach ?>
    </div>
  </div>
</div>
</body>
</html>
