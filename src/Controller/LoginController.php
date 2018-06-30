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

/**
 * Static content controller
 *
 * This controller will render views from Template/Pages/
 *
 * @link https://book.cakephp.org/3.0/en/controllers/pages-controller.html
 */
class LoginController extends AppController
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
    public function index()
    {
      session_name('NMCORE');
      if (session_status() == PHP_SESSION_NONE) {

        session_start();
        $_SESSION = array();
        session_destroy();
        session_name('NMCORE');
        session_start();
      }
      require_once('google-login-api.php');
      // Google passes a parameter 'code' in the Redirect Url
      if(isset($_GET['code'])) {
      	try {
          $this->loadComponent('Google');
      		$gapi = $this->Google;

      		// Get the access token
      		$data = $this->Google->GetAccessToken(CLIENT_ID, CLIENT_REDIRECT_URL, CLIENT_SECRET, $_GET['code']);

      		// Get user information
      		$user_info = $gapi->GetUserProfileInfo($data['access_token']);
      		$uEmail = $user_info['emails']['0']['value'];
      		$result = $this->Users->find()
            ->where(['email' => $uEmail])
            ->first();

      		if(empty($result)) {
            $user = $this->Users->newEntity();
            $data = array(
                'Users' => array(
                    'email' => $uEmail
                )
            );
             $user = $this->Users->patchEntity($user, $data);
            // save the data
            $this->Users->save($user);

      		}
      		// Now that the user is logged in you may want to start some session variables
        
      		 $_SESSION['logged_in'] = 1;
      		 $_SESSION['avatar'] = $user_info['image']['url'];
      		 $_SESSION['email'] = $uEmail;
      		// You may now want to redirect the user to the home page of your website
      		 header('Location: ../');

      		 exit();
      	}
      	catch(Exception $e) {
      		echo $e->getMessage();
      		exit();
      	}
      }
    }
}
