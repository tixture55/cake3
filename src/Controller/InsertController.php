<?php
namespace App\Controller;
use Cake\ORM\TableRegistry;

abstract class InsertController {

	protected $reply;

	function __construct(){


		$this->Ticket = TableRegistry::get('Tickets');
		$this->Ticket_replies = TableRegistry::get('Ticket_replies');
		$this->Ticket_read_histories = TableRegistry::get('Ticket_read_histories');

		$reply = $this->Ticket_replies->newEntity();
		$this->reply = $reply;

	}

	


}

