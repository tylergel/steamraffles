<html>
<?= $this->Flash->render();  ?>
<body style = "background-color: #18bc9c">
  <div class = "container">
    <div class = "panel panel-default">
      <div class="panel-heading row " style=" text-decoration: underline;">
          <div id="body-element" class="panel-heading col-md-10 offset-md-1 col-10 offset-1 text-center" style="background-color: white!important; top: 100px;">
              <div class="row  col-md-12">
                  <?= $this->Flash->render() ?>
                      <h5 class="col-md-12 col-12">Our sponsors</h5>
              </div>
          </div>
      </div>
      <div class="panel-body row ">
          <div class="col-md-10 offset-md-1 col-10 offset-1" style="background-color: white; top: 100px;">
            <?php foreach($sponsors as $sponsor) : ?>
              <div >
                  <p class="text-center">
                    <?= $sponsor->title; ?> : <?= $sponsor->description ?>
                  </p>
                  <p id = "body-element" class="text-center">
                    <a href="<?= $sponsor->link ?>" target = "_blank" class="waves-effect waves-light btn"><?= $sponsor->linkname ?>
                  </p>
              </div>
            <?php endforeach; ?>
          </div>
      </div>
    </div>
  </div>
</body>
</html>
