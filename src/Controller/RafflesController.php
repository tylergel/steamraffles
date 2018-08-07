<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Core\Configure;
use Cake\Network\Exception\ForbiddenException;
use Cake\Network\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;
use Cake\Http\ServerRequest;
use Cake\Event\Event;
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;
use Cake\Controller\Component\FlashComponent;
/**
 * Static content controller
 *
 * This controller will render views from Template/Pages/
 *
 * @link https://book.cakephp.org/3.0/en/controllers/pages-controller.html
 */
 use Cake\Datasource\ConnectionManager;
class RafflesController extends AppController
{

    /**
     * Displays a view
     *
     * @param array ...$path Path segments.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Network\Exception\ForbiddenException When a directory traversal attempt.
     * @throws \Cake\Network\Exception\NotFoundException When the view file could not
     *   be found or \Cake\View\Exception\MissingTemplateException in debug mode.
     */

     public function beforeFilter(Event $event)
    {
      //Redirect the user if they have not accepted the privacy policy
      $this->loadComponent('RequestHandler');
      $this->loadComponent('Flash');
      $this->loadModel('Users');

      if(isset($_SESSION['steamid'])) {
        $users = TableRegistry::get('Users');
        $query = $users->find()->where(['steamid' => $_SESSION['steamid']])->first();
        if(!$query->accepted) {
              return $this->redirect(
                $this->referer()
            );
        }
      }

    }

