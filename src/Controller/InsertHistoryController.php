<?php
namespace App\Controller;

final class InsertHistoryController extends InsertController{


        function __construct(){
		parent::__construct();

	}	
	
	//画面によって、セットするタイトルを変える
	public function insertReadHistory(int $ticket_id){


		$this->reply->status ="already read";

		$this->reply->posts_id = $ticket_id;
		$this->reply->last_update = date('Y/m/d H:i:s');
		
		if($this->Ticket_read_histories->save($this->reply) === false){
			//エラー処理
			return;
		}
	}
	

}

