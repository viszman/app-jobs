<?php

namespace App\Module;


class JobOffer implements Offer
{
    /**
     * @var string
     */
    private $jobString;

    /**
     * @var array
     */
    private $jobInfo;

    /**
     * @var array
     */
    private $companyInfo;

    public function __construct(string $jobString)
    {
        $this->jobString = $jobString;
        $this->convertToArray();
    }

    protected function convertToArray(): void
    {
        $exploded = explode(' ', $this->jobString);
        $companyInfo = implode(' ', array_slice($exploded, 0, 2));
        unset($exploded[0], $exploded[1]);
        $this->companyInfo = $companyInfo;
        $this->jobInfo = $exploded;
    }

    public function getJobInfo()
    {
        return $this->jobInfo;
    }

    public function getCompanyInfo()
    {
        return $this->companyInfo;
    }
}
