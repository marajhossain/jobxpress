<?php
namespace App\Model;

use App\Entity\JobApply;
use App\Repository\JobPostRepository;
use Doctrine\ORM\EntityManagerInterface;

class HomeManager{

    private $em;
    private $jobPostRepository;

    public function __construct
    (
        EntityManagerInterface $em, 
        JobPostRepository $jobPostRepository
    ) {
        $this->em = $em;
        $this->jobPostRepository = $jobPostRepository;

    }

    public function getJobById(int $id)
    {
        return $this->jobPostRepository->find($id);
    }

    public function jobAppliy(JobApply $jobApply)
    {
        dd($jobApply);
        $jobApply->setApplicationToken(bin2hex(random_bytes(60)));

        $jobApply->setApplyAt(new \DateTime());
        $jobApply->setIsView(1);
        $jobApply->setStatus(1);

        $this->em->persist($jobApply);
        $this->em->flush();
    }
    
}