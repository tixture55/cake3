<?php
namespace App\Controller;

final class PanelEditController extends PanelController{

	protected $title;


	public function setTitle(int $task_id){

	    if($task_id = 3){	
	    	$this->title = array("総コミット数","クライアント名","重要度");
	    }else{

	    }
 		return $this->title;
	}

}
