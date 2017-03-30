<?php

//CakePHP3のPostsController.php
namespace App\Controller;
use Cake\ORM\TableRegistry;

class PostsController extends AppController {
  public function index() {
    $this->Post = TableRegistry::get('Posts');
    $posts = $this->Post->find()->all();
    $this->set('posts', $posts);
  }
}
