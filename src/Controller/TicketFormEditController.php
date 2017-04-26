<?php
namespace App\Controller;

final class TicketFormEditController extends PanelEditController{

	protected $task_flg;

        //画面によって、セットするタイトルを変える
	

	public function setTicketForm(String $view){
            
	    if(strcmp($view , "tasks" ) === 0){	

		$this->task_flg = false;
	
	    }elseif(strcmp($view , "tickets") === 0){

		$this->task_flg = false;
	    }elseif(strcmp($view , "posts") === 0){

		$this->task_flg = true;
	    
	    }elseif(strcmp($view , "commits") === 0){
	
   		$this->task_flg = false;
	    
	    }else{

	    }
 		return $this->task_flg;
	}
	

}
