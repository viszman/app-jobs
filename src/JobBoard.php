<?php

namespace App;

use App\Module\JobOffer;
use App\Module\JobRequirements;

require __DIR__.'/../vendor/autoload.php';

class JobBoard
{
    private $board = [
        '"Company A" requires an apartment or house, and property insurance.',
        '"Company B" requires 5 door car or 4 door car, and a driver\'s license and car insurance.',
        '"Company C" requires a social security number and a work permit. ',
        '"Company D" requires an apartment or a flat or a house.',
        '"Company E" requires a driver\'s license and a 2 door car or a 3 door car or a 4 door car or a 5 door car.',
        '"Company F" requires a scooter or a bike, or a motorcycle and a driver\'s license and motorcycle insurance.',
        '"Company G" requires a massage qualification certificate and a liability insurance.',
        '"Company H" requires a storage place or a garage.',
        '"Company J" doesn\'t require anything, you can come and start working immediately.',
        '"Company K" requires a PayPal account.',
    ];

    public function getJobs(array $search = ['property insurance', 'house']): array
    {
        $canWork = [];
        $cannotWork = [];
        $workerItems = count($search);

        foreach ($this->board as $job) {
            $jobOffer = new JobOffer($job);
            $jobRequirements = new JobRequirements($jobOffer);
            if (strpos($job, 'doesn\'t require anything') !== false) {
                $canWork[] = $jobOffer->getCompanyInfo();
            }
            if ($workerItems < $jobRequirements->getCount()) {
                $cannotWork[] = $jobOffer->getCompanyInfo();
                continue;
            }
            $passed = 0;
            foreach ($search as $have) {
                foreach ($jobRequirements->getRequirements() as $requirement) {
                    if (strpos($requirement['and'], $have) !== false) {
                        $passed++;
                        break;
                    }
                }
            }

            if ($passed === $workerItems) {
                $canWork[] = $jobOffer->getCompanyInfo();
            } else {
                $cannotWork[] = $jobOffer->getCompanyInfo();
            }
        }

        return [$canWork, $cannotWork];
    }
}

$board = new JobBoard();
var_dump($board->getJobs());
