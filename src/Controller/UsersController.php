<?php
   namespace App\Controller;

   use App\Controller\AppController;
   use Cake\ORM\Table;
   use Cake\ORM\TableRegistry;
   class UsersController extends AppController
   {

     public function rewards() {
       $this->loadModel('Users');
       $this->loadModel('Referred');
       $key = "637D92A81FBB0C9CDCA06C1F940E8178";
        $this->set('key', $key);
       $url = file_get_contents("http://api.steampowered.com/ISteamUser/GetFriendList/v0001/?key=".$key."&steamid=".$_SESSION['steamid']."&relationship=friend");
       $content = json_decode($url, true);
       $array = $content['friendslist']['friends'];

       $url = "https://steamcommunity.com/gid/103582791462607769/memberslistxml/?xml=1";
       $xml = simplexml_load_file($url);
       $url = json_encode($xml);
       $content = json_decode($url, true);
       $groupArray = $content['members']['steamID64'];

       $private = false;
       $totalArray = [];
       $friendWebsite = 0;
       $friendGroup = 0;
       if(empty($array)) {
         $private = true;
       }
       else {
         $users = TableRegistry::get('Users');
         $referers = TableRegistry::get('Referred');
         $refererArr = $referers->find()->all();
         $refererArr = $refererArr->toArray();
         $query = $users->find()->all();
         $query = $query->toArray();
         foreach($array as $friend) {

           $arrobj = [
             'steamid' => $friend['steamid'],
             'website' => '0',
             'group' => '0',
             'claimed' => '0',
             'dont' => '0'
           ];
           if(in_array( $friend['steamid'], array_column($refererArr, 'usersteamid'))) {
             $arrobj['dont'] = '1';
              if($refererArr[array_search( $friend['steamid'], array_column($refererArr, 'usersteamid'))]['referersteamid'] != $_SESSION['steamid'])  {
                $arrobj['claimed'] = '1';

              }
           }
           if(in_array($friend['steamid'],  array_column($query, 'steamid', 'id') )) {
             $arrobj['website'] = '1';
             if($arrobj['claimed'] == '0') {

               $friendWebsite++;
             }
           }
           if(in_array($friend['steamid'], $groupArray )) {
             $arrobj['group'] = '1';
            if($arrobj['claimed'] == '0') {
              $friendGroup++;
            }
          }
            array_push($totalArray, $arrobj);
         }
         }
         usort($totalArray, function($a, $b) {
             return $b['website'] - $a['website'];
         });
         usort($totalArray, function($a, $b) {
             return $b['group'] - $a['group'];
         });
         $total = $friendWebsite + (round(($friendGroup / 2 ), 2));
         foreach($totalArray as $k=>$tot) {

           if($tot['dont'] == '1') {
             continue;
           }
           if($tot['group'] == '0' && $tot['website'] == 0) {
             break;
           }

           $url = file_get_contents("https://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=".$key."&steamids=".$tot['steamid']);
           $content = json_decode($url, true);
           $time = time() - $content['response']['players'][0]['timecreated'];
           $time2 = time() - $content['response']['players'][0]['lastlogoff'];
           if($time < 2592000 || $time2 > 604800) {
             $totalArray[$k]['alt'] = true;
             if($tot['website'] == '1') {
               $total = $total - 1;
             }
             if($tot['group'] == '1') {
               $total = $total - .5;
             }
           } else {
           $ref = $referers->newEntity();
           $ref->referersteamid = $_SESSION['steamid'];
           $ref->usersteamid = $tot['steamid'];
           $ref->website = $tot['website'];
           $ref->ingroup = $tot['group'];
           $referers->save($ref);
         }
         }
         $users = TableRegistry::get('Users');
         $query = $users->find()->where(['steamid' => $_SESSION['steamid']])->first();
         $clam = $query['claimed'];

         $query = $users->query();
         $query->update()
             ->set(['toclaim' => ($total)])
             ->where(['steamid' => $_SESSION['steamid']])
             ->execute();

         $this->set('totalArray', $totalArray);
         $this->set('friendWebsite', $friendWebsite);
         $this->set('friendGroup', $friendGroup);
         $this->set('total', $total);
         $this->set('umtotal', $clam);
         $this->set('private', $private);
       }

       public function donations() {
         $key = "637D92A81FBB0C9CDCA06C1F940E8178";
          $this->set('key', $key);
          $this->loadModel('users');
          $users = TableRegistry::get('Users');
          $query = $users->find()->limit(5)->where(function ($exp) {
              return $exp
                  ->notEq('donated', 0);
          })->all();
          $this->set('donators', $query);
       }
     public function editprofile($id) {
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
      $score = $query->entered + $query->number + $query->created + $query->donated + $query->toclaim + $query->likes;
      $query2 = $users->query();
      $query2->update()
          ->set(['score' => ($score)])
          ->where(['steamid' => $query->steamid])
          ->execute();

      $position = $users->find()->order(['score' => 'DESC'])->all();
      $rank = 0;
      foreach($position as $akey=>$pos) {
        if($pos->steamid == $query->steamid) {
          $rank = $akey;
        }
      }
      $this->set('rank', $rank + 1);
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
