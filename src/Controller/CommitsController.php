<?php

//CakePHP3のPostsController.php
namespace App\Controller;
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
    }
  

  public function detail() {
 

    $id = new GetIdFromUrlController;
    $ticket_id = $id->getTicketId(Router::reverse($this->request));    
    $c_id = $id->getCommitId(Router::reverse($this->request));    
    

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
    

    if(isset($tickets) && isset($commits) && isset($posts) && isset($ticket_replies) && isset($c_id)){
    
        $this->set(compact('posts','tickets','ticket_replies','commits','c_id'));
    }else{
        throw new NotFoundException(__('チケットへの返信、もしくはコミットID、該当の案件IDが見つかりません。'));
    }
    
    $commit = new GetCommitController();
    $commit_arr = $commit->getCommit(1,23);    
    $commit_num = $commit->getCommitNumber();

    $branch = $commit->getBranch();


    if(isset($commit_arr) || isset($commit_num) || isset($branch)){
        $this->set(compact('commit_arr','commit_num','branch'));
    
    }else{
        throw new NotFoundException(__('コミットもしくはブランチが見つかりません。'));
    }

    $regex = "/".$c_id."/";
    $c_id_arr = array_filter($commit_arr, function($value) use($regex) {
    		return preg_match($regex, $value);
	});
    $c_id_key = key($c_id_arr);
    //配列の最後にきた場合の処理が必要


    //該当コミットIDのメッセージの抽出処理
    $commit_detail = str_replace($c_id , "" , current($c_id_arr));
    
    $this->set('commit_detail', $commit_detail);


    if(isset($commit_arr[$c_id_key + 1])){
	 
	$diff_commit_arr = explode(" " , $commit_arr[$c_id_key + 1]);
    	$commit_file_diff = $commit->getCommitFileDiff($c_id , $diff_commit_arr[0]);   
    	
	$commit_file_diff_detail = $commit->getCommitFileDiffDetail($c_id , $diff_commit_arr[0]);   
    
    }else{
	$commit_file_diff = "target commit is nothing";	
    }

if(isset($commit_file_diff)){
	
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
    
        $this->set('diff_files', $diff_filter_arr);

}else{
        throw new NotFoundException(__('git diffコマンドエラー'));
	
}
         
if(isset($commit_file_diff_detail)){
	//echo $commit_file_diff_detail;

	$diff_sep_arr = explode(" " , $commit_file_diff_detail);
        //swapファイルの除外
        $regex = "/sw/";
        $drop_filter_arr = array_filter($diff_sep_arr, function($value) use($regex) {
    		return preg_match($regex, $value);
	});
        $diff_filter_arr = array_diff_assoc($diff_sep_arr , $drop_filter_arr);
	//print_r($diff_filter_arr);
	$trimed_swp_diff = implode(" ", $diff_filter_arr);
	//echo $trimed_swp_diff;
	$replace_br = str_replace("@@", "<br><br>", $trimed_swp_diff);
	$replace_br = str_replace("+", "<br><div class=\"plus\">+", $replace_br);
	//$replace_br = str_replace("-", "<br><div class=\"minus\">-", $replace_br);
	//$minus_location = strpos($replace_br , 0 , "-");
	//$br_location = strpos($replace_br , $minus_location , "<br>");
/*
	$pattern = '/[0-9]/';
	if(preg_match($pattern , substr($replace_br , $minus_location , $br_location)) === 0){
		
	}*/	
	//$pattern = '/-.*/;';
	/*$replacement ='<br><div class=\"minus\">-';
	preg_replace($pattern, $replacement, $replace_br);
	*/
	$replace_br = str_replace(");", ");</div><br>", $replace_br);
	$replace_br = preg_replace("/class[^=]/", "<font color=\"green\">class </font>", $replace_br);
	$replace_br = preg_replace("/abstract|protected|public|return|extends|final|new/", "<font color=\"green\">$0 </font>", $replace_br);
	$replace_br = preg_replace("/\&|\-/", "<font color=\"red\">$0</font>", $replace_br);
	$replace_br = preg_replace("/true|DESC/", "<font color=\"red\">$0</font>", $replace_br);
	$replace_br = preg_replace("/this/", "<font color=\"blue\">$0</font>", $replace_br);
	$replace_br = preg_replace("/\+/", "<font color=\"blue\">$0</font>", $replace_br);
	$replace_br = preg_replace("/\/\/.*/", "<font color=\"blue\">$0</font>", $replace_br);
	$replace_br = preg_replace("/\+.*/", "<div style=\"background-color:#EDF7FF;\">$0</div>", $replace_br);
	//$replace_br = preg_replace("/\-.*/", "<div style=\"background-color:#FFFF99;\">$0</div>", $replace_br);
	

	//$replace_br = preg_replace("/\-.*(?!color)/", "<div style=\"background-color:#FFFF99;\">$0</div>", $replace_br);
	//$replace_br = preg_replace("/[[0-9]|\(|\)|\[|\]]/", "<font color=\"red\">$0</font>", $replace_br);
	//echo $replace_br;
}
    $titles = $this->viewVars['titles'];
    $this->set(compact('titles','replace_br'));
    
    if($this->request->data('detail')){
        $ins = new InsertController();
        $ins->postTicketReply($this->request , $ticket_id);     
    
    }
  
  }
}
