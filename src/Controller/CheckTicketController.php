<?php
namespace App\Controller;
use Cake\ORM\TableRegistry;

final class CheckTicketController extends InsertController{


        function __construct(){
		parent::__construct();

	}	
	public function checkTicket(){

		$arr = [];

    		$tickets = $this->Ticket->find()
			->select(['status'])
			->order(['last_update' => 'DESC'])
			->limit(5);


		$cnt = 0;

		foreach($tickets as $val){
			
			array_push($arr , $val['status']);
			if(strcmp($val['status'] , 'open') === 0) $cnt = $cnt + 1;
		}
		
		return $cnt;
		
	}
	



}

