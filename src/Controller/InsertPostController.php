<?php
namespace App\Controller;
use Cake\ORM\TableRegistry;

final class InsertPostController extends InsertController{


	//画面によって、セットするタイトルを変える
	public function postTicketReply($req , $ticket_id){


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

		$post = $this->Ticket->newEntity();
		$post->task_id = $req->data('works'); 
		$post->posts_id = $req->data('works'); 
		$post->details = $req->data('detail'); 
    		$tickets = $this->Ticket->find()
			->select(['task_id','details'])
			->where(['Tickets.details' => $post->details]);
		$post->title  = $req->data('ticket_title'); 
		
		if($req->data('status') == 0){
			$post->status = "open";
		}else{
			$post->status ="close";
		}

		$post->target_name = $req->data('target_name');
		$post->last_update = date('Y/m/d H:i:s');
		$post->deadline = date('Y/m/d H:i:s');
		if($tickets->count() > 0){
		
		}else{
		 	$this->Ticket->save($post);
		}
	}






}

