<html>
<?= $this->Flash->render();  ?>
<body style = "background-color: #18bc9c">
  <div class = "container">
  <div class = "panel panel-default">
    <div class="panel-heading row " style=" text-decoration: underline;">
        <div id="body-element" class="panel-heading col-md-12 col-12 text-center" style="background-color: white!important; top: 100px;">
            <div class="row  col-md-12">
                <?= $this->Flash->render() ?>
                    <h5 class="col-md-12 col-12">Contact us</h5>
            </div>
        </div>
    </div>
    <div class="panel-body row ">
      <div class="col-md-12 col-12  text-center" style="background-color: white; top: 100px;">
          <div >
              <p class="text-center">
                  Steam Group: <a href =  "https://steamcommunity.com/groups/gamegifts"  target = "_blank" class="btn btn-primary">GameGifts</a>
              </p>
              <p class="text-center">
                  Owner: <a href =  "https://steamcommunity.com/id/tf2token/"  target = "_blank" class="btn btn-primary">Legend</a>
              </p>
              <p class="text-center">
                  Head Admin: <a href =  "https://steamcommunity.com/id/RandomCritz/" target = "_blank" class="btn btn-primary">RandomCritz</a>
              </p>
              <p class="text-center">
                  Email: webshockinnovations@gmail.com
              </p>
              <p>
                <form action="<?= $this->Url->build( array('controller' => 'about', 'action' => 'mail') ) ?>" method="post">
                        <div class="card border-primary rounded-0">
                            <div class="card-header p-0">
                                <div class="bg-info text-white text-center py-2">
                                    <h3><i class="fa fa-envelope"></i> Contact Us</h3>
                                </div>
                            </div>
                            <div class="card-body p-3">

                                <!--Body-->
                                <div class="form-group">
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fa fa-user text-info"></i></div>
                                        </div>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Name" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fa fa-envelope text-info"></i></div>
                                        </div>
                                        <input type="email" class="form-control" id="email" name="email" placeholder="example@gmail.com" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fa fa-comment text-info"></i></div>
                                        </div>
                                        <textarea class="form-control" placeholder="Message" id = "message" name = "message" required></textarea>
                                    </div>
                                </div>

                                <div class="text-center">
                                    <input type="submit" value="submit" class="btn btn-info btn-block rounded-0 py-2">
                                </div>
                            </div>

                        </div>
                    </form>
                  </p>
          </div>
      </div>
    </div>
  </div>
</body>
</html>
