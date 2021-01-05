<?php

namespace App\Model;

use App\Entity\JobPost;
use App\Repository\JobPostRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;

class JobPostManager
{
    const PAGE_SIZE = 2;

    private $jobPostRepository;
    private $paginatorInterface;
    private $em;

    public function __construct(
        JobPostRepository $jobPostRepository,
        PaginatorInterface $paginatorInterface,
        EntityManagerInterface $em
    ) {
        $this->jobPostRepository = $jobPostRepository;
        $this->paginatorInterface = $paginatorInterface;
        $this->em = $em;
    }

    public function getAllJobs()
    {
        return $this->jobPostRepository->findAll();
    }

    public function getAllPaginatedJobs($page = 1)
    {
        return $this->paginatorInterface->paginate(
            $this->getAllJobs(),
            $page,
            self::PAGE_SIZE
        );
    }

    public function create(JobPost $jobPost)
    {
        $jobPost->setPosterEmail('abc@email.com');
        $jobPost->setToken(bin2hex(random_bytes(60)));
        $jobPost->setJobPostingTime(time());

        $this->em->persist($jobPost);
        $this->em->flush();
    }
}