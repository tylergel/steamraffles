<html>
<?= $this->Flash->render() ?>

<body  id = "body" style = "background: url('<?= $this->Url->image($mode . '.png'); ?>') no-repeat center center fixed;
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    background-size: cover;
    height: 100%;">
    
  <div class = "row">
    <div class="card col-md-10 offset-md-1" style = "top: 100px; z-index:-1">
      <div class = "col-md-3">
        <h5 class="card-title">Create a raffle</h5>
      </div>
    </div>
  </div>
  <div class = "row">
    <div class="card col-md-10 offset-md-1" style = "top: 100px;">
      <div class = "col-md-10" >
        <div class="card-body">
          <?= $this->Flash->render() ?>
          <form method = "post">
            <div class="form-group row col-auto-12">
              <label for="title">Title: </label>
                <input name = "title" class="form-control" type="text" placeholder="Title of your raffle" id="title">
            </div>
            <div class="form-group row ">
              <label for="message">Message: </label>
                <input name = "message" class="form-control " type="text" placeholder="Hey guys! Feeling great today so here is a little something :)" id="message">
            </div>
            <div class = "row">
              <div class="form-inline col-md-6">
                <label for="entries">Entries: </label>
                <input name = "entries" type="entries" class="form-control" placeholder = "12" id="entries">
              </div>
              <div class="form-inline col-md-6 float-right">
                <label for="time">Length: </label>
                <select name = "time" class="form-control" id="time">
                  <option value = '600'>10 minutes</option>
                  <option value = '1800'>30 minutes</option>
                  <option value = '3600'>1 hour</option>
                  <option value = '7200'>2 hours</option>
                  <option value = '14400'>4 hours</option>
                  <option value = '28800'>8 hours</option>
                  <option value = '43200'>12 hours</option>
                  <option value = '86400'>24 hours</option>
                  <option value = '259200'>3 days</option>
                  <option value = '432000'>5 days</option>
                  <option value = '604800'>7 days</option>
                </select>
              </div>
            </div>
            <div class = "row">
              <label for="game">Choose Game: </label>
                <select name = "game" class="form-control" id="game">
                  <option value = 'fortnite'>Fortnite</option>
                  <option value = 'tf2'>Team Fortress 2</option>
                  <option value = 'csgo'>CSGO</option>
                  <option value = 'dota2'>Dota 2</option>
                </select>
            </div>
            <input type="submit" value="Create Raffle">
            <div class = "row  col-md-12">
                <?php foreach($obj->rgDescriptions as $item) {
                  if($item->tradable) {
                    $img = 'https://steamcommunity.com/economy/image/';
                    $img .= $item->icon_url;
                    $name = $item->icon_url;
                    echo "<div id = '$name';   class = 'item col-md-2'; onclick= 'myFunction(this)'><img style = 'max-width: 100%;' src = $img></img></div>";
                  }
                }
                ?>
            </div>
          </form>

        </div>
      </div>
    </div>
  </div>
</body>
</html>
<script>
function myFunction(el) {
  $(el).toggleClass("active");
  var color = $( el ).css( "background-color" );
  var id = $(el).attr('id');
  var str = 'item[';
  str += id;
  str += ']';
  var div = "<input type = 'hidden' id=item_";
  div += id;
  div += " name = '"+ str + "' value= '"+ id + "'>";
  if(color == 'rgb(0, 128, 0)') {
    $(el).append(div);
  }
  else {
    $("#item_" + id).remove();
  }
}
$("#game option[value='<?= $game ?>']").attr("selected", true);
$( "#game" ).change(function() {
  var game = $('#game option:selected').val();

  window.location.href = '/raffles/create/' +game;
});

</script>
