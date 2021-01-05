<?php

namespace App\Controller;

use App\Entity\JobPost;
use App\Form\JobPostType;
use  App\Model\JobPostManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\DependencyInjection\SystemConfigHelper;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

/**
 * @Route("/job/post")
 */
class JobPostController extends AbstractController
{
    private $system_config;
    private $jobPostManager;
    private $uploadDir;

    public function __construct(JobPostManager $jobPostManager, $uploadDir) {
        $this->system_config = new SystemConfigHelper;
        $this->jobPostManager = $jobPostManager;
        $this->uploadDir = $uploadDir;
    }

    /**
     * @Route("/", name="job_post_index", methods={"GET"})
     */
    public function index(Request $request): Response
    {
        $page = $request->query->getInt('page', 1);
        $paginator = $this->jobPostManager->getAllPaginatedJobs($page);

        return $this->render('job_post/index.html.twig', [
            'job_posts' => $paginator,
            'getStatus' => $this->system_config->getStatus(),
            'getJobType' => $this->system_config->getJobType(),
        ]);

        // return $this->render('job_post/index.html.twig', [
        //     'job_posts' => $jobPostRepository->findAll(),
        //     'getStatus' => $this->system_config->getStatus(),
        //     'getJobType' => $this->system_config->getJobType(),
        // ]);
    }

    /**
     * @Route("/new", name="job_post_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $jobPost = new JobPost();
        $form = $this->createForm(JobPostType::class, $jobPost);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $logoFile = $form->get('logo')->getData();

            if ($logoFile) {
                $originalFilename = pathinfo($logoFile->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $newFilename = strtolower(str_replace(' ', '-', $originalFilename)) . '-' . uniqid().'.'.$logoFile->guessExtension();

                // Move the file to the directory where brochures are stored
                try {
                    $logoFile->move(
                        $this->uploadDir,
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }

                // updates the 'brochureFilename' property to store the PDF file name
                // instead of its contents
                $jobPost->setLogo($newFilename);
            }

            $this->jobPostManager->create($jobPost);
            
            return $this->redirectToRoute('job_post_index');
        }

        return $this->render('job_post/new.html.twig', [
            'job_post' => $jobPost,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="job_post_show", methods={"GET"})
     */
    public function show(JobPost $jobPost): Response
    {
        return $this->render('job_post/show.html.twig', [
            'job_post' => $jobPost,
            'getStatus' => $this->system_config->getStatus(),
            'getJobType' => $this->system_config->getJobType(),
        ]);
    }

    /**
     * @Route("/{id}/edit", name="job_post_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, JobPost $jobPost): Response
    {
        $jobPost->setDescription(stripslashes($jobPost->getDescription()));
        $form = $this->createForm(JobPostType::class, $jobPost);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('job_post_index');
        }

        return $this->render('job_post/edit.html.twig', [
            'job_post' => $jobPost,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="job_post_delete", methods={"DELETE"})
     */
    public function delete(Request $request, JobPost $jobPost): Response
    {
        if ($this->isCsrfTokenValid('delete'.$jobPost->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($jobPost);
            $entityManager->flush();
        }

        return $this->redirectToRoute('job_post_index');
    }
}
