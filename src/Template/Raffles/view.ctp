<html>
<body style = "background-color: #18bc9c">
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
<div class = "row panel col-md-10 offset-md-1 col-10 offset-1" style = "background-color: white; top: 100px">
  <div class="panel-body col-md-12 col-12" >
        <div class="col-md-12 text-center border-bottom border-dark">
          <h5>
            <?= $raffle['title'] ?>
          </h5>
      </div>
      <div class = "row  border-bottom border-dark" >
        <div class="col-md-2 offset-md-2 col-4 text-center" >
          <a href = "<?= $this->Url->build( array('controller' => 'users', 'action' => 'profile', $raffle['userid']) ) ?>">
          <img style = '' class="card-img col-md-10" src='<?= $raffle['avatar'] ?>'; class="rounded-circle"; height = "70"; alt="Card image cap" >
        </a>
          <div class = "col-md-12 col-12 no-gutters" style = "font-size: 10px">
            <?= $raffle['steamname'] ?>
          </div>
          <i id = "like" class="fa fa-thumbs-up btn btn-info btn-sm" aria-hidden="true">Like this raffle</i>

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

  <div class="panel-body col-md-12 col-12" style = "margin-top: 25px">
    <div class = "panel-body col-md-12">
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
<div class = "panel-body col-md-12" style = "margin-top: 25px">
  <div class="col-md-12 col-12">
    <div class = "col-md-12">
      <div class = "row col-md-12 col-12  no-gutters">
          <?php foreach($raffle['entries'] as $ra) {
            $key = "637D92A81FBB0C9CDCA06C1F940E8178";
            $url = file_get_contents("https://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=".$key."&steamids=".$ra['entry']);
            $content = json_decode($url, true);
            $ava = $content['response']['players'][0]['avatar'];
            $usersname = $content['response']['players'][0]['personaname']; ?>
            <div class = 'col-md-1 col-2'>
              <a href = "<?= $this->Url->build( array('controller' => 'users', 'action' => 'profile', $ra['userid']) ) ?>">
                 <img style = 'max-width: 100%;'  data-toggle='tooltip'; data-placement='top'; title='<?= $usersname ?>' src = <?= $ava ?>>
               </a>
            </div>

            <?php
          }
          ?>
      </div>
    </div>
  </div>
</div>
</div>

            <div class="panel panel-info col-md-10 offset-md-1 col-10 offset-1" style = " background-color: white; margin-top: 100px">
              <div class="panel-heading">
                    Comments
                </div>
                <div class="panel-body">
                  <?php if(isset($_SESSION['steamid'])) : ?>
                    <form method = "post" class="col-md-12">
                      <input class = "col-md-12 form-control" type = "text" name = "comment" placeholder="Leave a comment">
                    </form>
                    <?php endif ?>
                    <div class="clearfix"></div>
                    <hr>
                    <ul class="media-list">
                      <?php foreach($commentArray as $comment) : ?>
                        <?php
                        $com = $comment->comment;
                        $img = $comment->avatar;
                        $name = $comment->personaname;
                        $time = time() - $comment->timemade;
                        $time = round($time/60);
                         ?>
                        <li class="media">
                          <a href = "<?= $this->Url->build( array('controller' => 'users', 'action' => 'profile', $comment->userid) ) ?>">

                                <img src="<?= $img ?>" alt="" class="img-circle">
                            </a>
                            <div  class="media-body">
                                    <small class="row pull-right text-muted"><?= $time ?> minutes ago</small>

                                <strong class="text-success"><?= $name ?></strong><small class = 'flyout' style='display: none'>reply</small>
                                <p>
                                  <?= $com ?>
                                  <?php if($comment->steamid == $_SESSION['steamid']) : ?>
                                        <i alt = <?= $comment->id ?>  class="delete pull-right fa fa-trash" title = "delete"  aria-hidden="true"></i>
                                  <?php endif ?>
                                </p>
                                <p>
                                  <form method = 'post' class = "form1" action="<?= $this->Url->build( array('controller' => 'raffles', 'action' => 'replycomment', $comment->id, $id) ) ?>" style = "display: none">
                                    <textarea class = 'form2 col-md-12' id = 'profilebody' name = 'reply'></textarea>
                                    <button id = 'submitform' type='submit' class='col-md-12 btn btn-success blue'>Reply</button>
                                  </form>
                                  </p>
                            </div>



                            <?php foreach($comment->replys as $reply) : ?>
                              <?php
                              $replycom = $reply->comment;
                              $replyimg = $reply->avatar;
                              $replyname = $reply->personaname;
                              $replytime = time() - $reply->timemade;
                              $replytime = round($replytime/60);
                               ?>
                              <li class="media col-md-11 offset-md-1">
                                <a href = "<?= $this->Url->build( array('controller' => 'users', 'action' => 'profile', $reply->userid) ) ?>">

                                      <img src="<?= $img ?>" alt="" class="img-circle">
                                  </a>
                                  <div  class="media-body">
                                          <small class="row pull-right text-muted"><?= $replytime ?> minutes ago</small>

                                      <strong class="text-success"><?= $replyname ?></strong><small class = 'flyout' style='display: none'>reply</small>
                                      <p>
                                        <?= $replycom ?>
                                        <?php if($reply->steamid == $_SESSION['steamid']) : ?>
                                              <i alt = <?= $reply->id ?>  class="delete pull-right fa fa-trash" title = "delete"  aria-hidden="true"></i>
                                        <?php endif ?>
                                      </p>

                                  </div>
                              </li>
                                <?php endforeach ?>
                        </li>
                          <?php endforeach ?>
                    </ul>
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
        $("#like").click( function()
                   {
                     $.ajax({
                      url : '<?= $this->Url->build( array('controller' => 'raffles', 'action' => 'like', $id, $_SESSION['steamid'], $raffle['steamid']) ) ?>',
                      type: 'POST',
                      success : function(response){
                        location.reload();
                      }
                      });
                   }
                );
        $(".media-body").hover(function(){
            $(this).find( ".flyout" ).show();
        },function(){
            $(this).find( ".flyout" ).hide();
        });
        $(".media-body").click( function(e)
                 {
                    if(e.target.className !== "form2 col-md-12") {
                        $(this).find( ".form1" ).toggle( 'slow' );
                      }

          } );
        $(".delete").click( function()
                   {
                     $.ajax({
                      url : '<?= $this->Url->build( array('controller' => 'raffles', 'action' => 'deletecomment') ) ?>',
                      type: 'POST',
                      data: {id: $(this).attr('alt')},
                      success : function(response){
                        location.reload();
                      }
                      });
                   }
                );
<?php include 'timer.js'; ?>
</script>
