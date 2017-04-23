<?php
namespace App\Test\TestCase\Controller;

use App\Controller\GetCommitController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\GetCommitController Test Case
 */
class GetCommitControllerTest extends IntegrationTestCase
{

    /**
     * Test getCommit method
     *
     * @return void
     */
    public function testGetCommit()
    {
    	$test = new GetCommitController();
	$this->assertCount(3, $test->getCommit(1 , 3));
        $this->assertArrayHasKey(0, $test->getCommit(1 , 3));
        $this->assertArrayHasKey(1, $test->getCommit(1 , 3));
        $this->assertArrayHasKey(2, $test->getCommit(1 , 3));
    }

    /**
     * Test getCommitNumber method
     *
     * @return void
     */
    
    public function testGetCommitNumber()
    {
    	$test = new GetCommitController();
	$this->assertInternalType("int", $test->getCommitNumber());
    }
}
