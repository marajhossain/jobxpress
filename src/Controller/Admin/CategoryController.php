<?php

namespace App\Controller\Admin;

use App\Entity\Category;
use App\Form\CategoryType;
use App\Model\CategoryManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/admin/category")
 */
class CategoryController extends AbstractController
{
    /**
     * @Route("/", name="category_index", methods={"GET"})
     */
	public function index(CategoryManager $catManager): Response
    {
        return $this->render('admin/category/index.html.twig', [
            'categories' => $catManager->getList()
        ]);
    }

    /**
     * @Route("/new", name="category_new", methods={"GET","POST"})
     */
    public function new(Request $request, ValidatorInterface $validator): Response
    {
        $category = new Category();
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

			$errors = $validator->validate($category);

			if (count($errors) > 0) {
				$this->addFlash('warning', 'Provided data did not pass the validation !');

				return $this->redirectToRoute('category_new');				
			}		

			$category->setCreatedBy(0);
			$category->setEditedBy(0);
			$category->setDeletedBy(0);
			$category->setCreatedAt(new \DateTime('now'));
			$category->setEditedAt(null);
			$category->setDeletedAt(null);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($category);
            $entityManager->flush();

            return $this->redirectToRoute('category_index');
        }

        return $this->render('admin/category/new.html.twig', [
            'category' => $category,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="category_show", methods={"GET"})
     */
    public function show($id, CategoryManager $catManager): Response
    {
		$category = $catManager->getById($id);

		if (empty($category) > 0) {
			$this->addFlash('warning', 'No data available !');

			return $this->redirectToRoute('category_index');	
		}

        return $this->render('admin/category/show.html.twig', [
            'category' => $category,
		]);
    }

    /**
     * @Route("/{id}/edit", name="category_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Category $category, ValidatorInterface $validator): Response
    {
		if (empty($category) > 0) {
            $this->addFlash('warning', 'No data available !');

            return $this->redirectToRoute('category_index');
		}
		
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

			$errors = $validator->validate($category);

            if (count($errors) > 0) {
                $this->addFlash('warning', 'Provided data did not pass the validation !');

                return $this->redirectToRoute('category_new');
			}
			
			$category->setEditedBy(0);
			$category->setEditedAt(new \DateTime('now'));

			$this->getDoctrine()->getManager()->flush();

			$this->addFlash('success', 'Category has been updated successfully !');

            return $this->redirectToRoute('category_index');
        }

        return $this->render('admin/category/edit.html.twig', [
            'category' => $category,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="category_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Category $category): Response
    {
        if ($this->isCsrfTokenValid('delete'.$category->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($category);
            $entityManager->flush();
        }

        return $this->redirectToRoute('category_index');
    }
}
