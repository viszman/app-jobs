<?php

namespace App\Tests;

use App\JobBoard;
use PHPUnit\Framework\TestCase;

class JobBoardTest extends TestCase
{

    public function testGetJobs()
    {
        $board = new JobBoard();
        $jobs = $board->getJobs();

        $this->assertEquals(count($jobs[0]), 2);

        $this->assertEquals($jobs[0], ['"Company A"', '"Company J"']);
    }
}
