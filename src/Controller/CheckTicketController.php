<?php
namespace App\Controller;
use Cake\ORM\TableRegistry;

final class CheckTicketController extends InsertController{


        function __construct(){
		parent::__construct();

	}	
	public function checkTicket(){

    		$tickets = $this->Ticket->find()
    			->where(['status' => 'open'])
			->order(['last_update' => 'DESC'])
			->limit(5);
		
		return $tickets->count();
		
	}
	



}

