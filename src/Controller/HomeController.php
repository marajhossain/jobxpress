<?php

namespace App\Controller;

use App\Entity\Category;
use App\Repository\CategoryRepository;
use App\Entity\JobPost;
use App\Repository\JobPostRepository;
use App\Form\JobPostType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
// use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Cookie;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home_index")
     */
    public function index(CategoryRepository $categoryRepository, Request $request): Response
    {

        // $em = $this->getDoctrine()->getManager();

        // $jobPost = $em->createQuery("Select a FROM App\Entity\JobPost a WHERE a.status='Active' ".$waarde." ORDER BY a.id DESC");

        return $this->render('home/index.html.twig', [
            'categories' => $categoryRepository->findAll(),
        ]);
        // $voorraad = $em->createQuery('Select a FROM AppBundle:Voorraadlijst a ORDER BY a.omschrijving ASC');
    }

    /**
     * @Route("/job-search", name="job_search", methods={"POST"})
     */
    public function jobSearch(Request $request)
    {
        $jobs = [];

        if ($request->isMethod('POST') && $request->get('search_keyword')) {
            $search_keyword = $request->get('search_keyword');
            $jobs[] = $search_keyword;
            $search = explode(" ", $search_keyword);
            $waarde = '';

            foreach ($search as $key=>$value) {
                if($key==0){
                    $waarde .= "AND ";
                } else {
                    $waarde .= "OR ";
                }

                $waarde .= "a.position LIKE '%".$value."%'";
            }
            
            $em = $this->getDoctrine()->getManager();

            $jobPost = $em->createQuery("Select a FROM App\Entity\JobPost a WHERE a.status='Active' ".$waarde." ORDER BY a.id DESC");
            
            return $this->render('home/job_search.html.twig', [
                'jobs' => $jobPost->getResult(),
                'search_keyword' => $search_keyword
            ]);
        } 

        return $this->render('home/job_search.html.twig', [
            'jobs' => $jobs,
        ]);
    }
    
    /**
     * @Route("/jobs/{id}", name="jobs", methods={"GET","POST"})
     */
    public function jobs(PaginatorInterface $paginatorInterface, Request $request)
    {
        $query = $this->getDoctrine()->getManager()->getRepository(JobPost::class)->findBy(['category'=>$request->get('id')]);
        
        $paginator = $paginatorInterface->paginate(
            $query,
            $request->query->getInt('page', 1),
            2
        );

        return $this->render('home/jobs.html.twig', [
            'categories' => $paginator
        ]);
    }
    
    /**
     * @Route("/job-details/{id}", name="job_details", methods={"GET", "POST"})
     */
    public function jobDetails(JobPostRepository $jobPostRepository, JobPost $jobPost, Request $request)
    {
        $jobDetails = $jobPostRepository->find($request->get('id'));

        $cookie = Cookie::create("Job_".$jobDetails->getId(), $jobDetails->getToken(),$jobDetails->getJobPostingTime() + 3600 * 24 * 30);
        
        $response = new Response();
        $response->headers->setCookie($cookie);
        $response->send();
        
        $getCookie = $request->cookies->get("Job_".$jobDetails->getId());
        
        if(is_null($getCookie)){
            $entityManager = $this->getDoctrine()->getManager();
            $jobPost->setTotalView($jobPost->getTotalView() + 1);
            $this->getDoctrine()->getManager()->flush();
        }

        if ($request->isMethod('POST')) {
            dd($request->get('email_address'));
        }

        $session = new Session();
        $session->start();
        // $session->get('session_id');
        return $this->render('home/job_details.html.twig',[
            'detail' => $jobDetails,
            'session' => bin2hex(random_bytes(60))
        ]);
    }

    /**
     * @Route("/new-job", name="new_job", methods={"GET","POST"})
     */
    public function newJob(Request $request)
    {
        $jobPost = new JobPost();
        
        $form = $this->createForm(JobPostType::class, $jobPost);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            dd($request);
        }
        
        return $this->render('home/job_new.html.twig',['info'=>null]);
    }
}
