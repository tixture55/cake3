<?php

//CakePHP3のPostsController.php
namespace App\Controller;
use Cake\ORM\TableRegistry;

class PostsController extends AppController {
 

  public $helpers = [
        'Paginator' => ['templates' => 'paginator-templates']
    ];
 
  public $paginate = [
        'limit' => 2,
        'order' => [
            'Posts.name' => 'desc'
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
    //print_r($posts);
    $tickets = $this->Ticket->find()->all();
    
    $this->set('posts', $posts);
    //$this->set('posts', $this->paginate);
    $users = $this->paginate($this->Post);
    $this->set('users', $users);
    $this->set('tickets', $tickets);
  
  }
}
