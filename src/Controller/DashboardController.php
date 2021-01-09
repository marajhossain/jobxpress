<?php

namespace App\Controller;

use App\Repository\JobPostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\DependencyInjection\SystemConfigHelper;
use App\Model\DashboardManager;

class DashboardController extends AbstractController
{
    private $system_config;
    private $dashboardManager;

    public function __construct(DashboardManager $dashboardManager) {
        $this->system_config = new SystemConfigHelper;
        $this->dashboardManager = $dashboardManager;
    }

    /**
     * @Route("/dashboard", name="dashboard")
     */
    public function index(JobPostRepository $jobPostRepository): Response
    {
        

        return $this->render('dashboard/index.html.twig', [
            'job_posts' => $jobPostRepository->findAll(),
            'job' => $this->dashboardManager->getJobStatistic(),
            'topCategory' => $this->dashboardManager->getTopCategoryJobStatistic(),
            'getStatus' => $this->system_config->getStatus(),
            'getJobType' => $this->system_config->getJobType(),
        ]);
    }
    
    /**
     * @Route("/deshboard-chart-job-post-trend", name="chart_job_post_trend", methods={"GET"})
     */
    public function chartJobPostTrend(): Response
    {
     
        // $json = [
        //     [ "label" => "maraj", "y" => 36 ],
        //     [ "label" => "Email Marketing", "y" => 31 ],
        //     [ "label" => "Referrals", "y" => 7 ],
        //     [ "label" => "Twitter", "y" => 7 ],
        //     [ "label" => "Facebook", "y" => 6 ],
        //     [ "label" => "Google", "y" => 10 ],
        //     [ "label" => "Others", "y" => 3 ]
        // ];
        
        $json = $this->dashboardManager->getTopCategoryJobStatistic();
        return $this->json(['data'=> $json]);
    }
}
