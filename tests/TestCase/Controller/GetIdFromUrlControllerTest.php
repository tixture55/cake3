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
    public function testGetTicketId()
    {
    	$test = new GetIdFromUrlController();
	$return_id = $test->getTicketId("/cake3/tickets/detail?ticket_id=6");
        $this->assertSame(6 , intval($return_id));	
    }
}
