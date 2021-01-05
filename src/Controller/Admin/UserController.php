<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Form\UserType;
use App\Form\EditUserType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Model\UserManager;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * @Route("/admin/user")
 */
class UserController extends AbstractController
{
    /**
     * @Route("/", name="user_index", methods={"GET"})
     */
    public function index(UserManager $userManager): Response
    {
        return $this->render('admin/user/index.html.twig', [
            'users' => $userManager->getList()
        ]);
    }

    /**
     * @Route("/new", name="user_new", methods={"GET","POST"})
     */
    public function new(Request $request, ValidatorInterface $validator, UserPasswordEncoderInterface $passwordEncoder): Response
    {
		$user = new User();         

        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid() ) {

			$errors = $validator->validate($user);

			if (count($errors) > 0) {
				$this->addFlash('warning', 'Provided data did not pass the validation !');

				return $this->redirectToRoute('user_new');				
			}		

			$user->setCreatedBy(0);
			$user->setEditedBy(0);
			$user->setDeletedBy(0);
			$user->setCreatedAt(new \DateTime('now'));
			$user->setEditedAt(null);
			$user->setDeletedAt(null);
			$user->setPassword(
				$passwordEncoder->encodePassword(
					$user,
					$form->get('password')->getData()
				)
			);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
			$entityManager->flush();
			
			$this->addFlash('success', 'User has been created successfully !');
			
            return $this->redirectToRoute('user_index');
        }

        return $this->render('admin/user/new.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="user_show", methods={"GET"})
     */
    public function show($id, UserManager $userManager): Response
    {
		$user = $userManager->getById($id);

		if (empty($user) > 0) {
			$this->addFlash('warning', 'No data available !');

			return $this->redirectToRoute('user_index');				
		}

        return $this->render('admin/user/show.html.twig', [
            'user' => $user
        ]);
    }

    /**
     * @Route("/{id}/edit", name="user_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, User $user, ValidatorInterface $validator): Response
    {
        if (empty($user) > 0) {
            $this->addFlash('warning', 'No data available !');

            return $this->redirectToRoute('user_index');
        }

        $form = $this->createForm(EditUserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
			
			$errors = $validator->validate($user);

            if (count($errors) > 0) {
                $this->addFlash('warning', 'Provided data did not pass the validation !');

                return $this->redirectToRoute('user_edit');
            }

			$user->setEditedBy(0);
			$user->setEditedAt(new \DateTime('now'));

			$entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
			$entityManager->flush();

			$this->addFlash('success', 'User has been updated successfully !');

            return $this->redirectToRoute('user_index');
        }

        return $this->render('admin/user/edit.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
	}
	
	// Not used yet
	private function getEditField(User $user, object $data)
	{		
		return $this->createFormBuilder($user)
			->add('name')
			->add('email')
            ->add('password', PasswordType::class)
			->add('profile_photo')
			->add('type', ChoiceType::class, [
				'placeholder' => 'Select User Type',
				'choices'  => [
					'Admin'  => 0,
					'User'   => 1,
					'Poster' => 2,
				],
				'data' => $data->type
			])->add('status', ChoiceType::class, [
				'choices'  => [
					'Active'    => 1,
					'Inactive'  => 0
				]
			])
			->getForm();
	}

    /**
     * @Route("/{id}", name="user_delete", methods={"DELETE"})
     */
    public function delete(Request $request, User $user): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($user);
            $entityManager->flush();
        }

        return $this->redirectToRoute('user_index');
    }
}
