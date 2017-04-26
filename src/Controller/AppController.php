<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link      http://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;
use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\Routing\Router;
use Cake\Routing\Route\DashedRoute;



/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link http://book.cakephp.org/3.0/en/controllers.html#the-app-controller
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


    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');
        $this->loadComponent('Auth', [
            
            'authenticate' => [
		    'Form' => [
                        'fields' => [
                            'username' => 'username',
                            'password' => 'password'
                        ]
                    ]
                ],
	    'loginRedirect' => [
                'controller' => 'Posts',
                'action' => 'index'
            ],
            'logoutRedirect' => [
                'controller' => 'Pages',
                'action' => 'display',
                'home'
            ]
        ]);

        $title_arr = array();

	//$this->getTraceAsString();


        $this->set('titles', $this->_getTitle());
        

    
    }
     
      public function isAuthorized($user) /* add */
    {
        return false;
    }

    /**
     * Before render callback.
     *
     * @param \Cake\Event\Event $event The beforeRender event.
     * @return void
     */
     
    public function beforeFilter(Event $event)
    {
        $this->Auth->allow(['view', 'display']);
    }


    public function beforeRender(Event $event)
    {
        if (!array_key_exists('_serialize', $this->viewVars) &&
            in_array($this->response->type(), ['application/json', 'application/xml'])
        ) {
            $this->set('_serialize', true);
        }
    }
    
    private function _getTitle(){
        $view = strstr(Router::reverse($this->request) , "cake3/");               $view = str_replace("cake3/" , "" , $view);
        if(strpos($view , "/" , 0)) $view = strstr($view,"/", TRUE);
        if(strpos($view , "?" , 0)) $view = strstr($view,"?", TRUE);
      
        $list = new TicketFormEditController(); 
	$titles = $list->setTitle($view); 
        $task_flg = $list->setTicketForm($view);
        
        if(isset($title) && isset($view)) array_push($titles,$view);
        return $titles; 
    }
}
