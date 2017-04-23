<?php
namespace App\Test\TestCase\Controller;

use App\Controller\PanelEditController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\PanelEditController Test Case
 */
class PanelEditControllerTest extends IntegrationTestCase
{

    /**
     * Test setTitle method
     *
     * @return void
     */
    public function testSetTitle()
    {
    	$test = new PanelEditController();
	
	$arr = array();
	/*array_push($arr , "tasks");
	array_push($arr , "tickets");
	array_push($arr , "posts");
	array_push($arr , "commits");
	*/
	$tasks = ['案件名', '総コミット数', 'クライアント名', '直近のチケット','タグ'];	
	$tickets = ['チケット名', 'status', '案件名', 'チケット内容','最終更新日時'];	

	$arr = ['tasks' => $tasks , 'tickets' => $tickets];

	$key = array();
	array_push($key , "案件名");	
	
	foreach($arr as $key => $arr_num){
	        if($key === "tickets"){
			$this->assertContains('チケット名' , $test->setTitle($key));
			$this->assertContains('status' , $test->setTitle($key));
			$this->assertContains('案件名' , $test->setTitle($key));
			$this->assertContains('チケット内容' , $test->setTitle($key));
			$this->assertContains('最終更新日時' , $test->setTitle($key));
		}elseif($key === "tasks"){
			$this->assertContains('案件名' , $test->setTitle($key));
			$this->assertContains('総コミット数' , $test->setTitle($key));
			$this->assertContains('クライアント名' , $test->setTitle($key));
			$this->assertContains('直近のチケット' , $test->setTitle($key));
			$this->assertContains('タグ' , $test->setTitle($key));

		}
	}
    }
    /**
     * Test addCommitHistory method
     *
     * @return void
     */
    /*public function testAddCommitHistory()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }*/
}
