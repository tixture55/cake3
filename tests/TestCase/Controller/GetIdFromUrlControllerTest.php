<?php
namespace App\Test\TestCase\Controller;

use App\Controller\GetIdFromUrlController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\GetIdFromUrlController Test Case
 */
class GetIdFromUrlControllerTest extends IntegrationTestCase
{

    /**
     * Test getTicketId method
     *
     * @return void
     */
    /**
 * @dataProvider provideAdditionTestParams
 */
    public function testGetTicketId($url , $id)
    {
    	$test = new GetIdFromUrlController();
	$return_id = $test->getTicketId($url);
	$this->assertSame($id, intval($return_id));	
    }

    public function provideAdditionTestParams()
    {
    	$patterns = array();
	return [
        	["/cake3/tickets/detail?ticket_id=5", 5],
        	["/cake3/tickets/detail?ticket_id=15", 15],
        	["/cake3/tickets/detail?ticket_id=155", 155],
        	["/cake3/tickets/detail?ticket_id=1555", 1555],
    	];
    }
}
