<?php

//CakePHP3のPostsController.php
namespace App\Controller;
use Cake\ORM\TableRegistry;
use Cake\Routing\Router;
use Cake\Routing\Route\DashedRoute;
use Cake\Network\Exception\NotFoundException;

class TicketsController extends AppController {
 
 
  public function initialize()
    {
        parent::initialize();
    	
	$this->Post = TableRegistry::get('Posts');
    	$this->Ticket = TableRegistry::get('Tickets');
    	$this->Ticket_replies = TableRegistry::get('Ticket_replies');
    	$this->Ticket_read_histories = TableRegistry::get('Ticket_read_histories');
    	$this->Commit = TableRegistry::get('Commits');
    	$this->Task_detail = TableRegistry::get('Task_details');
    }
  

  public function detail() {
 
    $id = new GetIdFromUrlController;
    $ticket_id = $id->getTicketId(Router::reverse($this->request));    
 
    $tickets = $this->Ticket->find()
	->where(['Tickets.id' => $ticket_id])->contain(['Posts']);
    
    
    if($tickets){
	foreach ($tickets as $this->value) {
            $posts_id = $this->value['posts_id'];
	    $ticket_id = $this->value['id'];
        }
    }elseif(empty($tickets)){
        throw new NotFoundException(__('チケットが見つかりません。'));
    }
    
    $ticket_read_histories = $this->Ticket_read_histories->find()
	->where(['Ticket_read_histories.posts_id' => $ticket_id]);
    if($ticket_read_histories){
	foreach ($ticket_read_histories as $this->value) {
            $posts_id_read = $this->value['posts_id'];
    	    
	    if($posts_id_read  > 0) $this->set('isReadTicket', true);
	    
	}
    }


$ticket_replies = $this->Ticket_replies->find()->where(['Ticket_replies.posts_id' => $ticket_id]);
   
    $commits = $this->Commit->find()->where(['Commits.posts_id' => $posts_id])->contain(['Posts']);
    
    $posts = $this->Post->find()->where(['Posts.id' => $posts_id])->contain(['Tickets']);
    

    $this->set('posts', $posts);
    $this->set('tickets', $tickets);
    $this->set('ticket_replies', $ticket_replies);
    $this->set('commits', $commits);
    

    $commit = new GetCommitController();
    $commit_arr = $commit->getCommit(1,23);    
    $commit_num = $commit->getCommitNumber();
    
    $this->set('commit_num', $commit_num);

    $titles = $this->viewVars['titles'];
    $this->set('titles', $titles);
    $this->set('commit_arr', $commit_arr);
    
    if($this->request->data('detail')){
        $ins = new InsertPostController();
        $ins->postTicketReply($this->request , $ticket_id);     
    
    }
  
  }
  public function modify() {
	  
	if($this->request->isAjax()){
		
		$ins = new InsertHistoryController();
        	$ins->insertReadHistory($this->request->params['?']['name']);     
  	}else{ 
		$this->log("Illegal Request was sent not in the ajax one.".__METHOD__."()  line:87",'critical');	  
	}
  }
}