    public function replycomment($commentid, $raffleid) {

      $replys = TableRegistry::get('Replys');
      $steamid = $_SESSION['steamid'];
      date_default_timezone_set("UTC");
        $time = time();
        $exi = $replys->find()->where(['steamid' => $steamid, 'raffleid' => $raffleid])->order(['id' => 'DESC'])->first();
        if($exi) {
          $made = $exi->timemade;
          $made = $made + 120;
          $made = $time - $made;
          if($made < 0) {
            $this->Flash->set('You must wait 2 minutes between comments.', [
                'element' => 'error'
            ]);
            return $this->redirect(

              ['controller' => 'Raffles', 'action' => 'view', $raffleid]
          );
          }
        }

      $com = $this->request->data()['reply'];
      if (preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i", $com)) {
        $this->Flash->set('No links allowed.', [
            'element' => 'error'
        ]);
        return $this->redirect(

          ['controller' => 'Raffles', 'action' => 'view', $raffleid]
      );
      }
      $users = TableRegistry::get('Users');
      $query = $users->find()->where(['steamid' => $steamid])->first();
      $this->loadModel('Replys');
      $ent = $this->Replys->newEntity();
      $ent->steamid = $steamid;
      $ent->parentcomment = $commentid;
      $ent->comment = $com;
      $ent->raffleid = $raffleid;
      $ent->userid = $query->id;
      $ent->timemade = $time;
      $ent->personaname = $_SESSION['steam_personaname'];
      $ent->avatar = $_SESSION['steam_avatar'];
      $this->Replys->save($ent);

      $commentsleft = $query->commentsleft;
      $query = $users->query();
      $query->update()
          ->set(['commentsleft' => ($commentsleft + 1)])
          ->where(['steamid' => $steamid])
          ->execute();
      return $this->redirect(

        ['controller' => 'Raffles', 'action' => 'view', $raffleid]
    );

    }
    public function like($id, $steamid, $owner) {
      if($owner == $steamid) {
        $this->Flash->set('Thanks for appreciating yourself!', [
            'element' => 'success'
        ]);
          return $this->redirect(
            ['controller' => 'Raffles', 'action' => 'view', $id]
        );
      }
      if(!isset($_SESSION['steamid'])) {
        $this->Flash->set('Sign in to like this raffle!', [
            'element' => 'error'
        ]);
          return $this->redirect(
            ['controller' => 'Raffles', 'action' => 'view', $id]
        );
      }
      $this->loadModel('Rafflelikes');
        $rafflelike = TableRegistry::get('Rafflelikes');
        $users = TableRegistry::get('Users');
        $query = $rafflelike->find()->where(['raffleid' => $id, 'steamid' =>$steamid])->first();
        if(empty($query)) {
          $likeitem = $this->Rafflelikes->newEntity();
          $likeitem->steamid = $steamid;
          $likeitem->raffleid = $id;
          $this->Rafflelikes->save($likeitem);

          $query = $users->find()->where(['steamid' => $owner])->first();
          $likes = $query->likes;
          $query = $users->query();
          $query->update()
              ->set(['likes' => ($likes + 1)])
              ->where(['steamid' => $owner])
              ->execute();

        }

    }
    public function delete() {
      $id = $_POST['id'];
      $this->loadModel('Entry');
      $entrys = TableRegistry::get('Entry');
      $winner = "0";

      //Get a random row to find the winner
      $query = $entrys->find()->where(['raffleid' => $id])->order(['RAND()'])->first();
      if($query) {
        $winner = $query->toArray()['entry'];
      }


      //Set this raffle to be inactive and the winner to be the random winner chosen
      $this->loadModel('Raffles');
      $raffles = TableRegistry::get('Raffles');
      $query = $raffles->query();
      $query->update()
      ->set(['inactive' => '1'])
      ->where(['id' => $id])
      ->execute();
      $query = $raffles->query();
      $query->update()
      ->set(['winner' => $winner])
      ->where(['id' => $id])
      ->execute();

      //Update the users data, if he won the raffle
      $this->loadModel('Users');
      $users = TableRegistry::get('Users');
      $query = $users->find()->where(['steamid' => $winner])->first();
      $won = $query->toArray()['won'];
      $query = $users->query();
      $query->update()
      ->set(['won' => ($won + 1)])
      ->where(['steamid' => $winner])
      ->execute();

    }
    public function index($mode = null, $me = null)
    {
      $games = TableRegistry::get('Views');
      $apps = $games->find()->all();
      $this->set('apps', $apps);
      session_name('NMCORE');
      if (session_status() == PHP_SESSION_NONE) {
          session_start();
      }
      $entry = TableRegistry::get('Entry');
      $raffles = TableRegistry::get('Raffles');
      $items = TableRegistry::get('Items');
      $this->set('me', $me);
      //Get the raffles corresponding to the game
      if($mode == null || $mode == "all") {
        $mode = "all";

        if($me != null) {
          $query = $raffles->find()->where(['steamid' => $me])->all();
        } else {
          $query = $raffles->find()->where(['inactive' => 0])->all();
        }
      }
      else {
        $query = $raffles->find()->where(['game' => $mode, 'inactive' => 0]);
      }
      $this->set('mode', $mode);
      $query = $query->toArray();
      foreach($query as $key=>$q) {
        $itemquery = $items->find()->where(['raffleid' => $q['id']]);
        $entriesquery = $entry->find()->where(['raffleid' => $q['id']]);
        $query[$key]['items'] = $itemquery->toArray();
        $query[$key]['entry'] = sizeof($entriesquery->toArray());
        $time = $q['timeended'];
        $query[$key]['time'] = $time;
      }
      $this->set('rafflearray', $query);
    }

