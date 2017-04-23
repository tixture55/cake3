<?php

//CakePHP3のPostsController.php
namespace App\Controller;
use Cake\ORM\TableRegistry;
use Cake\Routing\Router;
use Cake\Routing\Route\DashedRoute;
use Cake\Network\Exception\NotFoundException;

class CommitsController extends AppController {
 
  private $id;

  public $helpers = [
        'Paginator' => ['templates' => 'paginator-templates']
    ];
 
  public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Paginator');
        $this->loadComponent('Flash');
	//$this->loadComponent('Security');
        //$this->Security->requireSecure();
    }
  

  public function detail() {
 

    $id = new GetIdFromUrlController;
    $commit_id = $id->getTicketId(Router::reverse($this->request));    
 
    $this->Post = TableRegistry::get('Posts');
    $this->Ticket = TableRegistry::get('Tickets');
    $this->Ticket_replies = TableRegistry::get('Ticket_replies');
    $this->Commit = TableRegistry::get('Commits');
    $this->Task_detail = TableRegistry::get('Task_details');
   

    $tickets = $this->Ticket->find()
	//->select(['id','posts_id', 'status', 'details', 'target_name','last_update'])
	->where(['Tickets.id' => $ticket_id])->contain(['Posts']);
    
    
    if($tickets){
	foreach ($tickets as $this->value) {
            $posts_id = $this->value['posts_id'];
            $ticket_id = $this->value['id'];
        }
    }elseif(empty($tickets)){
        throw new NotFoundException(__('チケットが見つかりません。'));
    }

$ticket_replies = $this->Ticket_replies->find()->where(['Ticket_replies.posts_id' => $ticket_id]);
   
    $commits = $this->Commit->find()->where(['Commits.posts_id' => $posts_id])->contain(['Posts']);
    $posts = $this->Post->find()->where(['Posts.id' => $posts_id])->contain(['Tickets']);
    

    $this->set('posts', $posts);
    $this->set('tickets', $tickets);
    $this->set('ticket_replies', $ticket_replies);
    $this->set('commits', $commits);
    

    $commit = new GetCommitController();
    $commit_arr = $commit->getCommit(1,3);    
    $commit_num = $commit->getCommitNumber();
    
    $this->set('commit_num', $commit_num);

    $titles = $this->viewVars['titles'];
    $this->set('titles', $titles);
    $this->set('commit_arr', $commit_arr);
    
    if($this->request->data('detail')){
        $ins = new InsertController();
        $ins->postTicketReply($this->request , $ticket_id);     
    
    }
  
  }
}
