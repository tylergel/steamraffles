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
class AdminController extends AppController
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
        if(!$query->admin) {
              return $this->redirect(
                $this->referer()
            );
        }
      }

    }

     public function index() {
       $this->loadModel('News');
       $news = TableRegistry::get('News');
       $allNews = $news->find()->all();
       $this->set('news', $allNews);

       $this->loadModel('Users');
       $users = TableRegistry::get('Users');
       $allUsers = $users->find()->order(['toclaim' => 'DESC'])->all();
       $this->set('users', $allUsers);

       $this->loadModel('Sponsors');
       $sponsors = TableRegistry::get('Sponsors');
       $allSponsors = $sponsors->find()->all();
       $this->set('sponsors', $allSponsors);

       $this->loadModel('Contact');
       $contact = TableRegistry::get('Contact');
       $allContact = $contact->find()->all();
       $this->set('contact', $allContact);

     }
     public function deleteNews($id) {
       $this->loadModel('News');
       $comments = TableRegistry::get('News');
       $entity = $this->News->get($id);
       $result = $this->News->delete($entity);
       return $this->redirect(

         ['controller' => 'admin', 'action' => 'index']
     );
     }
     public function addNews() {
       if($this->request->is('post')) {
         $this->loadModel('News');
         $news = TableRegistry::get('News');
         $data = $this->request->data;
         $newsEnt = $this->News->newEntity();
         $newsEnt->title = $data['title'];
         $newsEnt->news = $data['news'];
          $this->News->save($newsEnt);
          return $this->redirect(

            ['controller' => 'admin', 'action' => 'index']
        );
       }
     }

     public function deleteSponsor($id) {
       $this->loadModel('Sponsors');
       $sponsor = TableRegistry::get('Sponsors');
       $entity = $this->Sponsors->get($id);
       $result = $this->Sponsors->delete($entity);
       return $this->redirect(

         ['controller' => 'admin', 'action' => 'index']
     );
     }
     public function addSponsor() {
       if($this->request->is('post')) {
         $this->loadModel('Sponsors');
         $sponsor = TableRegistry::get('Sponsors');
         $data = $this->request->data;
         $sponsEnt = $this->Sponsors->newEntity();
         $sponsEnt->title = $data['title'];
         $sponsEnt->description = $data['description'];
         $sponsEnt->link = $data['link'];
         $sponsEnt->linkname = $data['linkname'];
          $this->Sponsors->save($sponsEnt);
          return $this->redirect(
            ['controller' => 'admin', 'action' => 'index']
        );
       }
     }


}
