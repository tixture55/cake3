<?php
namespace App\Controller;

class PanelEditController extends PanelController{

	protected $title;

        //画面によって、セットするタイトルを変える
	

	public function setTitle(String $view){
            
	    if(strcmp($view , "tasks" ) === 0){	
	    	$this->title = array("案件名","リポジトリ","総コミット数","クライアント名","直近のチケット","タグ");
	    }elseif(strcmp($view , "tickets") === 0){
		$this->title = array("チケット名","status","案件名","チケット内容","最終更新日時");

	    }elseif(strcmp($view , "posts") === 0){
	    	$this->title = array("担当者名","案件名","関連チケット数","最終更新日時");
	    }elseif(strcmp($view , "commits") === 0){
	    	$this->title = array("commit_id","ブランチ","案件名","変更内容","差分ファイル","コミット名","最終更新日時");
	    }else{

	    }
 		return $this->title;
	}
	
	public function addCommitHistory(){

	}

}
