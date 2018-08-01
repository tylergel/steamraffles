<html>
<body style = "background-color: #18bc9c">
<?php if(!isset($_GET['link'])) : ?>
<?php if($private) : ?>
  <div class="alert alert-danger" role="alert" style = "margin-top: 100px">
  <strong>Oh snap!</strong> Your profile may be set to private.  Change it to public to see your rewards.
</div>
<?php endif ?>
<?php if(!isset($_SESSION['steamid'])) : ?>
  <div class="alert alert-danger" role="alert" >
  <strong>Oh NO!</strong> You are not logged in.
  </div>
<?php endif; ?>
<div class = "container">
  <div class="panel panel-default" style = "background-color: white; margin-top: 100px">
    <div class = "panel-heading text-center"><h1>Your rewards</h1></div>
      <a href = "https://steamcommunity.com/id/tf2token/friends/?invitegid=103582791462607769">
        <div  class = "col-md-4 offset-md-4 btn btn-primary text-center" target="_blank">Invite your friends!  Free scrap :)</div>
      </a>
    <div class="row panel-body ">
        <div class = 'col-md-4 text-center'>
          Friends invited to group: <?= $friendGroup ?>
        </div>
        <div class = 'col-md-4 text-center'>
          Friends invited to website: <?= $friendWebsite ?>
        </div>
        <div class = 'col-md-4 text-center'>
          Referral score: <?= $total * 2 ?>
        </div>
        <div class = 'col-md-4 text-center'>
          Total Rewards: <?= $this->Html->image('scrap.png', ['alt' => 'scrap', 'width'=>'80px']); ?> x <?= $total ?>
        </div>
        <div class = 'row container col-md-8 text-center'>
          <div class = 'col-md-6 text-center'>
            Rewards to claim: <?= $this->Html->image('scrap.png', ['alt' => 'scrap', 'width'=>'80px']); ?> x <?= $total - $umtotal ?>
          </div>
          <div  class = "col-md-6  text-center" target="_blank" ><?= $this->Html->image('gift.png', ['alt' => 'scrap', 'width'=>'80px']); ?><a target="_blank" class = " btn btn-light text-center" href = "https://steamcommunity.com/tradeoffer/new/?partner=98405119&token=DroQxIW6">Request rewards</a></div>
        </div>
    </div>
  </div>
  <?php endif; ?>
  <div id = "myDiv" class="panel panel-default" style = "background-color: white; margin-top: 20px">
    <div id = "thing" class = "panel-heading text-center"><h1>Your Friends</h1></div>
    <button type="button"  id = "friends" class = "col-md-12 text-center">View all friends</button>
    <br>
    <div class="row panel-body ">
      <?php
      $req = 0;
       foreach($totalArray as $mem) : ?>
      <?php
      $req = $req + 1;
      if(!isset($_GET['link'])) {
        if($req > 5) break;
      }
        $url = file_get_contents("https://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=".$key."&steamids=".$mem['steamid']);
      	$content = json_decode($url, true);
      ?>
      <div class = "row col-md-12">
      <div class = 'col-md-4'>
        <a href = <?= $content['response']['players'][0]['profileurl'] ?>>
          <img src = <?= $content['response']['players'][0]['avatarmedium'] ?> style = "width: 50px; height: 50px">
          <?= $content['response']['players'][0]['personaname'] ?>
        </a>
      </div>
        <?php if($mem['claimed'] == '1') : ?>
            <div class = 'col-md-8 text-center'>
            This user has already been referred by someone else
          </div>
        <?php endif; ?>
        <?php if(isset($mem['alt'])) : ?>
          <div class = 'col-md-8 text-center'>This user is a possible alt </div>
        <?php endif ?>
        <?php if($mem['claimed'] == '0' && !isset($mem['alt']) ) : ?>
      <div class = 'col-md-4 text-center'>
        On website:
        <?php if($mem['website'] == '1') : ?>
          <i class="fa fa-check" style = "color: green" aria-hidden="true"></i>
        <?php endif ?>
        <?php if($mem['website'] == '0') : ?>
          <i class="fa fa-times" style = "color: red" aria-hidden="true"></i>
        <?php endif ?>
      </div>
      <div class = 'col-md-4 text-center'>
        In group:
        <?php if($mem['group'] == '1') : ?>
          <i class="fa fa-check" style = "color: green" aria-hidden="true"></i>
        <?php endif ?>
        <?php if($mem['group'] == '0') : ?>
          <i class="fa fa-times" style = "color: red" aria-hidden="true"></i>
        <?php endif ?>
      </div>
      <?php endif; ?>
    </div>
    <br>
      <?php endforeach ?>

    </div>

  </div>
</div>
</body>
</html>
<script>
$("#friends").click( function() {
  $( "#thing" ).append( "<div class = 'load'>Loading all friends...Please wait, this will take a minute</div>" );

    $("#myDiv").load("<?= $this->Url->build( array('controller' => 'users', 'action' => 'rewards') ) ?>?link=1", function() {
      $( ".load" ).remove();
      $( "#friends" ).remove();
  });

  }
);
</script>
