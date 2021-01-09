<?php

namespace App\Controller;

use App\Entity\JobApply;
use App\Repository\CategoryRepository;
use App\Entity\JobPost;
use App\Form\JobApplyType;
use App\Repository\JobPostRepository;
use App\Form\JobPostType;
use App\Model\HomeManager;
use App\Model\JobPostManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class HomeController extends AbstractController
{
    private $homeManager;
    private $jobPostManager;
    private $uploadDir;

    public function __construct
    (
        HomeManager $homeManager,
        JobPostManager $jobPostManager,
        $uploadDir
    ) {
        $this->homeManager = $homeManager;
        $this->jobPostManager = $jobPostManager;
        $this->uploadDir = $uploadDir;
    }

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
        $jobDetails = $this->homeManager->getJobById($request->get('id'));

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
            
            $logoFile = $form->get('logo')->getData();

            if ($logoFile) {
                $originalFilename = pathinfo($logoFile->getClientOriginalName(), PATHINFO_FILENAME);
                $newFilename = strtolower(str_replace(' ', '-', $originalFilename)) . '-' . uniqid().'.'.$logoFile->guessExtension();

                try {
                    $logoFile->move(
                        $this->uploadDir,
                        $newFilename
                    );

                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }

                $jobPost->setLogo($newFilename);

            }

            $jobPost->setStatus(1);

            $this->jobPostManager->create($jobPost);
            
            return $this->redirectToRoute('new_job');

        }
        
        return $this->render('home/job_new.html.twig',[
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/job-apply", name="job_apply", methods={"GET", "POST"})
     */
    public function jobApply(Request $request)
    {
        $jobApply = new JobApply();
        $form = $this->createForm(JobApplyType::class, $jobApply);
        $form->handleRequest($request);

        $jobDetails = $this->homeManager->getJobById($request->get('id'));
        
        // dd($jobApply->getJob($jobDetails->getId()));
        if ($form->isSubmitted() && $form->isValid()) {
            $resumeFile = $form->get('resume')->getData();

            if ($resumeFile) {
                $originalFilename = pathinfo($resumeFile->getClientOriginalName(), PATHINFO_FILENAME);
                $newFilename = strtolower(str_replace(' ', '-', $originalFilename)) . '-' . uniqid().'.'.$resumeFile->guessExtension();

                try {
                    $resumeFile->move(
                        $this->uploadDir.'/resume/',
                        $newFilename
                    );

                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }

                $jobApply->setResume($newFilename);

            }

            // $jobId = $request->get('id');
            $jobApply->setJob($jobDetails->getId());

            $this->homeManager->jobAppliy($jobApply);
            
            return $this->redirectToRoute('home_index');
        }
        
        
        
        return $this->render('home/job_apply.html.twig',[
            'form' => $form->createView(),
            'jobDetails' => $jobDetails
        ]);
    }
}
