<?php

//CakePHP3のPostsController.php
namespace App\Controller;
use Cake\Network\Exception\NotFoundException;

class TicketsController extends AppController {
 
 
  public function initialize()
    {
        parent::initialize();
    	
    }
  
  public function detail() {
 
    $id = new GetIdFromUrlController;
    $ticket_id = parent::mpull($id ,'getTicketId');    
 
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
	->select(['posts_id'])
	->where(['Ticket_read_histories.posts_id' => $ticket_id]);
   
    $ticket_read_histories->hydrate(false);
    $ticket_read_result = $ticket_read_histories->toList();

    if(array_key_exists('posts_id' , $ticket_read_result)){
    	    
	    $this->set('isReadTicket', true);
	    
    }


$ticket_replies = $this->Ticket_replies->find()->where(['Ticket_replies.posts_id' => $ticket_id]);
   
    $commits = $this->Commit->find()->where(['Commits.posts_id' => $posts_id])->contain(['Posts']);
    
    $posts = $this->Post->find()->where(['Posts.id' => $posts_id])->contain(['Tickets']);
    

    $commit = new GetCommitController();
    $commit_arr = parent::mpull($commit ,'getCommit');    
    $commit_num = parent::mpull($commit ,'getCommitNumber');    
    

    $titles = $this->viewVars['titles'];
    $this->set(compact('posts','tickets','ticket_replies','commits','commit_num',"commit_arr","titles"));
    
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
