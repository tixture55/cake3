<?php
namespace App\Controller;

<<<<<<< HEAD
abstract class InsertController {}
=======

	//画面によって、セットするタイトルを変える
	public function postTicketReply($req , $ticket_id){

		$this->Ticket_replies = TableRegistry::get('Ticket_replies');
		$this->Ticket = TableRegistry::get('Tickets');
		$ticket_update_status = $this->Ticket->get($ticket_id);

		$reply = $this->Ticket_replies->newEntity();
		$reply->details = $req->data('detail'); 
		
                //二重送信の禁止
                $tickets_duplicate = $this->Ticket_replies->find()
			->select(['details'])
			->where(['Ticket_replies.details' => $reply->details]);
		if($req->data('status') == 0){
			$reply->status = "open";
		}else{
			$reply->status ="close";
		}

		$reply->target_name = $req->data('target_name');
		$reply->posts_id = $ticket_id;
		$reply->last_update = date('Y/m/d H:i:s');
		//if(!isset($tickets_duplicate) && $reply->status ==="open") $this->Ticket_replies->save($reply);
		if($reply->status ==="open"){
			 if($_POST['send']) $this->Ticket_replies->save($reply);
		}elseif($reply->status ==="close"){
			 if($_POST['send']){ 
				$ticket_update_status->status ="close";
				$this->Ticket->save($ticket_update_status);
			 }
		}
	}
	
        public function postTicket($req){
		$this->Ticket = TableRegistry::get('Tickets');

		$post = $this->Ticket->newEntity();
		$post->details = $req->data('detail'); 
  		
		$tickets = $this->Ticket->find()
			->select(['task_id','details'])
			->where(['Tickets.details' => $post->details]);
		
		if($tickets){
			foreach ($tickets as $this->value) {
				$task_id = $this->value['task_id'];
				$details = $this->value['details'];
			}
			$task_id = $req->data('works');
		}
		$post->title  = $req->data('ticket_title'); 
		
		if($req->data('status') == 0){
			$post->status = "open";
		}else{
			$post->status ="close";
		}

		$post->task_id  = $task_id;
		$post->posts_id  = $task_id;
		$post->target_name = $req->data('target_name');
		$post->last_update = date('Y/m/d H:i:s');
		$post->deadline = date('Y/m/d H:i:s');
		$this->Ticket->save($post);
		if(!isset($details) && isset($task_id) ) $this->Ticket->save($post);
		//if(!isset($details)) $this->Ticket->save($post);
	}



}
>>>>>>> added modifying posts view status function when ticket creator closes his ticket

