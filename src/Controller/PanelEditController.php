<?php
namespace App\Controller;

final class PanelEditController extends PanelController{

	protected $title;


	public function setTitle(int $task_id){

	    if($task_id = 3){	
	    	$this->title = array("案件名","総コミット数","クライアント名","直近のチケット");
	    }else{

	    }
 		return $this->title;
	}

}
