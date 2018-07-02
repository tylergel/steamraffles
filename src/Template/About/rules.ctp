<html>
<?= $this->Flash->render();  ?>
<body class = "background">

    <div class="row">

        <div id="body-element" class="card col-md-10 offset-md-1 col-10 offset-1 text-center" style="background-color: #18bc9c!important; top: 100px;">
            <div class="row card-title col-md-12">
                <?= $this->Flash->render() ?>
                    <h5 class="col-md-12 col-12">Rules</h5>

            </div>

        </div>
    </div>
    <div class="row">

        <div id="body-element" class="card col-md-10 offset-md-1 col-10 offset-1 text-center" style="background-color: #18bc9c; top: 100px;">
            <div class="row card-title col-md-12">
                <h5 class="col-md-12 col-12">General Rules</h5>
            </div>
        </div>
    </div>
    <div class="row text-center">
        <div class="card col-md-10 offset-md-1 col-10 offset-1 text-center" style="background-color: #18bc9c; top: 100px;">
            <div class="row text-center">
                <div class="row col-md-12 text-center">
                    1) No links to unapproved websites.
                </div>
                <div class="row col-md-12 text-center">
                    2) No profanity, inappropriate images, or texts are allowed on this site.
                </div>
                <div class="row col-md-12 text-center">
                    3) No harassment or abuse of any kind.
                </div>
                <div class="row col-md-12 text-center">
                    4) No scamming of any kind allowed.
                </div>
            </div>
        </div>
    </div>
    <div class="row">

        <div id="body-element" class="card col-md-10 offset-md-1 col-10 offset-1 text-center" style="background-color: #18bc9c; top: 100px;">
            <div class="row card-title col-md-12">
                <h5 class="col-md-12 col-12">Raffle Rules</h5>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="card col-md-10 offset-md-1 col-10 offset-1" style="background-color: #18bc9c; top: 100px;">
            <div class="row">
                <div class="row col-md-12 text-center">
                    1) Only one entry per user. No alternate accounts are allowed.
                </div>
                <div class="row col-md-12 text-center">
                    2) Raffle items must be traded through steam.
                </div>
                <div class="row col-md-12 text-center">
                    3) Paid raffles are not allowed. All raffles will be free to enter.
                </div>
                <div class="row col-md-12 text-center">
                    4) No inappropriate content will be allowed anywhere on the site. This includes raffle titles, notes, and comments.
                </div>
                <div class="row col-md-12 text-center">
                    5) No scripts or bots can be used to take advantage of the website.
                </div>
                <div class="row col-md-12 text-center">
                    6) You must be verified to create raffles. To do so you must have entered 10 raffles, have 500+ total hours played, and not be marked as a scammer.
                </div>
                <div class="row col-md-12" id = 'body-element'>
                  <form method = "post">
                    <button type="submit" class="waves-effect waves-light btn">Verify me!
                  </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
