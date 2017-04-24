<?php

//CakePHP3のPostsController.php
namespace App\Controller;
use Cake\ORM\TableRegistry;
use Cake\Routing\Router;
use Cake\Routing\Route\DashedRoute;
use Cake\Network\Exception\NotFoundException;

class CommitsController extends AppController {
 
  public $helpers = [
        'Paginator' => ['templates' => 'paginator-templates']
    ];
 
  public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Paginator');
        $this->loadComponent('Flash');
    }
  

  public function detail() {
 

    $id = new GetIdFromUrlController;
    $ticket_id = $id->getTicketId(Router::reverse($this->request));    
    $c_id = $id->getCommitId(Router::reverse($this->request));    
    

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
    }elseif(empty($tickets)){
        throw new NotFoundException(__('チケットが見つかりません。'));
    }

$ticket_replies = $this->Ticket_replies->find()->where(['Ticket_replies.posts_id' => $ticket_id]);
   
    $commits = $this->Commit->find()->where(['Commits.posts_id' => $posts_id])->contain(['Posts']);
    $posts = $this->Post->find()->where(['Posts.id' => $posts_id])->contain(['Tickets']);
    

    $this->set('posts', $posts);
    $this->set('tickets', $tickets);
    $this->set('ticket_replies', $ticket_replies);
    $this->set('commits', $commits);
    $this->set('c_id', $c_id);
    

    $commit = new GetCommitController();
    $commit_arr = $commit->getCommit(1,23);    
    $commit_num = $commit->getCommitNumber();

    $branch = $commit->getBranch();

$commit_id_arr = array();
$commit_detail_arr = array();
   

if($commit_arr){
          foreach ($commit_arr as $this->value) {
               $pieces = explode(" ", $this->value);
	       $commit_detail = str_replace($pieces[0] , "" , $this->value);
	       array_push($commit_id_arr , $pieces[0]);
	       array_push($commit_detail_arr , $commit_detail);
          }
 }
    $regex = "/".$c_id."/";
    $c_id_arr = array_filter($commit_arr, function($value) use($regex) {
    		return preg_match($regex, $value);
	});
    $c_id_key = key($c_id_arr);
    $diff_commit_arr = explode(" " , $commit_arr[$c_id_key + 1]);
    $commit_file_diff = $commit->getCommitFileDiff($c_id , $diff_commit_arr[0]);   

if($commit_file_diff){
	
	$regex = "/\//";
	$diff_filter_arr = array();
	$diff_sep_arr = explode(" " , $commit_file_diff);
	$diff_filter_arr = array_filter($diff_sep_arr, function($value) use($regex) {
    		return preg_match($regex, $value);
	});
	
        //swapファイルの除外
        $regex = "/sw/";
        $drop_filter_arr = array_filter($diff_filter_arr, function($value) use($regex) {
    		return preg_match($regex, $value);
	});
        $diff_filter_arr = array_diff_assoc($diff_filter_arr , $drop_filter_arr);
}
         
   
    $this->set('branch', $branch);
    $this->set('diff_files', $diff_filter_arr);
    $this->set('commit_num', $commit_num);

    $titles = $this->viewVars['titles'];
    $this->set('titles', $titles);
    $this->set('commit_arr', $commit_arr);
    
    if($this->request->data('detail')){
        $ins = new InsertController();
        $ins->postTicketReply($this->request , $ticket_id);     
    
    }
  
  }
}
