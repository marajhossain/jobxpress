<?php

namespace App\Controller;

use App\Entity\JobPost;
use App\Form\JobPostType;
use App\Repository\JobPostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\DependencyInjection\SystemConfigHelper;

/**
 * @Route("/job/post")
 */
class JobPostController extends AbstractController
{
    private $system_config;

    public function __construct() {
        $this->system_config = new SystemConfigHelper;
    }

    /**
     * @Route("/", name="job_post_index", methods={"GET"})
     */
    public function index(JobPostRepository $jobPostRepository): Response
    {
        return $this->render('job_post/index.html.twig', [
            'job_posts' => $jobPostRepository->findAll(),
            'getStatus' => $this->system_config->getStatus(),
        ]);
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
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($jobPost);
            $entityManager->flush();

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
        ]);
    }

    /**
     * @Route("/{id}/edit", name="job_post_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, JobPost $jobPost): Response
    {
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
