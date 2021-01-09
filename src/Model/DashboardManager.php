<?php
namespace App\Model;

use App\Entity\JobPost;
use Doctrine\ORM\EntityManagerInterface;

class DashboardManager {

    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function getJobStatistic() {

        return $this->em->createQuery("Select COUNT(job.id) AS total_job, 
        SUM(job.total_view) AS total_view,
        SUM(job.total_applied) AS total_apply FROM App\Entity\JobPost AS job WHERE job.status='1' ORDER BY job.id DESC")->getOneOrNullResult();

    }
    
    public function getTopCategoryJobStatistic() {

        return $this->em->createQuery("SELECT 
        COUNT(jp.id) as y, 
        c.name as label
        FROM App\Entity\JobPost as jp
        INNER JOIN jp.category c
        GROUP BY c.id")->getResult();

    }
}