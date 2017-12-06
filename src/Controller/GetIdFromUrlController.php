<?php
namespace App\Controller;


final class GetIdFromUrlController extends GetIdController{

	protected $ticket_id;
	protected $commit_id;
	protected $url;

	public function getId(String $url){
	   
	   $ticket_id = strstr($url , "ticket_id=");
	   $ticket_id = str_replace("ticket_id=" , "" , $ticket_id);
           $url_arr = explode("&" , $ticket_id);
	   
	   $this->ticket_id = $url_arr[0];
          
           return $this->ticket_id;
	
	}
	
	public function getCommitId(String $url){
	 
           $ticket_id = strstr($url , "ticket_id=");
	   $ticket_id = str_replace("ticket_id=" , "" , $ticket_id);
           $url_arr = explode("&" , $ticket_id);
	   
	   $this->ticket_id = $url_arr[0];
	   $this->commit_id = $url_arr[1];
           $this->commit_id = strstr($this->commit_id  , "commit_id=");
	   $this->commit_id = str_replace("commit_id=" , "" , $this->commit_id);
		
	   return $this->commit_id;
	
	}
	

}
