<?php

namespace App\Controller;

use App\Entity\Post;
use App\Entity\User;
use App\Form\PostType;
use App\Form\UserType;
use App\Repository\CommentRepository;
use App\Repository\ContactRepository;
use App\Repository\PostRepository;
use App\Repository\UserRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Psr\Log\LoggerInterface;
use Symfony\Component\Validator\Constraints\Length;

#[Route('/user')]
class UserController extends AbstractController
{
    public function __construct(private UserPasswordHasherInterface $hasher)
    {
    }

    #[Route('/', name: 'app_user_index', methods: ['GET'])]
    public function index(UserRepository $userRepository): Response
    {
        return $this->render('user/index.html.twig', [
            'users' => $userRepository->findAll(),
        ]);
    }

    // display all recettes by admin
    #[Route('/admin', name: 'app_admin_recettes', methods: ['GET'])]
    public function adminRecettes(PostRepository $postRepository): Response
    {
        return $this->render('user/recettes/adminRecettes.html.twig', [
            'adminrecettes' => $postRepository->findLast(10),
        ]);
    }

    // display all messages by admin
    #[Route('/admin/messages', name: 'app_admin_messages', methods: ['GET'])]
    public function adminMessages(ContactRepository $contactRepository): Response
    {
        return $this->render('user/messages.html.twig', [
            'adminmessages' => $contactRepository->findAll(),
        ]);
    }

    // edit recette by admin
    #[Route('/admin/{id}/edit', name: 'app_recette_edit', methods: ['GET', 'POST'])]
    public function recetteEdit(Post $post, Request $request, ManagerRegistry $doctrine): Response
    {
        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            //les envoyer a la bdd
            $manager = $doctrine->getManager();
            $manager->persist($post);
            $manager->flush();

            return $this->redirectToRoute('app_admin_recettes', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('user/recettes/edit.html.twig', [
            "form" => $form->createView()
        ]);
    }

    // delete recette by admin
    #[Route('/admin/{id}', name: 'app_recette_delete')]
    public function recetteDelete(Post $post, CommentRepository $commentRepository, ManagerRegistry $doctrine): Response
    {
        $commentsFromTheRecette = $post->getComments();

        if ($commentsFromTheRecette->count() != 0) {
            foreach ($commentsFromTheRecette as &$comment) {
                $commentRepository->remove($comment);
            }
        }

        $manager = $doctrine->getManager();
        $manager->remove($post);
        $manager->flush();

        return $this->redirectToRoute('app_admin_recettes', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/new', name: 'app_user_new', methods: ['GET', 'POST'])]
    public function new(Request $request, UserRepository $userRepository, LoggerInterface $logger): Response
    {
        $logger->info('We are in user controller');

        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user->setPassword(
                $this
                    ->hasher
                    ->hashPassword(
                        $user,
                        $user->getPassword()
                    )
            );
            $userRepository->add($user, true);

            return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('user/new.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_user_show', methods: ['GET'])]
    public function show(User $user): Response
    {
        return $this->render('user/show.html.twig', [
            'user' => $user,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_user_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, User $user, UserRepository $userRepository): Response
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userRepository->add($user, true);

            return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('user/edit.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }


    #[Route('/{id}', name: 'app_user_delete', methods: ['POST'])]
    public function delete(Request $request, User $user, UserRepository $userRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $user->getId(), $request->request->get('_token'))) {
            $userRepository->remove($user, true);
        }

        return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
    }
}
