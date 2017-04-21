<?php
namespace App\Controller;
use Cake\ORM\TableRegistry;
final class InsertController {


	//画面によって、セットするタイトルを変える
	public function postTicketReply($req , $ticket_id){

		$this->Ticket_replies = TableRegistry::get('Ticket_replies');

		$reply = $this->Ticket_replies->newEntity();
		$reply->details = $req->data('detail'); 
		if($req->data('status') == 0){
			$reply->status = "open";
		}else{
			$reply->status ="close";
		}

		$reply->target_name = $req->data('target_name');
		$reply->posts_id = $ticket_id;
		$reply->last_update = date('Y/m/d H:i:s');
		$this->Ticket_replies->save($reply);
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
		}
		
		$post->title  = $req->data('ticket_title'); 
		
		if($req->data('status') == 0){
			$post->status = "open";
		}else{
			$post->status ="close";
		}

		$post->target_name = $req->data('target_name');
		$post->last_update = date('Y/m/d H:i:s');
		$post->deadline = date('Y/m/d H:i:s');
		if(!isset($details) && isset($task_id) ) $this->Ticket->save($post);
	}






}

