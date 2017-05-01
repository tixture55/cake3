<?php
namespace App\Controller;
use Cake\ORM\TableRegistry;

final class InsertPostController extends InsertController{


	protected $reply;
	protected $post;

        function __construct(){
		parent::__construct();

		$reply = $this->Ticket_replies->newEntity();
		$this->reply = $reply;

		$post = $this->Ticket->newEntity();
		$this->post = $post;
	}	

	//画面によって、セットするタイトルを変える
	public function postTicketReply($req , $ticket_id){


		$this->reply->details = $req->data('detail'); 

		if($req->data('status') == 0){
			$this->reply->status = "open";
		}else{
			$this->reply->status ="close";
		}

		$this->reply->target_name = $req->data('target_name');
		$this->reply->posts_id = $ticket_id;
		$this->reply->last_update = date('Y/m/d H:i:s');
		$this->Ticket_replies->save($this->reply);
	}
	
        public function postTicket($req){

		$this->post->task_id = $req->data('works'); 
		$this->post->posts_id = $req->data('works'); 
		$this->post->details = $req->data('detail'); 

    		$tickets = $this->Ticket->find()
			->select(['task_id','details'])
			->where(['Tickets.details' => $this->post->details]);
		$this->post->title  = $req->data('ticket_title'); 
		
		if($req->data('status') == 0){
			$this->post->status = "open";
		}else{
			$this->post->status ="close";
		}

		$this->post->target_name = $req->data('target_name');
		$this->post->last_update = date('Y/m/d H:i:s');
		$this->post->deadline = date('Y/m/d H:i:s');
		
		if($tickets->count() > 0){
		
		}else{
		 	$this->Ticket->save($this->post);
		}
				
		return $this->post;
	}



}

