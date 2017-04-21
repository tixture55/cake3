<?php

//CakePHP3のPostsController.php
namespace App\Controller;
use Cake\ORM\TableRegistry;
use Cake\Routing\Router;
use Cake\Routing\Route\DashedRoute;

class TasksController extends AppController {
 

  public $helpers = [
        'Paginator' => ['templates' => 'paginator-templates']
    ];
 

  public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Paginator');
    }
  
  
  public function detail() {
 
    
    $this->Post = TableRegistry::get('Posts');
    $this->Task_detail = TableRegistry::get('Task_details');
    
    //詳細を知りたい案件のtaskIdの取得 
    $task_id = strstr(Router::reverse($this->request) , "taskId=");           $task_id = str_replace("taskId=" , "" , $task_id);
       
    $posts = $this->Post->find()->where(['Posts.id' => $task_id]);
    $task_details = $this->Task_detail->find()->where(['Task_details.task_id' => $task_id]);
    
    $this->set('posts', $posts);
    $this->set('task_details', $task_details);
    
    $titles = $this->viewVars['titles'];
    $this->set('titles', $titles);
  
  }
}
