<?php

//CakePHP3のPostsController.php
namespace App\Controller;
use Cake\ORM\TableRegistry;
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
    	$this->Post = TableRegistry::get('Posts');
    	$this->Ticket = TableRegistry::get('Tickets');
    }

  
  public function index() {
 

    $posts = $this->Post->find()->all();
    $tickets = $this->Ticket->find()
		->order(['last_update' => 'DESC'])
		->limit(5);

    //openチケットが3以上含まれているかのチェック(CheckTicketControllerをモックに置き換える)
    //$check_ticket = new CheckTicketController();
    //$open_ticket_num = checkTicket($tickets); 
    $open_ticket_num = 2; 

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
	

    }
 
    $users = $this->paginate($this->Post);
    $tasks = $this->Post->find()
		->select(['work']);
    $titles = $this->viewVars['titles'];
    $this->set(compact("posts","users", "tasks", "tickets","titles"));
    
    if(isset($_POST['send']) && $this->request->data('detail')){
	$ins = new InsertPostController();
        $ins->postTicket($this->request);     
    
    }
  
  }
}
