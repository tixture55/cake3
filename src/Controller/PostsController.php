<?php

//CakePHP3のPostsController.php
namespace App\Controller;
use Cake\ORM\TableRegistry;

class PostsController extends AppController {
  public function index() {
    $this->Post = TableRegistry::get('Posts');
    $this->Ticket = TableRegistry::get('Tickets');
    $posts = $this->Post->find()->all();
    $tickets = $this->Ticket->find()->all();
    $this->set('posts', $posts);
    $this->set('tickets', $tickets);
  }
}
