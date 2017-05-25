<?php
namespace App\Controller;
use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager; 
use App\Collection\TraitSingleton;

final class InsertPostController extends InsertController{


    function __construct(){

        parent::__construct();

	}	

	//画面によって、セットするタイトルを変える
	public function postTicketReply($req , $ticket_id){


		$this->reply->details = $req->data('detail');

    		$ticket_replies = $this->Ticket_replies->find()
			->where(['Ticket_replies.details' => $this->reply->details]);
		
		$arr = $ticket_replies->hydrate(false)->toArray();	

	
		if($req->data('status') == 0){
			$this->reply->status = "open";
		}else{
			$this->reply->status ="close";
		}

		$this->reply->target_name = $req->data('target_name');
		$this->reply->posts_id = $ticket_id;
		$this->reply->last_update = date('Y/m/d H:i:s');
		
		if(!isset($arr[0]['details'])){
		 	if($this->Ticket_replies->save($this->reply)){
	
				$connection = ConnectionManager::get('default');
				$connection->begin();

				try{
					if($this->reply->status ==='close'){
						$this->Ticket = TableRegistry::get('Tickets');
						$query = $this->Ticket->query();
						$query->update()
							->set(['status' => 'close'])
							->where(['id' => $ticket_id])
							->execute();

						$this->Ticket->connection()->commit();

					}

				} catch(Exception $e){

					$this->Flash->error($e);
					$connection->rollback(); //ロールバック
				}
			}
		}
	}
	




}

