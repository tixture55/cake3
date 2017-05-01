<?php
namespace App\Controller;
use Cake\ORM\TableRegistry;

final class InsertPostController extends InsertController{


        function __construct(){
		parent::__construct();

	}	

	//画面によって、セットするタイトルを変える
	public function postTicketReply($req , $ticket_id){


		$this->reply->details = $req->data('detail'); 

    		$ticket_replies = $this->Ticket_replies->find()
			->select(['task_id','details'])
			->where(['Ticket_replies.details' => $this->reply->details]);
		if($req->data('status') == 0){
			$this->reply->status = "open";
		}else{
			$this->reply->status ="close";
		}

		$this->reply->target_name = $req->data('target_name');
		$this->reply->posts_id = $ticket_id;
		$this->reply->last_update = date('Y/m/d H:i:s');
		
		if($ticket_replies->count() > 0){
		
		}else{
		 	//ticketsテーブル、ticket_repliesテーブル両方にsaveできるように書き換える
			//$this->Ticket->save($this->reply);
		 	$this->Ticket_replies->save($this->reply);
		}
	}
	
        public function postTicket($req){

		$this->reply->task_id = $req->data('works'); 
		$this->reply->posts_id = $req->data('works'); 
		$this->reply->details = $req->data('detail'); 

    		$tickets = $this->Ticket->find()
			->select(['details'])
			->where(['Tickets.details' => $this->reply->details]);
		$this->reply->title  = $req->data('ticket_title'); 
		
		if($req->data('status') == 0){
			$this->reply->status = "open";
		}else{
			$this->reply->status ="close";
		}

		$this->reply->target_name = $req->data('target_name');
		$this->reply->last_update = date('Y/m/d H:i:s');
		$this->reply->deadline = date('Y/m/d H:i:s');
		
		if($tickets->count() > 0){
		
		}else{
		 	$this->Ticket->save($this->reply);
		}
				
		return $this->reply;
	}



}

