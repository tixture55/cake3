<?php
namespace App\Controller;
use Cake\ORM\TableRegistry;
final class InsertHistoryController {


	//画面によって、セットするタイトルを変える
	public function insertReadHistory(){

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
	

}

