<?php
namespace App\Controller;


final class GetIdFromUrlController extends GetIdController{

	protected $ticket_id;

        //画面によって、セットするタイトルを変える
	public function getTicketId(String $url){
           $ticket_id = strstr($url , "ticket_id=");
           $ticket_id = str_replace("ticket_id=" , "" , $ticket_id);
	   

           $this->ticket_id = $ticket_id;
           /* 
	    if(strcmp($view , "tasks" ) === 0){	
	    	$this->title = array("案件名","総コミット数","クライアント名","直近のチケット","タグ");
	    }elseif(strcmp($view , "tickets") === 0){
		$this->title = array("チケット名","status","案件名","チケット内容","最終更新日時");

	    }elseif(strcmp($view , "posts") === 0){
	    	$this->title = array("担当者名","案件名","関連チケット数","最終更新日時");
	    }else{

	    }
 		return $this->ticket_id;
	   */
		return $this->ticket_id;
	}
	

}