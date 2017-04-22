<?php
namespace App\Controller;


final class GetIdFromUrlController extends GetIdController{

	protected $ticket_id;

        //画面によって、セットするタイトルを変える
	public function getTicketId(String $url){
           
	   $ticket_id = strstr($url , "ticket_id=");
           $ticket_id = str_replace("ticket_id=" , "" , $ticket_id);
	   

           $this->ticket_id = $ticket_id;
		
		return $this->ticket_id;
	}
	

}
