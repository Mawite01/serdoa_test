<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    #[Route('/user', name: 'user', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
    
        if ($this->isFormSubmittedAndValid($form)) {
            $this->userRepository->save($user, true);
            return $this->redirectToRoute('user');
        }
    
        return $this->renderUserForm($form);
    }
    
    #[Route('/user/delete/{id}', name: 'user_delete', methods: ['GET'])]
    public function delete(User $user): Response
    {
        $this->userRepository->remove($user, true);

        return $this->redirectToRoute('user');
    }
    
    private function isFormSubmittedAndValid($form): bool
    {
        return $form->isSubmitted() && $form->isValid();
    }
    
    private function renderUserForm($form): Response
    {
        return $this->render('user.html.twig', [
            'form' => $form->createView(),
            'users' => $this->userRepository->findAll(),
        ]);
    }
}
