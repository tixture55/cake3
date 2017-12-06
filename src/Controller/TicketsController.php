<?php

//CakePHP3のPostsController.php
namespace App\Controller;
use Cake\Network\Exception\NotFoundException;
use Cake\Event\Event;

class TicketsController extends AppController {
 

  public function initialize()
    {
        parent::initialize();
    	
    }
  
  public function detail() {

      $year = date("Y");
      $month = date("n");

      $last_day = date('j',mktime(0,0,0,$month + 1,0,$year));

      $calendar = array();
      $j = 0;

      for($i = 1; $i < $last_day + 1; $i++){


          // 曜日を取得
          $week = date('w', mktime(0, 0, 0, $month, $i, $year));

          // 1日の場合
          if ($i == 1) {

              // 1日目の曜日までをループ
              for ($s = 1; $s <= $week; $s++) {

                  // 前半に空文字をセット
                  $calendar[$j]['day'] = '';
                  $j++;

              }

          }


          $calendar[$j]['day'] = $i;
          $j++;
          if ($i == $last_day) {

              // 月末日から残りをループ
              for ($e = 1; $e <= 6 - $week; $e++) {

                  // 後半に空文字をセット
                  $calendar[$j]['day'] = '';
                  $j++;

              }

          }
      }


      $this->set(compact("calendar","year" ,"month"));

      unset($this->list['check_ticket']);
      //$this->Ticket->checkDuplicates();
      $arr = parent::mpull($this->list , 'getId' , null);
      $commit_num = parent::mpull($this->list,'getCommitNumber' , null);

      $tickets = $this->Ticket->find()
	->where(['Tickets.id' => $arr[0]])->contain(['Posts']);
    
    if($tickets){
	foreach ($tickets as $this->value) {
            $posts_id = $this->value['posts_id'];
	    $ticket_id = $this->value['id'];
        }
    }elseif(empty($tickets)){
        throw new NotFoundException(__('チケットが見つかりません。'));
    }
    
    $ticket_read_histories = $this->Ticket_read_histories->find()
	->select(['posts_id'])
	->where(['Ticket_read_histories.posts_id' => $ticket_id]);
   
    $ticket_read_histories->hydrate(false);
    $ticket_read_result = $ticket_read_histories->toList();

    if(array_key_exists('posts_id' , $ticket_read_result)){
    	    
	    $this->set('isReadTicket', true);
	    
    }


$ticket_replies = $this->Ticket_replies->find()->where(['Ticket_replies.posts_id' => $ticket_id]);
   
    $commits = $this->Commit->find()->where(['Commits.posts_id' => $posts_id])->contain(['Posts']);
    
    $posts = $this->Post->find()->where(['Posts.id' => $posts_id])->contain(['Tickets']);

    $commit_arr = $arr[1];
    

    $titles = $this->viewVars['titles'];
    $this->set(compact('posts','tickets','ticket_replies','commits','commit_num',"commit_arr","titles"));
    
    if($this->request->data){
	    
        $path = '/var/www/html/cake3/webroot/img';
        
        move_uploaded_file( $path . DS . $this->request->data['img']);
        

        $reply_data = $this->Ticket->newEntity($this->request->getData());

        $this->set(compact(["reply_data"]));

        $ins = new InsertPostController();
        $ins->postTicketReply($this->request , $ticket_id);     
    
    }
  
  }
  public function modify() {
	  
	if($this->request->isAjax()){
		
		$ins = new InsertHistoryController();
        	$ins->insertReadHistory($this->request->params['?']['name']);     
  	}else{ 
		$this->log("Illegal Request was sent not in the ajax one.".__METHOD__."()  line:87",'critical');	  
	}
  }
}
