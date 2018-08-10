<html>
<body   style = "background-color: #18bc9c">
    <div class = "container"  style = "margin-top: 100px;">
    <div class = "row">
    <div class="col-md-10 user-menu-container square">
        <div class="col-md-12 user-details">
            <div class="row coralbg white ">
              <div class="col-md-4 no-pad">
                  <div class="user-image text-center">
                      <img src="<?= $content['avatarfull'] ?>" style = "width: 25%; height: 25%">
                  </div>
              </div>
                <div class="col-md-8 no-pad ">
                    <div class="user-pad text-center">
                        <h6><?= $content['personaname'] ?></h6>
                        <h6> <?= ($content['personastate'] == 0) ? "<p style = 'color: red'>Offline</p>" : "<p style = 'color: green'>Online</p> "; ?></h4>
                          <h6>Joined: <?= $userdata->joined ?></h6>
                          <h6>Profile link: <a href = "<?= $content['profileurl'] ?>" target = "_blank">Steam profile link</a></h6>
                    </div>
                </div>

            </div>
            <div class="row overview" style = "height: 100px">
                <div class="col-md-4 col-4 user-pad text-center">
                    <h6>Raffles Created</h6>
                    <h6><?= $userdata->number ?></h6>
                </div>
                <div class="col-md-4 col-4 user-pad text-center">
                    <h6>
                        Likes
                     </h6>
                    <h6><?= $userdata->likes ?></h6>
                </div>
                <div class="col-md-4 col-4 user-pad text-center">
                    <h6>Donations</h6>
                    <h6><?= $userdata->donated ?></h6>
                </div>
            </div>

        </div>

        <div class="row-overview col-md-12 user-menu user-pad ">
            <div class="user-menu-content active text-center">
              <?php if($content['steamid'] == $_SESSION['steamid']) : ?>
                <i  id = 'edit' class="fa fa-pencil-square-o" aria-hidden="true" title = "edit">Edit my profile</i>
                <p> Trade offer url: <?= $userdata->tradeurl ?> </p>
              <?php endif ?>
                <h3 id = 'profiletitle'>
                    <?= $userprofile->profiletitle ?>
                </h3>
                <p id = 'profilebody'><?= $userprofile->profiledescription ?> </p>
                <form method = 'post' id = "form1" action="<?= $this->Url->build( array('controller' => 'users', 'action' => 'editprofile', $id) ) ?>" style = "display: none">
                  <input class = 'col-md-12' type = 'text' name = 'profiletitle' value = '<?= $userprofile->profiletitle ?>'></input>
                  <textarea class = 'col-md-12' id = 'profilebody' name = 'profilebody' value='<?= $userprofile->profiledescription ?>'><?= $userprofile->profiledescription ?></textarea>
                  <button id = 'submitform' type='submit' class='col-md-12 btn btn-success green'>Save</button>
                  <textarea class = 'col-md-12' id = 'profileurl' name = 'profileurl' value='<?= $userdata->tradeurl ?>'><?= $userdata->tradeurl ?></textarea>
                </form>
            </div>

        </div>

        <div class="panel col-md-12" >
        						<div class="widget-area no-padding blank">
    								<div class="status-upload">
    									<form method = "post">
                        <input id="owner" name="owner" type="hidden" value="<?= $id ?>">
                        <input id="steamid" name="steamid" type="hidden" value="<?= $_SESSION['steamid'] ?>">
    										<textarea id = "text" name = "text" placeholder="Leave this great member a comment!" ></textarea>
    										<button type="submit" class="btn btn-success green"><i class="fa fa-share"></i> Share</button>
    									</form>
    								</div>
    							</div>
    						</div>

    </div>
    <div class="col-md-2 col-12  user-menu-container square" style = "background-color: white;">
        <div class="user-menu-content" >
          <div class = "col-md-12 col-12">
            <h3 class = "text-center">
                Stats
            </h3>
            <p class = "text-center">Rank: #<?= $rank ?></p>
            <p class = "text-center">Total Score: <?= $userdata['score'] ?></p>
            <p class = "text-center">Referral Score: <?= $userdata['toclaim'] * 2 ?></p>
            <p class = "text-center">Raffles Entered: <?= $userdata['entered'] ?></p>
            <p class = "text-center">Raffles Won: <?= $userdata['won'] ?></p>
            <p class = "text-center">Comments: <?= $userdata['commentsleft'] ?></p>

          </div>
        </div>

    </div>

    <div class="col-md-12 col-12 user-menu-container square">
        <div class="col-md-12 col-12 " style = " background-color: white">
            <div class="comment-wrapper">
                <div class="panel panel-info">
                  <div class="panel-heading">
                        Comments
                    </div>
                    <div class="panel-body">
                      <?php if(isset($_SESSION['steamid'])) : ?>

                        <?php endif ?>
                        <div class="clearfix"></div>
                        <hr>
                        <ul class="media-list">
                          <?php foreach($usercommentsobj as $obj) : ?>
                            <?php
                            $url = file_get_contents("https://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=".$key."&steamids=".$obj->commenter);
                            $content = json_decode($url, true);
                            $ava = $content['response']['players'][0]['avatar'];
                            $name = $content['response']['players'][0]['personaname'];
                             ?>
                            <li class="media col-md-12 col-12">
                              <a href = "<?= $this->Url->build( array('controller' => 'users', 'action' => 'profile', $obj->commenterid) ) ?>">

                                    <img src="<?= $ava ?>" alt="" class="img-circle">
                                </a>
                                <div class="media-body">

                                    <strong class="text-success"><?= $name ?></strong>
                                    <p>
                                      <?= $obj->text ?>
                                    </p>
                                </div>
                            </li>
                              <?php endforeach ?>
                        </ul>
                    </div>
                </div>
            </div>

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

$("#edit").click( function()
         {
           $( "#form1" ).toggle( 'show' );
  } );


</script>
