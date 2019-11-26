<?php

namespace App\Tests\Module;

use App\Module\JobOffer;
use PHPUnit\Framework\TestCase;

class JobOfferTest extends TestCase
{

    public function testGetJobInfo()
    {
        $jobInfo = new JobOffer('"Company B" requires 5 door car or 4 door car, and a driver\'s license and car insurance.');
        $info = $jobInfo->getJobInfo();
        $expected = [
            2 => 'requires',
            3 => '5',
            4 => 'door',
            5 => 'car',
            6 => 'or',
            7 => '4',
            8 => 'door',
            9 => 'car,',
            10 => 'and',
            11 => 'a',
            12 => 'driver\'s',
            13 => 'license',
            14 => 'and',
            15 => 'car',
            16 => 'insurance.',
        ];
        $this->assertEquals($info, $expected);
    }

    public function testGetCompanyInfo()
    {
        $jobInfo = new JobOffer('"Company B" requires 5 door car or 4 door car, and a driver\'s license and car insurance.');
        $info = $jobInfo->getCompanyInfo();
        $this->assertEquals($info, '"Company B"');
    }
}
