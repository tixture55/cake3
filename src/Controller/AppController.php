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
use Cake\ORM\TableRegistry;
use Cake\Http\ServerRequest;

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
 
    protected $list;

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

	$this->Post = TableRegistry::get('Posts');
    	$this->Ticket = TableRegistry::get('Tickets');
    	$this->Ticket_replies = TableRegistry::get('Ticket_replies');
    	$this->Ticket_read_histories = TableRegistry::get('Ticket_read_histories');
    	$this->Commit = TableRegistry::get('Commits');
    	$this->Task_detail = TableRegistry::get('Task_details');
        $title_arr = array();

        $this->set('titles', $this->_getTitle());
    	
	$check_ticket = new CheckTicketController();
        $id = new GetIdFromUrlController();
        $commit = new GetCommitController();
    	
	$obj_list = ['id' => $id , 'commit' => $commit , 'check_ticket' => $check_ticket];
        
	$this->list = $obj_list;
	$host = $this->request->env('HTTP_HOST');   
	$page = $this->request->getQuery('ticket_id');
	$isPost = $this->request->is('post');
	echo $isPost; 
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

 
    protected function mpull($list , String $method , $parameter){
        
	$arr = array();

	foreach($list as $obj){  	
	 
	   if ($obj instanceof CheckTicketController) {

		$num = $obj->checkTicket();
		
		return $num;	

	   }elseif($obj instanceof GetIdFromUrlController){
		if(strcmp($method , 'getId') === 0 ){
			$ticket_id = $obj->getId(Router::reverse($this->request));
			array_push($arr , $ticket_id);

		}elseif(strcmp($method , 'getCommitId') === 0){
			$commit_id = $obj->getCommitId(Router::reverse($this->request));
			return $commit_id;
			
		}
	   }elseif($obj instanceof GetCommitController){
		if(strcmp($method , 'getId') === 0 ){
			$commit_arr = $obj->getId(1,30);

			array_push($arr , $commit_arr);
		}elseif(strcmp($method , 'getCommitNumber') === 0){
			$commit_num = $obj->getCommitNumber();

			return $commit_num;

		}elseif(strcmp($method , 'getBranch') === 0){
		        $branch = $obj->getBranch();		
			return $branch;
		
		}elseif(strcmp($method , 'getCommitFileDiff') === 0){
		        $file_diff = $obj->getCommitFileDiff($parameter);		
			return $file_diff;		
		}elseif(strcmp($method , 'getCommitFileDiffDetail') === 0){
		        $file_diff = $obj->getCommitFileDiffDetail($parameter);
			return $file_diff;		
		}
	   }
	}
	return $arr;
    }

    protected function colorScheme(String $source_code){
	
	$replace_br = str_replace("@@", "<br><br>", $source_code);
	$replace_br = str_replace("+", "<br><div class=\"plus\">+", $replace_br);
	
	$replace_br = str_replace(");", ");</div><br>", $replace_br);
	$replace_br = preg_replace("/class[^=]/", "<font color=\"green\">class </font>", $replace_br);
	$replace_br = preg_replace("/abstract|protected|public|return|extends|final|new/", "<font color=\"green\">$0 </font>", $replace_br);
	$replace_br = preg_replace("/\&|\-/", "<font color=\"red\">$0</font>", $replace_br);
	$replace_br = preg_replace("/true|DESC/", "<font color=\"red\">$0</font>", $replace_br);
	$replace_br = preg_replace("/this/", "<font color=\"blue\">$0</font>", $replace_br);
	$replace_br = preg_replace("/\+/", "<font color=\"blue\">$0</font>", $replace_br);
	$replace_br = preg_replace("/\/\/.*/", "<font color=\"blue\">$0</font>", $replace_br);
	$replace_br = preg_replace("/\/\*.*/", "<font color=\"blue\">$0</font>", $replace_br);

        return $replace_br;
    }

 
    private function _getTitle(){
        $view = strstr(Router::reverse($this->request) , "cake3/");               
	$view = str_replace("cake3/" , "" , $view);
        
	if(strpos($view , "/" , 0)) $view = strstr($view,"/", TRUE);
        if(strpos($view , "?" , 0)) $view = strstr($view,"?", TRUE);
      
        $list = new TicketFormEditController(); 
	$titles = $list->setTitle($view); 
        $task_flg = $list->setTicketForm($view);
        
        if(isset($title) && isset($view)) array_push($titles,$view);
        return $titles; 
    }
}
