<?php
   namespace App\Controller;

   use App\Controller\AppController;
   use Cake\ORM\Table;
   use Cake\ORM\TableRegistry;
   class UsersController extends AppController
   {
     public function editprofile($id) {
       debug($id);
       if($this->request->is('post')) {
         $data = $this->request->data;
         $profiletitle = $data['profiletitle'];
         $profilebody = $data['profilebody'];
         $this->loadModel('Userprofiles');
         $userprofile = TableRegistry::get('Userprofiles');
         $query = $userprofile->query();
         $query->update()
             ->set(['profiletitle' => $profiletitle, 'profiledescription' => $profilebody])
             ->where(['ownerid' => $id])
             ->execute();

       }
       return $this->redirect(

         ['controller' => 'Users', 'action' => 'profile', $id]
     );
     }
     public function profile($id = null, $header = null)
    {

      $users = TableRegistry::get('Users');
      $steamid = $id;
      if($header == '1') {
        $query = $users->find()->where(['steamid' => $id])->first();
          $id = $query->id;
      }
      else {
        $query = $users->find()->where(['id' => $id])->first();
        $steamid = $query->steamid;
      }
      $commentsleft = $query->commentsleft;
      $query2 = $users->find()->order(['entered' => 'DESC'])->all();
      $position = 0;
      foreach($query2->toArray() as $key => $f) {
        if($f['steamid'] == $steamid) {
            $position = $key + 1;
        }
      }

      $this->set('rank', $position);
      $this->set('userdata', $query);

      $this->loadModel('Userprofiles');



      $userprofile = TableRegistry::get('Userprofiles');
      $query = $userprofile->find()->where(['ownerid' => $id])->first();

      $this->set('userprofile', $query);
      $this->loadModel('Profilecomments');
      $usercommentsf = TableRegistry::get('Profilecomments');

      $key = "637D92A81FBB0C9CDCA06C1F940E8178";
      $url = file_get_contents("https://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=".$key."&steamids=".$steamid);
    	$content = json_decode($url, true);
      $content = $content['response']['players'][0];
      $query = $usercommentsf->find()->where(['ownerid' => $id])->all();

      $this->set('usercommentsobj', $query);
      $this->set('key', $key);
      $this->set('content', $content);
      $this->set('id', $id);
      if($this->request->is('post')) {
        $data = $this->request->data;
        $usercomments = TableRegistry::get('Profilecomments');
        $query = $usercomments->find()->where(['ownerid' => $data['owner'], 'commenter' =>$data['steamid']])->first();
        if(empty($query)) {
          $user = $users->find()->where(['steamid' => $data['steamid']])->first();
          $userid = $user->id;
          $comment = $this->Profilecomments->newEntity();
          $comment->commenter = $data['steamid'];
          $comment->ownerid = $data['owner'];
          $comment->text = $data['text'];
          $comment->commenterid = $userid;
          $this->Profilecomments->save($comment);


          $query = $users->query();
          $query->update()
              ->set(['commentsleft' => ($commentsleft + 1)])
              ->where(['steamid' => $commenter])
              ->execute();
        }
      }
    }


   }
