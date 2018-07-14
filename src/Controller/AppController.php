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

use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\Http\ServerRequest;
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;
/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */

     public $redirect = null;

    public function initialize()
    {
        parent::initialize();
        $games = TableRegistry::get('Views');
        $apps = $games->find()->all();
        $this->set('apps', $apps);
        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');

        $cakeDescription = 'CakePHP: the rapid development php framework';
        session_name('NMCORE');
        if (session_status() == PHP_SESSION_NONE) {
        		session_start();
        }

        if($_SERVER['REMOTE_ADDR'] == '::1') {

          $_SESSION['steamid'] = '76561198058670847';
          $_SESSION['personaname'] = 'Legend';
          $_SESSION['avatarfull'] = "https://steamcdn-a.akamaihd.net/steamcommunity/public/images/avatars/72/72f78b4c8cc1f62323f8a33f6d53e27db57c2252.jpg";
        }
        ob_start();
        include 'prod.php';
        $this->redirect = $redirecturl;
        $this->set('redirecturl', $redirecturl);



    }




}
