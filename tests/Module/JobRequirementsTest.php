<?php

namespace App\Tests\Module;

use App\Module\JobOffer;
use App\Module\JobRequirements;
use PHPUnit\Framework\TestCase;

class JobRequirementsTest extends TestCase
{

    public function testGetRequirements()
    {
        $jobInfo = new JobOffer('"Company B" requires 5 door car or 4 door car, and a driver\'s license and car insurance.');
        $jobRequirements = new JobRequirements($jobInfo);

        $expected = [
            [
                'and' => 'requires 5 door car or 4 door car, ',
                'or' => [
                    'requires 5 do',
                    ' car ',
                    ' 4 do',
                    ' car, ',
                ],
            ],
            [
                'and' => ' a driver\'s license ',
                'or' => [' a driver\'s license '],
            ],
            [
                'and' => ' car insurance.',
                'or' => [' car insurance.'],
            ],
        ];

        $this->assertEquals($jobRequirements->getRequirements(), $expected);
    }

    public function testGetCount()
    {
        $jobInfo = new JobOffer('"Company B" requires 5 door car or 4 door car, and a driver\'s license and car insurance.');
        $jobRequirements = new JobRequirements($jobInfo);

        $count = $jobRequirements->getCount();

        $this->assertEquals(3, $count);
    }
}
