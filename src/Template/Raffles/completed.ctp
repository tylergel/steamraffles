<html>
<?php include 'ads/banner1.html'; ?>
<?php include 'ads/popads.js'; ?>
<body style = "background-color: #18bc9c">
<div class = "container">
    <div id = "body-element" class="row panel panel-default text-center"  style = "background-color: white; top: 10px;">
        <?= $this->Flash->render() ?>
        <h5 class="row">Completed Raffles</h5>
    </div>
    <br>
<?php  foreach($rafflearray as $raffle) :  ?>
  <?php
        $name = "No one";
        $ava = NULL;
        if(!($raffle['winner'] == 'NULL' || $raffle['winner'] == NULL)) {
        $url = file_get_contents("https://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=".$key."&steamids=".$raffle['winner']);
        $content = json_decode($url, true);
        $ava = $content['response']['players'][0]['avatar'];
        $name = $content['response']['players'][0]['personaname'];
      }
      ?>

    <div id = "body-element" class="panel panel-default"  style = "background-color: white; top: 10px;">
      <div class = "panel-heading">
        <div class = "row">
          <div class="col-md-6 text-center">
            <?= $this->Html->link($raffle['title'], ['controller' => 'Raffles', 'action' => 'completedview', $raffle['id']]); ?>
          </div>
          <div class="aclass col-md-6 text-center" id = <?= $raffle['id'] ?> name = <?= $raffle['time']; ?>>
            Congratulations to <?= $name ?>
          </div>
        </div>
      </div>
      <div class = "panel-body" style = "background-color: #0E6DBD">
        <div class = "row">
          <div class = "col-md-2 col-4">
            <div class = "col-md-6 col-12">
              <a href = "<?= $this->Url->build( array('controller' => 'users', 'action' => 'profile', $raffle['steamid'], '1') ) ?>">

              <img style = 'min-width: 100%;' class="card-img" src='<?= $raffle['avatar'] ?>'; class="rounded-circle"; height = "100%"; alt="Card image cap" >
            </a>
            </div>
            <div class = "col-md-12 col-12" style = "font-size: 10px">
              <?= $raffle['steamname'] ?>
            </div>
          </div>
          <div class = "col-md-5 col-8" style = 'background-color: #0E6DBD'>

                  <div class = 'row col-md-4 col-4'>
                    <?php if($raffle['winner'] != NULL) : ?>
                    <a href =   <?= $this->Url->build( array('controller' => 'users', 'action' => 'profile', $raffle['winner'], '1') ) ?>>
                        <img src = <?= $ava ?> width = '50' height = '50'></img>
                    </a>
                  <?php endif ?>
                </div>

          </div>
          <div class = "col-md-5 col-12 text-center" style = 'background-color: #0E6DBD'>
            <a href = "<?= $raffle['tradeurl']; ?>" target="_blank">
              <div  class = "col-md-4 btn btn-primary text-center"  style = "min-width:100%">Send trade offer</div>
            </a>
          </div>
        </div>
      </div>
    </div>
<?php endforeach;  ?>
</div>
</html>
