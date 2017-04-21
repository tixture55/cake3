<?php

//CakePHP3のPostsController.php
namespace App\Controller;
use Cake\ORM\TableRegistry;
use Cake\Routing\Router;
use Cake\Routing\Route\DashedRoute;

class TicketsController extends AppController {
 

  public $helpers = [
        'Paginator' => ['templates' => 'paginator-templates']
    ];
 

  public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Paginator');
        $this->loadComponent('Flash');
        //$this->loadComponent('Security');
        //$this->Security->requireSecure();
    }
  public function detail() {
 
    //詳細を知りたい案件のtaskIdの取得 
    //echo Router::reverse($this->request);   
            //$this->Security->requireSecure();
    
    //$user = $this->request->data('Tickets');
/*
    if ($this->Ticket->save($user) === false) {
        // 処理が失敗した時にcreateアクションを描画する
        return $this->render('detail');
    }
*/

    $id = new GetIdFromUrlController;
    $ticket_id = $id->getTicketId(Router::reverse($this->request));    
 
    $this->Post = TableRegistry::get('Posts');
    $this->Ticket = TableRegistry::get('Tickets');
    $this->Ticket_replies = TableRegistry::get('Ticket_replies');
    $this->Commit = TableRegistry::get('Commits');
    $this->Task_detail = TableRegistry::get('Task_details');
   

    $tickets = $this->Ticket->find()
	//->select(['id','posts_id', 'status', 'details', 'target_name','last_update'])
	->where(['Tickets.id' => $ticket_id])->contain(['Posts']);

    
if($tickets){
	foreach ($tickets as $this->value) {
            $posts_id = $this->value['posts_id'];
            $ticket_id = $this->value['id'];
        }
}

$ticket_replies = $this->Ticket_replies->find()->where(['Ticket_replies.posts_id' => $ticket_id]);
   
    $commits = $this->Commit->find()->where(['Commits.posts_id' => $posts_id])->contain(['Posts']);
    $posts = $this->Post->find()->where(['Posts.id' => $posts_id])->contain(['Tickets']);
    

    $this->set('posts', $posts);
    $this->set('tickets', $tickets);
    $this->set('ticket_replies', $ticket_replies);
    $this->set('commits', $commits);
    
    //$output = shell_exec("git log | cut -d \" \" -f 6-8");
    //$commit_id = shell_exec("git log --oneline | cut -d ' ' -f 1 | sed -n -e 1p");
    //$commit_id = array();
    //$commit_id = shell_exec("git log --oneline | sed -n -e 1p | wc -l");
    $commit_num = shell_exec("git log --oneline | wc -l");
    //$commit_id[] = shell_exec("git log --oneline | while read line do \$line done");
    //$commit_id = shell_exec("git log --oneline | cut -d: -f1");
    $this->set('commit_num', $commit_num);

    /*$test ="Fukuda Hata Sueyasu";
    $i = shell_exec("\"Fukuda Hata Sueyasu\" | cut -d \" \" -f 6-8");
    echo $i;
*/

    $titles = $this->viewVars['titles'];
    $this->set('titles', $titles);
    
    if($this->request->data('detail')){
        $ins = new InsertController();
        $ins->postTicketReply($this->request , $ticket_id);     
    
        //requestデータをDBへ投入し、replyを画面に表示する処理
	/*$reply = $this->Ticket_replies->newEntity();
        $reply->details = $this->request->data('detail');
        if($this->request->data('status') == 0){
		$reply->status = "open";
        }else{
		$reply->status ="close";
	}
	
        $reply->target_name = $this->request->data('target_name');
        $reply->posts_id = $ticket_id;
        $reply->last_update = date('Y/m/d H:i:s');
	$this->Ticket_replies->save($reply);*/
    }
  
  }
}
