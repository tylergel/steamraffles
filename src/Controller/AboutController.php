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
class AboutController extends AppController
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

     public function terms() {

     }
     public function privacy() {

     }
     public function privacies() {

     }
     public function contact() {

     }
     public function mail() {
       if($this->request->is('post')) {
         $this->loadModel('Contact');
         $news = TableRegistry::get('Contact');
         $data = $this->request->data;
         $contactEnt = $this->Contact->newEntity();
         $contactEnt->name = $data['name'];
         $contactEnt->email = $data['email'];
          $contactEnt->message = $data['message'];
          $this->Contact->save($contactEnt);
          $this->Flash->set('Request received!  We will contact you back shortly', [
              'element' => 'success'
          ]);
          return $this->redirect(
            ['controller' => 'About', 'action' => 'contact']
        );
       }
     }

     public function sponsors() {
       $this->loadModel('Sponsors');
       $sponsors = TableRegistry::get('Sponsors');
       $allSponsors = $sponsors->find()->all();
       $this->set('sponsors', $allSponsors);
     }

     public function rules() {
       if($this->request->is('post')) {
         $steamid = $_SESSION['steamid'];
         $key = "637D92A81FBB0C9CDCA06C1F940E8178";
         $json = file_get_contents('http://api.steampowered.com/ISteamUser/GetPlayerBans/v1/?key='.$key.'&steamids='.$steamid.'');
         $obj = json_decode($json);
         $denied = false;
         if(empty($this->request->data['profileurl'])) {
           $this->Flash->set('Enter trade offer url', [
               'element' => 'error'
           ]);
           return $this->redirect(
             ['controller' => 'About', 'action' => 'rules']
         );
         }
         $users = TableRegistry::get('Users');
         $query = $users->find()->where(['steamid' => $steamid]);
         foreach ($query as $article) {
           $entered = $article->entered;
         }
         if($entered < 5) {
           $denied = true;
           $this->Flash->set('You have not entered enough raffles', [
               'element' => 'error'
           ]);

         }
         $communityban = $obj->players[0]->CommunityBanned;
         $vacban = $obj->players[0]->VACBanned;
         $economyban = $obj->players[0]->EconomyBan;
         if($communityban != false || $vacban != false || $economyban != 'none') {
           $denied = true;
           $this->Flash->set('You are banned.  You cannot create raffles.', [
               'element' => 'error'
           ]);
         }
         $games = TableRegistry::get('Views');
         $apps = $games->find()->all();

         $json = file_get_contents('http://api.steampowered.com/IPlayerService/GetRecentlyPlayedGames/v0001/?key='.$key.'&steamid='.$steamid.'&format=json');
         $obj = json_decode($json);
         $hastime = false;
         foreach($obj->response->games as $game) {
           foreach($apps as $app) {
             if($app->appid == $game->appid);
              $timeplayed = $game->playtime_forever;
              if(($timeplayed) > 12000) {
                $hastime = true;
              }
           }
         }
         if(!$hastime) {
           $denied = true;
           $this->Flash->set('You do not have more than 200 hours played on one of the raffling games.', [
               'element' => 'error'
           ]);
         }
         if($denied) {
           return $this->redirect(
             ['controller' => 'About', 'action' => 'rules']
         );

         }
         else {
           $query = $users->query();
           $query->update()
               ->set(['verified' => '1', 'tradeurl' => $this->request->data['tradeurl']])
               ->where(['steamid' => $steamid])
               ->execute();
               $this->Flash->set('Verified!  You can now create raffles.', [
                   'element' => 'error'
               ]);
         }
       }
     }

}
