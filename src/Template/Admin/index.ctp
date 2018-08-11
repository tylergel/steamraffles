<html>
<body>
<div class = "container" style = "margin-top: 100px">

<?php foreach($news as $new) : ?>
<div class = "row" style = "background-color: red; margin-top: 10px">
<?= $new->title ?>
<br>
<?= $new->news ?>
<a href = "<?= $this->Url->build( array('controller' => 'admin', 'action' => 'deleteNews', $new->id) ) ?>">Delete news</a>
</div>
<?php endforeach ?>
<div class = "row" style = "background-color: red; margin-top: 10px">
<form method="post" action="<?= $this->Url->build( array('controller' => 'admin', 'action' => 'addNews') ) ?>">
    <input name = "title" class="form-control" type="text" placeholder="Title of news" id="title">
      <input name = "news" class="form-control" type="text" placeholder="Description" id="news">
      <input type="submit" value="Add news">
</form>
</div>

<?php foreach($users as $user) : ?>
<?php
 $toGive = $user->toclaim - $user->claimed;
 if($toGive == 0) {
   break;
 }
?>

<div class = "row" style = "background-color: teal; margin-top: 10px">
<?= $user->steamid ?>
<br>
<?= $toGive ?>
</div>
<?php endforeach ?>


<?php foreach($sponsors as $sponsor) : ?>
<div class = "row" style = "background-color: red; margin-top: 10px">
<?= $sponsor->title ?>
<br>
<?= $sponsor->description ?>
<br>
<?= $sponsor->link ?>
<br>
<?= $sponsor->linkname ?>
<a href = "<?= $this->Url->build( array('controller' => 'admin', 'action' => 'deleteSponsor', $sponsor->id) ) ?>">Delete Sponsor</a>
</div>
<?php endforeach ?>
<div class = "row" style = "background-color: red; margin-top: 10px">
<form method="post" action="<?= $this->Url->build( array('controller' => 'admin', 'action' => 'addSponsor') ) ?>">
  <input name = "title" class="form-control" type="text" placeholder="Title of sponsor" id="title">
    <input name = "description" class="form-control" type="text" placeholder="Description" id="description">
    <input name = "link" class="form-control" type="text" placeholder="Title of sponsor link" id="link">
      <input name = "linkname" class="form-control" type="text" placeholder="Sponsor link description" id="linkname">
      <input type="submit" value="Add Sponsor">
</form>
</div>

<?php foreach($contact as $con) : ?>
<div class = "row" style = "background-color: teal; margin-top: 10px">
<?= $con->name ?>
<br>
<?= $con->email ?>
<br>
<?= $con->message ?>
</div>
<?php endforeach ?>


</div>
</body>
</html>
