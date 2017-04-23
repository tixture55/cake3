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
    }
  
  public function index() {
 
    $this->Post = TableRegistry::get('Posts');
    $this->Ticket = TableRegistry::get('Tickets');

    $posts = $this->Post->find()->all();
    $tickets = $this->Ticket->find()
			->order(['last_update' => 'DESC'])
			->limit(3);
 
    $users = $this->paginate($this->Post);
    $tasks = $this->Post->find()
		->select(['work']);
    $titles = $this->viewVars['titles'];
    $this->set(compact("posts","users", "tasks", "tickets","titles"));
    
    if(isset($_POST['send']) && $this->request->data('detail')){
        $ins = new InsertController();
        $ins->postTicket($this->request);     
    
    }
  
  }
}
