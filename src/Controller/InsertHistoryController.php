<?php
namespace App\Controller;
use Cake\ORM\TableRegistry;
final class InsertHistoryController extends InsertController{


	//画面によって、セットするタイトルを変える
	public function insertReadHistory(int $ticket_id){

		$this->Ticket_read_histories = TableRegistry::get('Ticket_read_histories');

		$reply = $this->Ticket_read_histories->newEntity();
		$reply->status ="already read";

		//$reply->target_name = $req->data('target_name');
		$reply->posts_id = $ticket_id;
		$reply->last_update = date('Y/m/d H:i:s');
		
		$this->Ticket_read_histories->save($reply);
	}
	

}

