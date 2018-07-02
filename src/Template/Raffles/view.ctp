<html>
<body class = "background">
<?= $this->Flash->render(); ?>
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
<div  class = "row no-gutters">
  <div class="card col-md-8 offset-md-2 col-10 offset-1" style = "top: 100px;">
    <div class = "card-body col-md-12">
      <div class = "row" >
        <div class="col-md-12 text-center border-bottom border-dark">
          <h5>
            <?= $raffle['title'] ?>
          </h5>
        </div>
      </div>
      <div class = "row  border-bottom border-dark" >
        <div class="col-md-2 offset-md-2 col-4 text-center" >
          <img style = '' class="card-img col-md-10" src='<?= $raffle['avatar'] ?>'; class="rounded-circle"; height = "70"; alt="Card image cap" >
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
        <?php if(isset($_SESSION['steamid'])) : ?>
          <div class="col-md-12 col-12 text-center" style = "font-color: white; font-size: .75rem">
            <form>
              <button type="submit" id = "ads" class="waves-effect waves-light btn">Enter now
            </form>
          </div>
        <?php endif ?>
        <?php if(!isset($_SESSION['steamid'])) : ?>
          <div class="col-md-12 col-12 text-center" style = "font-color: white; font-size: .75rem">
            <button type="button" class="waves-effect waves-light btn">You must sign in</button>
          </div>
        <?php endif ?>
      </form>
    </div>
  </div>
</div>

<div  class = "row no-gutters">
  <div class="card col-md-8 offset-md-2 col-10 offset-1" style = "top: 100px;">
    <div class = "card-body col-md-12">
      <div class = "row col-md-12 col-12  no-gutters" style = 'background-color: gray'>
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
</div>
<div  class = "row no-gutters">
  <div class="card col-md-8 offset-md-2 col-10 offset-1" style = "top: 100px;">
    <div class = "card-body col-md-12">
      <div class = "row col-md-12 col-12  no-gutters">
          <?php foreach($raffle['entries'] as $ra) {
            $key = "637D92A81FBB0C9CDCA06C1F940E8178";
            $url = file_get_contents("https://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=".$key."&steamids=".$ra['entry']);
            $content = json_decode($url, true);
            $ava = $content['response']['players'][0]['avatar'];
            $usersname = $content['response']['players'][0]['personaname'];
            echo "<div class = 'col-md-1 col-2';><img style = 'max-width: 100%;'  data-toggle='tooltip'; data-placement='top'; title='$usersname' src = $ava></img></div>";
          }
          ?>
      </div>
    </div>
  </div>
</div>

<?php if(isset($_SESSION['steamid'])) : ?>
<div  class = "row no-gutters">
  <div class="card col-md-8 offset-md-2 col-10 offset-1" style = "top: 100px;">
    <div class = "card-body col-md-12">
      <div class = "row col-md-12 col-12  no-gutters">
          <form method = "post" class="col-md-12">
            <input class = "col-md-12 form-control" type = "text" name = "comment" placeholder="Leave a comment">
          </form>
      </div>
    </div>
  </div>
</div>
<?php endif ?>

<div  class = "row no-gutters">
  <div class="card col-md-8 offset-md-2 col-10 offset-1" style = "top: 100px;">
    <div class = "card-body col-md-12">
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

<?php include 'timer.js'; ?>
</script>
