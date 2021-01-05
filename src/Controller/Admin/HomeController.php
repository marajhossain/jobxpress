<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

// /**
//  * @Route("/admin")
//  */
class HomeController extends AbstractController
{
    /**
     * @Route("/", methods="GET", name="home_index")
     */
    public function index(): Response
    {
        return $this->render('front/home/index.html.twig');
    }

    /**
     * @Route("/job-list/category/{id}", methods="GET", name="job_list_by_category")
     */
    public function jobListByCategory(): Response
    {
        return $this->render('front/job/index.html.twig');
    }

    /**
     * @Route("/job-details/{id}", methods="GET", name="job_details")
     */
    public function getJobDetails(): Response
    {
        return $this->render('front/job/details.html.twig');
    }

    /**
     * @Route("/post-job", methods="GET", name="post_job")
     */
    public function postJob(): Response
    {
        return $this->render('front/job/create.html.twig');
    }
}