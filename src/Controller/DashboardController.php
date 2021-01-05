<?php

namespace App\Controller;

use App\Repository\JobPostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\DependencyInjection\SystemConfigHelper;

class DashboardController extends AbstractController
{
    private $system_config;

    public function __construct() {
        $this->system_config = new SystemConfigHelper;
    }

    /**
     * @Route("/dashboard", name="dashboard")
     */
    public function index(JobPostRepository $jobPostRepository): Response
    {
        $em = $this->getDoctrine()->getManager();

        $jobPost = $em->createQuery("Select COUNT(job.id) AS total_job, 
        SUM(job.total_view) AS total_view,
        SUM(job.total_applied) AS total_apply FROM App\Entity\JobPost AS job WHERE job.status='1' ORDER BY job.id DESC");

        return $this->render('dashboard/index.html.twig', [
            'job_posts' => $jobPostRepository->findAll(),
            'job' => $jobPost->getOneOrNullResult(),
            'getStatus' => $this->system_config->getStatus(),
            'getJobType' => $this->system_config->getJobType(),
        ]);
    }
    
    /**
     * @Route("/deshboard-chart-job-post-trend", name="chart_job_post_trend", methods={"GET"})
     */
    public function chartJobPostTrend(): Response
    {
     
        $json = [
            [ "label" => "maraj", "y" => 36 ],
            [ "label" => "Email Marketing", "y" => 31 ],
            [ "label" => "Referrals", "y" => 7 ],
            [ "label" => "Twitter", "y" => 7 ],
            [ "label" => "Facebook", "y" => 6 ],
            [ "label" => "Google", "y" => 10 ],
            [ "label" => "Others", "y" => 3 ]
        ];

        return $this->json(['data'=> $json]);
    }
}
