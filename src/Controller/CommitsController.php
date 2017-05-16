<?php

//CakePHP3のPostsController.php
namespace App\Controller;
use Cake\Routing\Router;
use Cake\Routing\Route\DashedRoute;
use Cake\Network\Exception\NotFoundException;

class CommitsController extends AppController {
 
 
  public function initialize()
    {
        parent::initialize();
    }
  

  public function detail() {
 
    unset($this->list['check_ticket']);

    $arr = parent::mpull($this->list , 'getId' , null);    
    $c_id = parent::mpull($this->list , 'getCommitId', null );    
    $commit_num = parent::mpull($this->list,'getCommitNumber' , null);    
    $branch = parent::mpull($this->list,'getBranch' , null);    

   
    $ticket_id = $arr[0];    
    
    $tickets = $this->Ticket->find()
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
    

    if(!empty($tickets) && !empty($commits) && !empty($posts) && !empty($c_id)){
    
        $this->set(compact('posts','tickets','ticket_replies','commits','c_id'));
    }else{
        throw new NotFoundException(__('コミットID、該当の案件IDが見つかりません。'));
    }
    
    $commit_arr = $arr[1];    


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
    
    //マージコミットかどうかの判定
    if(preg_match('/Merge pull request/' , $c_id_arr[$c_id_key]) === 1){
	$merge_pull_request = true;
    }
    //配列の最後にきた場合の処理が必要


    //該当コミットIDのメッセージの抽出処理
    $commit_detail = str_replace($c_id , "" , current($c_id_arr));
    


    if(isset($commit_arr[$c_id_key + 1])){
	
	$diff_commit_arr = explode(" " , $commit_arr[$c_id_key + 1]);
        $arr_file_diff = [$c_id , $diff_commit_arr[0]];
	$commit_file_diff = parent::mpull($this->list,'getCommitFileDiff' , $arr_file_diff);
        $commit_file_diff_detail = parent::mpull($this->list,'getCommitFileDiffDetail' , $arr_file_diff);    

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
	
    }elseif($merge_pull_request){
	    
    }else{
	    throw new NotFoundException(__('git diffコマンドエラー'));

    }
         
if(isset($commit_file_diff_detail)){

	$diff_sep_arr = explode(" " , $commit_file_diff_detail);
        //swapファイルの除外
        $regex = "/sw/";
        $drop_filter_arr = array_filter($diff_sep_arr, function($value) use($regex) {
    		return preg_match($regex, $value);
	});
        $diff_filter_arr = array_diff_assoc($diff_sep_arr , $drop_filter_arr);
	$trimed_swp_diff = implode(" ", $diff_filter_arr);
	//$replace_br = preg_replace("/\+.*/", "<div style=\"background-color:#EDF7FF;\">$0</div>", $replace_br);

	$replace_br = $this->Commit->colorScheme($trimed_swp_diff);
}
    $titles = $this->viewVars['titles'];
    $this->set(compact('titles','replace_br','commit_detail'));
    
    if($this->request->data('detail')){
        $ins = new InsertPostController();
        $ins->postTicketReply($this->request , $ticket_id);     
    
    }
  
  }
}
