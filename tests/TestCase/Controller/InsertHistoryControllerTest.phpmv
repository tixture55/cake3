<?php
namespace App\Test\TestCase\Controller;

use App\Controller\InsertHistoryController;
use Cake\TestSuite\IntegrationTestCase;
use Cake\ORM\TableRegistry;

/**
 * App\Controller\InsertHistoryController Test Case
 */
class InsertHistoryControllerTest extends IntegrationTestCase
{

    /**
     * Test __construct method
     *
     * @return void
     */
    public function testConstruct()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test insertReadHistory method
     *
     * @return void
     */
    public function testInsertReadHistory()
    {

	$test = new InsertHistoryController();
        $arr = $test->selectTicketsForTest();
	/*$this->assertTrue($test->insertReadHistory(90));
        $this->Ticket = TableRegistry::get('Tickets');
        $this->Ticket->hydrate(false);
	$arr = $this->Ticket->find()
			->select(['id'])
			->toList();*/
	for($i = 0; $i < count($arr); $i++){
        	$this->assertTrue($test->insertReadHistory($arr[$i]));
		
	}
    }
}
