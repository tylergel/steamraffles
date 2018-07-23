<html>
<body class = "background">
  <div class = "container" style = " margin-top:100px;">
    <a target = "_blank" href="https://www.dpbolvw.net/click-8847778-13396680" >
    <img style = "width: 100%;" src="https://www.ftjcfx.com/image-8847778-13396680" alt=""  border="0"/></a>
  </div>
  <div class = "row" >
    <div id = "body-element" class="card col-md-10 offset-md-1 col-10 offset-1"  style = "top: 10px;">
        <?= $this->Flash->render() ?>
        <h5 class="row card-title">Completed Raffles</h5>
    </div>
  </div>

<?php  foreach($rafflearray as $raffle) :  ?>
  <div class = "row" >
    <div class="card col-md-10 offset-md-1 col-10 offset-1"  style = "top: 10px;">
      <div class = "row"  style="border-style: solid; border-width: 1px;">
        <div class="col-md-6 text-center">
          <?= $this->Html->link($raffle['title'], ['controller' => 'Raffles', 'action' => 'completedview', $raffle['id']]); ?>
        </div>
        <div class="aclass col-md-6 text-center" id = <?= $raffle['id'] ?> name = <?= $raffle['time']; ?>>
          WINNER!
        </div>
      </div>
      <div class = "row" >
        <div class = "col-md-2 col-4">
          <div class = "col-md-6 col-12">
            <a href = "<?= $this->Url->build( array('controller' => 'users', 'action' => 'profile', $raffle['steamid'], '1') ) ?>">

            <img style = 'max-width: 100%;' class="card-img" src='<?= $raffle['avatar'] ?>'; class="rounded-circle"; height = "70"; alt="Card image cap" >
          </a>
          </div>
          <div class = "col-md-12 col-12" style = "font-size: 10px">
            <?= $raffle['steamname'] ?>
          </div>
        </div>
        <div class = "row col-md-10 col-8 d-flex justify-content-center no-gutters" style = 'background-color: #33FF48'>
            <?php
              if($raffle['winner']) {
                $url = file_get_contents("https://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=".$key."&steamids=".$raffle['winner']);
              	$content = json_decode($url, true);
              	$ava = $content['response']['players'][0]['avatar'];
                $name = $content['response']['players'][0]['personaname']; ?>
                <div class = 'row col-md-12 col-12'>Congratulations to <?= $name ?></div>
                <div class = 'row col-md-4 col-4'>
                  <a href =   <?= $this->Url->build( array('controller' => 'users', 'action' => 'profile', $raffle['winner'], '1') ) ?>>
              <img src = <?= $ava ?> width = '50' height = '50'></img></a></div>
                <?php
              }
              else {
                echo "No one has won this raffle ):";
              }
            ?>
        </div>
      </div>
    </div>
  </div>
<?php endforeach;  ?>

</html>
