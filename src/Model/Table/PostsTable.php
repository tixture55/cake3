<?php

//CakePHP3のPostsTable.php
namespace App\Model\Table;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;


class PostsTable extends Table {
	public function initialize(array $config)
        {
		$this->belongsTo('Tickets', [
            		'foreignKey' => 'id'
        	]);
        }

    public function postTicket($req , int $user_id){

        $this->Ticket = TableRegistry::get('Tickets');

        $ticket_post = $this->Ticket->newEntity();
        $this->reply = $ticket_post;

        $this->Developer_status = TableRegistry::get('Developer_statuses');

        $develop_status = $this->Developer_status->newEntity();
        $this->develop = $develop_status;



	    $this->reply->task_id = $req->data('works');
        $this->reply->posts_id = $req->data('works');
        $this->reply->details = $req->data('detail');

        $tickets = $this->Ticket->find()
            ->select(['details'])
            ->where(['Tickets.details' => $this->reply->details]);
        $this->reply->title  = $req->data('ticket_title');

        if($req->data('status') == 0){
            $this->reply->status = "open";
        }else{
            $this->reply->status ="close";
        }

        $this->reply->target_name = $req->data('target_name');
        $this->reply->last_update = date('Y/m/d H:i:s');
        $this->reply->deadline = date('Y/m/d H:i:s');

        if($tickets->count() > 0){

        }else{

            try {
                $connection = ConnectionManager::get('default');
                $connection->begin();

                if ($this->Ticket->save($this->reply)) {

                    $this->develop->name = 'testuser';
                    $this->develop->modified = date('Y/m/d H:i:s');
                    $this->develop->created = date('Y/m/d H:i:s');

                    $this->develop->developer_id = $user_id;

                    if ($this->Developer_status->save($this->develop)) {
                        $this->Developer_status->connection()->commit();
                    }
                }
            }catch(Exception $e){
                $this->Flash->error($e);
                $connection->rollback(); //ロールバック
            }
        }

    }
}
