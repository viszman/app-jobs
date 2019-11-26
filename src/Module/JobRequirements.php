<?php


namespace App\Module;


class JobRequirements implements Requirement
{
    /**
     * @var \App\Module\JobOffer
     */
    private $jobOffer;

    /**
     * @var int
     */
    private $reqCount;

    /**
     * @var array like
     * [
     *  [
     *      'and' => [],
     *      'or => []
     * ]
     * ]
     */
    private $req;

    public function __construct(JobOffer $jobOffer)
    {
        $this->jobOffer = $jobOffer;
        $this->getRequirementsCount();
        $this->getRequirementsGroups();
    }

    /**
     * @return int
     */
    protected function getRequirementsCount(): int
    {
        $counter = 1;
        $lastGlue = '';
        foreach ($this->jobOffer->getJobInfo() as $info) {
            if ($lastGlue === 'and' && mb_strtolower($info) === 'or') {
                $counter++;
                $lastGlue = 'or';
                continue;
            }

            if ('and' === mb_strtolower($info)) {
                $counter++;
                $lastGlue = 'and';
            }
        }
        $this->reqCount = $counter;

        return $counter;
    }

    protected function getRequirementsGroups(): array
    {
        $group = [];
        $infos = $this->jobOffer->getJobInfo();
        $glued = implode(' ', $infos);
        $andGroup = explode('and', $glued);
        foreach ($andGroup as $key => $item) {
            $thisOr = explode('or', $item);
            $group[$key]['and'] = $item;
            $group[$key]['or'] = $thisOr;
        }
        $this->req = $group;

        return $group;
    }

    public function getRequirements(): array
    {
        return $this->req;
    }

    public function getCount(): int
    {
        return $this->reqCount;
    }
}
