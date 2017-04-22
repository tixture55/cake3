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
	array_push($arr , "tasks");
	array_push($arr , "tickets");
	array_push($arr , "posts");
	
	$key = array();	
	array_push($key , "案件名");
	//$key = "案件名";	
	foreach($key as $key_val){

		foreach($arr as $val){
			$this->assertContains($key_val , $test->setTitle($val));
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
