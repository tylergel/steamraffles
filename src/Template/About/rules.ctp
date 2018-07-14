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
                <div class="row col-md-2 offset-md-5" id = 'body-element'>
                  <br>
                  <form method = "post">
                    <button type="submit" class="waves-effect waves-light btn">Verify me!
                  </form>
                </div>

        </div>
    </div>
  </div>

</body>

</html>
