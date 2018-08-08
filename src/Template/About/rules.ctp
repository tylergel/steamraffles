<html>
<?= $this->Flash->render();  ?>
<body style = "background-color: #18bc9c">
  <div class = "container">
  <div class = "panel panel-default">
    <div class="panel-heading row " style=" text-decoration: underline;">
        <div id="body-element" class="panel-heading col-md-10 offset-md-1 col-10 offset-1 text-center" style="background-color: white!important; top: 100px;">
            <div class="row  col-md-12">
                <?= $this->Flash->render() ?>
                    <h5 class="col-md-12 col-12">Rules</h5>
            </div>
        </div>
    </div>
    <div class="panel-body row ">
        <div class="col-md-10 offset-md-1 col-10 offset-1" style="background-color: white; top: 100px;">
            <div >
                <p class="text-center">
                    1) No links to unapproved websites.
                </p>
                <p class="text-center">
                    2) No profanity, inappropriate images, or texts are allowed on this site.
                </p>
                <p class="text-center">
                    3) No harassment or abuse of any kind.
                </p>
                <p class="text-center">
                    4) No scamming of any kind allowed.
                </p>
            </div>
        </div>
    </div>
    <div class="panel-heading row" style=" text-decoration: underline;">

        <div id="body-element" class="col-md-10 offset-md-1 col-10 offset-1 text-center" style="background-color: white; top: 100px;">
            <div class="row card-title col-md-12">
                <h5 class="col-md-12 col-12">Raffle Rules</h5>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-10 offset-md-1 col-10 offset-1" style="background-color: white; top: 100px;">

                  <p class="text-center">
                    1) Only one entry per user. No alternate accounts are allowed.
                </p>
                  <p class="text-center">
                    2) Raffle items must be traded through steam.
                </p>
                  <p class="text-center">
                    3) Paid raffles are not allowed. All raffles will be free to enter.
                </p>
                  <p class="text-center">
                    4) No inappropriate content will be allowed anywhere on the site. This includes raffle titles, notes, and comments.
                </p>
                  <p class="text-center">
                    5) No scripts or bots can be used to take advantage of the website.
                </p>
                <p class="text-center">
                  6) You must be verified to create raffles. To do so you must have entered 5 raffles, have 200+ total hours played, and not be marked as a scammer.
                </p>
                <p class="text-center">
                  7) Your profile must be public to claim winnings and create raffles.
                </p>
                <div class="row col-md-2 offset-md-5" id = 'body-element'>
                  <br>
                  <form method = "post">
                      <button type="button" class="waves-effect waves-light btn" data-toggle="modal" data-target="#myModal">Verify me!</button>
                    <div class="modal fade" id="myModal" role="dialog">
                      <div class="modal-dialog  text-center">

                        <!-- Modal content-->
                        <div class="modal-content  text-center">
                          <div class="row modal-header text-center">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h5 class="modal-title text-center">Enter trade offer url</h4>
                          </div>
                          <div class="modal-body">
                            <p>To get your trade offer url, follow these steps.</p>
                            <p>-Log into Steam Client open your Inventory.</p>
                            <p>-Click the "Trade Offers" button on the right.</p>
                            <p>-Click on "Who can send me Trade Offers".</p>
                            <p>-Copy your trade offer url and place it here.</p>
                            <input id = "tradeurl" name = "tradeurl" type = "text" placeholder = "https://steamcommunity.com/tradeoffer/new/?partner=xxx&token=xxx"></input>
                          </div>
                          <div class="modal-footer text-center">
                            <button type="Submit" class="waves-effect waves-light btn" >Verify me</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          </div>
                        </div>

                      </div>
                    </div>

                  </form>
                </div>
        </div>
    </div>
  </div>
</body>
</html>