    public function view($id = null) {
      $this->loadModel('Users');
      $raffles = TableRegistry::get('Raffles');
      $items = TableRegistry::get('Items');
      $entry = TableRegistry::get('Entry');
      $users = TableRegistry::get('Users');
      $replys = TableRegistry::get('Replys');
      $this->loadModel('Comments');
      $comments = TableRegistry::get('Comments');
      $steamid = "";
      if(isset($_SESSION['steamid'])) {
          $steamid = $_SESSION['steamid'];
      }

      //Find the comments of the raffle
      $query = $raffles->find()->where(['id' => $id]);
      $commentArray = $comments->find()->where(['raffleid' => $id])->order(['id' => 'DESC'])->all();

      $commentArray = $commentArray->toArray();
      foreach($commentArray as $key=>$q) {
        $replyquery = $replys->find()->where(['parentcomment' => $q['id']])->order(['id' => 'DESC'])->all();
        $commentArray[$key]['replys'] = $replyquery->toArray();

      }
      $this->set('commentArray', (object)$commentArray);

      //Get the itms and entries of the raffle
      $query = $query->toArray();
      $rafid = $query['0']['id'];
      $itemquery = $items->find()->where(['raffleid' => $id]);
      $entriesquery = $entry->find()->where(['raffleid' => $id]);

      //Set these variables in the query array
      $query['0']['ent'] = $query['0']['entries'];
      $query['0']['items'] = $itemquery->toArray();
      $query['0']['entry'] = sizeof($entriesquery->toArray());
      $query['0']['entries'] = $entriesquery->toArray();
      $people = $query['0']['entry'];
      if( $query['0']['entry'] == 0 ) {
        $people = 1;
      }
      $chance = 1 / $people;
      $chance = number_format( $chance * 100, 2 ) . '%';
      $query['0']['chance'] = $chance;
      $time = $query['0']['timeended'];
      $query['0']['time'] = $time;
      $rafflesteamid = $query['0']['steamid'];
      $this->set('raffle', $query['0']);
      $this->set('id', $rafid);
      $this->loadModel('Entry');

      //If the user decides to enter the raffle
      if($this->request->is('post')) {




        if(isset($this->request->data()['raffleId'])) {
          //if is his raffle
          if($rafflesteamid == $steamid) {
            $this->Flash->set('Sorry, you cannot enter your own raffle!', [
                'element' => 'error'
            ]);
              return $this->redirect(
                ['controller' => 'Raffles', 'action' => 'index']
            );
          }
          //check if raffle is full
        if( $query['0']['entry'] >= $query['0']['ent']) {
          $this->Flash->set('This raffle is full! Check out our other raffles here. :D', [
              'element' => 'error'
          ]);
            return $this->redirect(
              ['controller' => 'Raffles', 'action' => 'index']
          );
        }

        //check if the user exists in the raffle
        $raffleid = $this->request->data()['raffleId'];
        $exi = $entry->find()->where(['entry' => $steamid, 'raffleid' => $raffleid]);

        //Enter the user into the raffle, and set his enter stats to +1
        if(!sizeof($exi->toArray())) {

          $users = TableRegistry::get('Users');
          $query = $users->find()->where(['steamid' => $steamid])->first();
          $ent = $this->Entry->newEntity();
          $ent->entry = $steamid;
          $ent->raffleid = $raffleid;
          $ent->userid = $query->id;
          $this->Entry->save($ent);

          $entered = 0;
          $entered = $query->entered;

          $query = $users->query();
          $query->update()
              ->set(['entered' => ($entered + 1)])
              ->where(['steamid' => $steamid])
              ->execute();
        }
        else {
          $this->Flash->set('You are already in this raffle.', [
              'element' => 'error'
          ]);

            return $this->redirect(

              ['controller' => 'Raffles', 'action' => 'index']
          );
        }
      }
      //If the user decides to leave a comment instead, add that to the table.
      else {
        $steamid = $_SESSION['steamid'];
        date_default_timezone_set("UTC");
          $time = time();
          $exi = $comments->find()->where(['steamid' => $steamid, 'raffleid' => $id])->order(['id' => 'DESC'])->first();
          if($exi) {
            $made = $exi->timemade;
            $made = $made + 120;
            $made = $time - $made;
            if($made < 0) {
              $this->Flash->set('You must wait 2 minutes between comments.', [
                  'element' => 'error'
              ]);
              return $this->redirect(

                ['controller' => 'Raffles', 'action' => 'view', $id]
            );
            }
          }

        $com = $this->request->data()['comment'];
        if (preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i", $com)) {
          $this->Flash->set('No links allowed.', [
              'element' => 'error'
          ]);
          return $this->redirect(

            ['controller' => 'Raffles', 'action' => 'view', $id]
        );
        }
        $users = TableRegistry::get('Users');
        $query = $users->find()->where(['steamid' => $steamid])->first();
        $ent = $this->Comments->newEntity();
        $ent->steamid = $steamid;
        $ent->comment = $com;
        $ent->raffleid = $id;
        $ent->userid = $query->id;
        $ent->timemade = $time;
        $ent->personaname = $_SESSION['steam_personaname'];
        $ent->avatar = $_SESSION['steam_avatar'];
        $this->Comments->save($ent);
        $commentsleft = $query->commentsleft;
        $query = $users->query();
        $query->update()
            ->set(['commentsleft' => ($commentsleft + 1)])
            ->where(['steamid' => $steamid])
            ->execute();
        return $this->redirect(

          ['controller' => 'Raffles', 'action' => 'view', $id]
      );
    }

    }
    }
    public function completedview($id = null) {
      $raffles = TableRegistry::get('Raffles');
      $items = TableRegistry::get('Items');
      $entry = TableRegistry::get('Entry');
      $this->loadModel('Comments');
      $comments = TableRegistry::get('Comments');
      $steamid = "";
      if(isset($_SESSION['steamid'])) {
          $steamid = $_SESSION['steamid'];
      }

      //Find the comments of the raffle
      $query = $raffles->find()->where(['id' => $id]);
      $commentArray = $comments->find()->where(['raffleid' => $id])->all();
      $this->set('commentArray', $commentArray);

      //Get the itms and entries of the raffle
      $query = $query->toArray();
      $rafid = $query['0']['id'];
      $itemquery = $items->find()->where(['raffleid' => $id]);
      $entriesquery = $entry->find()->where(['raffleid' => $id]);

      //Set these variables in the query array
      $query['0']['ent'] = $query['0']['entries'];
      $query['0']['items'] = $itemquery->toArray();
      $query['0']['entry'] = sizeof($entriesquery->toArray());
      $query['0']['entries'] = $entriesquery->toArray();
      $people = $query['0']['entry'];
      if( $query['0']['entry'] == 0 ) {
        $people = 1;
      }
      $chance = 1 / $people;
      $chance = number_format( $chance * 100, 2 ) . '%';
      $query['0']['chance'] = $chance;
      $time = $query['0']['timeended'];
      $query['0']['time'] = $time;
      $rafflesteamid = $query['0']['steamid'];
      $this->set('raffle', $query['0']);
      $this->set('id', $rafid);
      $this->loadModel('Entry');

    }

