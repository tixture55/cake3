<?php

//CakePHP3のPostsController.php
namespace App\Controller;
use Cake\Routing\Router;
use Cake\Routing\Route\DashedRoute;

class PostsController extends AppController {
 
  public $helpers = [
        'Paginator' => ['templates' => 'paginator-templates']
    ];
 
  public $paginate = [
	'contain' => ['Tickets'],
        'limit' => 4,
        'order' => [
            'Posts.name' => 'desc',
	    'Tickets.id' => 'asc'
        ]
    ];
  

  public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Paginator');
    }

  
  public function index() {
 
    unset($this->list['id']);
    unset($this->list['commit']);

    if($this->Auth->user()['id'] === 4){
        echo 'ようこそ！白石さん';
        $session = $this->request->session();
        $session->write('user_id', $this->Auth->user()['id'] );
    }
    $posts = $this->Post->find()->all();
    $tickets = $this->Ticket->find()
		->order(['last_update' => 'DESC'])
		->limit(5);

  
    $open_ticket_num = parent::mpull($this->list, 'checkTicket' , null);
 
    if($open_ticket_num < 3){
    	$tickets = $this->Ticket->find()
    		->where(['status' => 'open'])	
		->order(['last_update' => 'DESC'])
		->limit(3);


        $union_query = $this->Ticket->find()
    		->where(['status' => 'close'])	
		->order(['last_update' => 'DESC'])
		->limit(2);
	

	$tickets->union($union_query);
	//unionのパラメータがなければ、esort()をAppControllerに実装する
		/*esort($entity , $sort_key)
			$entity    : find()の結果セット
			$sort_key  : sortの方法
			$order:    : ASC , DESC

			return     :sortされたentity
		*/
	//$tickets->order(['last_update' => 'DESC']);
	//$tickets->union($union_query , array([order] => 'last_update' => 'DESC'));

    }
 
    $users = $this->paginate($this->Post);
    $tasks = $this->Post->find()
		->select(['work']);
    $titles = $this->viewVars['titles'];
    $this->set(compact("posts","users", "tasks", "tickets","titles"));
    
    if(isset($_POST['send']) && $this->request->data('detail')){
	//$ins = new InsertPostController();
        //$ins->postTicket($this->request , $this->Auth->user()['id'] );
        $this->Post->postTicket($this->request , $this->Auth->user()['id'] );
    }
  
  }
}
