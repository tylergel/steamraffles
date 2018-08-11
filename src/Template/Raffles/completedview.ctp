<html>
<body style = "background-color: #18bc9c">
<?= $this->Flash->render(); ?>
<?php include 'ads/banner2.html'; ?>
<div class = "container">
  <div class="panel panel-defaul col-md-12 col-12" style = "background-color: white; top: 10px;">
    <div class = "panel-body col-md-12">
      <div class = "row" >
        <div class="col-md-12 text-center border-bottom border-dark">
          <h5>
            <?= $raffle['title'] ?>
          </h5>
        </div>
        <div class="col-md-12 text-center border-bottom border-dark">
          <h5>
            <?php
            $key = "637D92A81FBB0C9CDCA06C1F940E8178";
            $url = file_get_contents("https://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=".$key."&steamids=".$raffle['winner']);
            $content = json_decode($url, true);
            $ava = $content['response']['players'][0]['avatar'];
            $usersname = $content['response']['players'][0]['personaname'];
            $win = $content['response']['players'][0]['profileurl'];
            ?>
            <div class = "col-md-4 col-4 text-center">
              Winner:
            </div>
            <div class = "col-md-4 col-4 text-center">
              <a target = "_blank" href = "<?= $win ?>"><?= $usersname ?></a>
            </div>
            <div class = "col-md-4 col-4 text-center">
              <img style = 'max-width: 50px;'  data-toggle='tooltip'; data-placement='top'; src = <?= $ava ?>></img>
            </div>

          </h5>
        </div>
      </div>
      <div class = "row  border-bottom border-dark" >
        <div class="col-md-2 offset-md-2 col-4 text-center" >
          <a href = "<?= $this->Url->build( array('controller' => 'users', 'action' => 'profile', $raffle['userid']) ) ?>">
            <img style = 'min-width: 50px; height: 50px;' class="col-md-10" src='<?= $raffle['avatar'] ?>'; class="rounded-circle";  alt="Card image cap" >
          </a>
          <div class = "col-md-12 col-12 no-gutters" style = "font-size: 10px">
            <?= $raffle['steamname'] ?>
          </div>
        </div>
        <div class="row col-md-8 col-8" >
          <div class =  "row col-md-6 offset-md-3 text-center">
            Entries: <?=  $raffle['entry'] ?> /<?= $raffle['ent'] ?>
          </div>
          <div class = "row col-md-6 offset-md-3 col-12 text-center">
            Time left: <div class =  "aclass" id = <?= $raffle['id'] ?> name = <?= $raffle['time']; ?>></div>
          </div>
          <div class = "row col-md-6 offset-md-3 col-12 text-center">
            Chance: <?= $raffle['chance'] ?>
          </div>
        </div>
      </div>
      <div class="col-md-12 text-center" >
        <?= $raffle['message'] ?>
      </div>
      <form method = 'post'>
        <input type="hidden" id="raffleId" name="raffleId" value=<?= $id ?>>
      </form>
    </div>
    <div class="panel-body col-md-12 col-12">
      <div class = "panel-body col-md-12 col-12 no-gutters">
        <div class = "row col-md-12 col-12 no-gutters" style = 'background-color: gray'>
            <?php
              foreach($raffle['items'] as $raffl) {
                $name = 'https://steamcommunity.com/economy/image/';
                $name .= $raffl['icon'];
                $iname = $raffl['name'];
                echo "<div class = 'col-md-1 col-2'; data-toggle='tooltip'; data-placement='top'; title='$iname';><img style = 'max-width: 100%;' src = $name></img></div>";
              }
            ?>
        </div>
      </div>
    </div>
    <div class="panel-body col-md-12 col-12">
      <div class = "card-body col-md-12">
        <div class = "row col-md-12 col-12  no-gutters">
            <?php foreach($raffle['entries'] as $ra) {
              $key = "637D92A81FBB0C9CDCA06C1F940E8178";
              $url = file_get_contents("https://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=".$key."&steamids=".$ra['entry']);
              $content = json_decode($url, true);
              $ava = $content['response']['players'][0]['avatar'];
              $usersname = $content['response']['players'][0]['personaname'];
              echo "<div class = 'col-md-1 col-2';><img style = 'max-width: 50px;'  data-toggle='tooltip'; data-placement='top'; title='$usersname' src = $ava></img></div>";
            }
            ?>
        </div>
      </div>
    </div>
    </div>
    <div class="panel panel-default col-md-12 col-12" style = "background-color: white; top: 20px;">
      <div class = "panel-body col-md-12">
        <div class = "row col-md-12 col-12  no-gutters">
          <?php foreach($commentArray as $comment) {
            $com = $comment->comment;
            $img = $comment->avatar;
            $name = $comment->personaname;
            echo "
            <div class = 'row col-md-10 offset-md-1 col-10 offset-1 border'><div class=' col-8panel panel-default'>
            <div class='panel-heading'><img src = $img>$name</div>
            <div class='panel-body'>$com</div>
            </div>
          </div>";
          }
          ?>
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
$("#ads").click( function()
           {
             $.ajax({
           type: 'POST',
           url: '/raffles/view',
            data: {id: <?= $id ?>},
           success: function(data){
           }
       });
           }
        );

</script>