    public function deletecomment() {
      if($this->request->is('post')) {
        $data = $this->request->data['id'];
      $this->loadModel('Comments');
      $comments = TableRegistry::get('Comments');
      $entity = $this->Comments->get($data);
      $result = $this->Comments->delete($entity);
    }
    }
    public function create($mode = null) {
      $game = 'all';
      if($mode != null) {
        $game = $mode;
      }
        $this->set('game', $game);
      $games = TableRegistry::get('Views');
      $apps = $games->find()->all();
      $this->set('apps', $apps);

      if(!isset($_SESSION['steamid'])) {
        $this->Flash->set('You must be verified to create a raffle.  Check the rules for more info.', [
            'element' => 'error'
        ]);
          return $this->redirect(

            ['controller' => 'Raffles', 'action' => 'index', $mode]
        );
    }
      $raffles = TableRegistry::get('Views');
      $app = $raffles->find()->where(['app' => $mode]);
      $appid = $app->toArray()[0]['appid'];
      $thisid = $_SESSION['steamid'];
      $json = file_get_contents('https://steamcommunity.com/profiles/'.$thisid.'/inventory/json/'.$appid.'/2');
      $obj = json_decode($json);
      $this->set('obj', $obj);
      //Verify user
      $nor = 0;
      $users = TableRegistry::get('Users');
      $query = $users->find()->where(['steamid' => $_SESSION['steamid']])->first();
      $userid = $query->id;

        $nor = $query->number;
        if(!$query->verified) {
          $this->Flash->set('You must be verified to create a raffle.  Check the rules for more info.', [
              'element' => 'error'
          ]);
            return $this->redirect(

              ['controller' => 'Raffles', 'action' => 'index', $mode]
          );
        }


      $rafs = TableRegistry::get('Raffles');
      $exists = $rafs->exists(['steamid' => $_SESSION['steamid'], 'game' => $mode, 'inactive' => 0]);
      if($exists) {
        $this->Flash->set('You already have a raffle created', [
            'element' => 'error'
        ]);
          return $this->redirect(

            ['controller' => 'Raffles', 'action' => 'index', $mode]
        );
      }

      if($this->request->is('post')) {
        include ('steamauth/userInfo.php');

        $steamid = $_SESSION['steamid'];
        $avatar = $_SESSION['steam_avatar'];
        $steamname = $_SESSION['steam_personaname'];
        $data = $this->request->data;
        $time = time() +$data['time'];
        $raffle = $this->Raffles->newEntity();
        $raffle->steamid = $steamid;
        $raffle->userid = $userid;
        $raffle->avatar = $avatar;
        $raffle->steamname = $steamname;
        $raffle->title = $data['title'];
        $raffle->message = $data['message'];
        $raffle->entries = $data['entries'];
        $raffle->game = $data['game'];
        $raffle->timeended = $time;
        $raffle->inactive = 0;

        $this->loadModel('Items');
        if(empty($data['item'])) {
          $this->Flash->set('You must choose at least one item to raffle off.', [
              'element' => 'error'
          ]);
            return $this->redirect(

              ['controller' => 'Raffles', 'action' => 'index', $mode]
          );
        }
        $sav = $this->Raffles->save($raffle);
        $raffid=$sav->id;
        foreach($data['item'] as $key=>$item) {
          $pieces = explode(", ", $key);
          $id = $pieces['0'];
          $name = $pieces['1'];
          $icon = $pieces['2'];
          $raffleitem = $this->Items->newEntity();
          $raffleitem->name = $name;
          $raffleitem->icon = $icon;
          $raffleitem->itemid = $id;
          $raffleitem->raffleid = $raffid;
          $this->Items->save($raffleitem);
        }
        $query = $users->query();
        $query->update()
            ->set(['number' => ($nor + 1)])
            ->where(['steamid' => $steamid])
            ->execute();

        if($raffle->errors()) {
          $this->Flash->set('You must fill out all fields', [
              'element' => 'error'
          ]);
        }
        else {
          $this->Flash->set('Raffle successfully created.', [
              'element' => 'success'
          ]);
          return $this->redirect(

            ['controller' => 'Raffles', 'action' => 'index', $data['game']]
        );
        }
      }

    }
    public function completed() {
      //Get the 10 most recent completed raffles
      $users = TableRegistry::get('Users');
      $raffles = TableRegistry::get('Raffles');
      $query = $raffles->find()->where(['inactive' => 1])->order(['id' => 'DESC'])->limit(10)->all();
      $query = $query->toArray();

      $key = "637D92A81FBB0C9CDCA06C1F940E8178";
      $this->set('key', $key);
      foreach($query as $q) {
        $que = $users->find()->where(['id' => $q['userid']])->first();
        $q['tradeurl'] = $que['tradeurl'];
      }
      $this->set('rafflearray', $query);
    }
    public function top($data = null) {
      $users = TableRegistry::get('Users');
      //Get the top 10 people who have the designated paramater
      if($data == null) {
        $data = 'score';
      }
      $this->set('data', $data);

      $query = $users->find()->order([$data => 'DESC'])->limit(10)->all();
      $arr = $query->toArray();
      $this->set('toparr', $arr);

      $key = "637D92A81FBB0C9CDCA06C1F940E8178";
      $this->set('key', $key);

    }
}
