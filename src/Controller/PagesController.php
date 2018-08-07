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
class PagesController extends AppController
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
      $notaccepted = false;
      if(isset($_SESSION['steamid'])) {
        $users = TableRegistry::get('Users');
        $query = $users->find()->where(['steamid' => $_SESSION['steamid']])->first();
        if(!$query->accepted) {
          $notaccepted = true;
        }

      }
          $this->set('notaccepted', $notaccepted);
         $this->loadComponent('RequestHandler');
         $this->loadComponent('Flash');
    }
    public function display(...$path)
    {
      session_name('NMCORE');
      if (session_status() == PHP_SESSION_NONE) {
          session_start();
      }

      //If the user accepts...
      if($this->request->is('post')) {
        $users = TableRegistry::get('Users');
        $query = $users->query();
        $query->update()
        ->set(['accepted' => '1'])
        ->where(['steamid' => $_SESSION['steamid']])
        ->execute();
        return $this->redirect('/');
      }
      $araffle = false;

      //Get user and add him to the database on his first login
      if(isset($_SESSION['steamid'])) {
        $this->loadModel('Users');
        $users = TableRegistry::get('Users');
        $query = $users->find()->where(['steamid' => $_SESSION['steamid']])->first();


        if(!$query) {
              $user = $this->Users->newEntity();
              $user->steamid = $_SESSION['steamid'];
              $user->avatar = $_SESSION['avatarfull'];
              $user->verified = 0;
              $user->number = 0;
              $user->won = 0;
              $user->entered = 0;
              $user->joined = date("Y-m-d");
              $sav = $this->Users->save($user);

              $this->loadModel('Userprofiles');
              $userprofile = TableRegistry::get('Userprofiles');

              $userprof = $userprofile->newEntity();
              $userprof->ownerid = $sav->id;
              $userprof->profiledescription = "I love this website";
              $userprof->profiletitle = "The best website";
              $userprofile->save($userprof);
        }
      }

      $entry = TableRegistry::get('Entry');
      $raffles = TableRegistry::get('Raffles');
      $items = TableRegistry::get('Items');
      $news = TableRegistry::get('News');
      $newsObject = $news->find()->all();
      $this->set('news', $newsObject);
      //Get the latest winner in the raffle
      $query = $raffles->find()->where(['inactive' => 1])->order(['id' => 'DESC'])->first();
      $query = $query->toArray();
      $latest = $query['winner'];
      $key = "637D92A81FBB0C9CDCA06C1F940E8178";
      $url = file_get_contents("https://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=".$key."&steamids=".$latest);
      $content = json_decode($url, true);
      $ava = $content['response']['players'][0]['avatar'];
      $this->set('latest', $ava);
      $this->set('ava', $content['response']['players'][0]['personaname']);
      $this->set('lateststeamid', $content['response']['players'][0]['steamid']);

      //Get the top 3 raffles
      $query = $raffles->find()->where(['inactive' => 0])->order(['id' => 'DESC'])->limit(3)->all();
        if($query) {
          $query = $query->toArray();
        }
        foreach($query as $q) {
          $time = $q['timeended'];
          $q['time'] = $time;
          $itemquery = $items->find()->where(['raffleid' => $q['id']]);
          $entriesquery = $entry->find()->where(['raffleid' => $q['id']]);
          if($itemquery) {
            $q['items'] = $itemquery->toArray();
          }
          if($entriesquery) {
            $q['entry'] = sizeof($entriesquery->toArray());
          }
        }

        $this->set('raffles', $query);
        $count = count($path);
        if (!$count) {
            return $this->redirect('/');
        }
        if (in_array('..', $path, true) || in_array('.', $path, true)) {
            throw new ForbiddenException();
        }
        $page = $subpage = null;

        if (!empty($path[0])) {
            $page = $path[0];
        }
        if (!empty($path[1])) {
            $subpage = $path[1];
        }
        $this->set(compact('page', 'subpage'));

        try {
            $this->render(implode('/', $path));
        } catch (MissingTemplateException $exception) {
            if (Configure::read('debug')) {
                throw $exception;
            }
            throw new NotFoundException();
        }
    }

}
