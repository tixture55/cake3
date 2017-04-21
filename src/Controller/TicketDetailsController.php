<?php

//CakePHP3のPostsController.php
namespace App\Controller;
use Cake\ORM\TableRegistry;
use Cake\Routing\Router;
use Cake\Routing\Route\DashedRoute;

class TicketDetailsController extends AppController {
 

  public $helpers = [
        'Paginator' => ['templates' => 'paginator-templates']
    ];
 

  public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Paginator');
    }
  
  
  public function detail() {
 
    //詳細を知りたい案件のtaskIdの取得 
    //echo Router::reverse($this->request);   
    
    $ticket_id = strstr(Router::reverse($this->request) , "ticket_id=");    
    $ticket_id = str_replace("ticket_id=" , "" , $ticket_id);

    $list = new PanelEditController();
    $titles = $list->setTitle($ticket_id); 
    
    $this->Ticket= TableRegistry::get('Tickets');
    $this->Task_detail = TableRegistry::get('Task_details');
    
    $tickets = $this->Ticket->find()->where(['Tickets.id' => $ticket_id]);
    //$task_details = $this->Ticket_detail->find()->where(['Ticket_details.ticket_id' => $ticket_id]);
    
    var_dump($tickets);
    $this->set('tickets', $tickets);
    //$this->set('task_details', $task_details);
    $this->set('titles', $titles);
  
  }
}
