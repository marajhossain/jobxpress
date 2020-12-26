<?php

namespace App\Controller;

use App\Entity\SystemConfig;
use App\Form\SystemConfigType;
use App\Repository\SystemConfigRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/system/config")
 */
class SystemConfigController extends AbstractController
{
    /**
     * @Route("/", name="system_config_index", methods={"GET"})
     */
    public function index(SystemConfigRepository $systemConfigRepository): Response
    {
        return $this->render('system_config/index.html.twig', [
            'system_configs' => $systemConfigRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="system_config_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $systemConfig = new SystemConfig();
        $form = $this->createForm(SystemConfigType::class, $systemConfig);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($systemConfig);
            $entityManager->flush();

            return $this->redirectToRoute('system_config_index');
        }

        return $this->render('system_config/new.html.twig', [
            'system_config' => $systemConfig,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="system_config_show", methods={"GET"})
     */
    public function show(SystemConfig $systemConfig): Response
    {
        return $this->render('system_config/show.html.twig', [
            'system_config' => $systemConfig,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="system_config_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, SystemConfig $systemConfig): Response
    {
        $form = $this->createForm(SystemConfigType::class, $systemConfig);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('system_config_index');
        }

        return $this->render('system_config/edit.html.twig', [
            'system_config' => $systemConfig,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="system_config_delete", methods={"DELETE"})
     */
    public function delete(Request $request, SystemConfig $systemConfig): Response
    {
        if ($this->isCsrfTokenValid('delete'.$systemConfig->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($systemConfig);
            $entityManager->flush();
        }

        return $this->redirectToRoute('system_config_index');
    }
}
