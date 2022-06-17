<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Image;
use App\Entity\Post;
use App\Form\CommentType;
use App\Form\PostType;
use App\Repository\CommentRepository;
use App\Repository\ImageRepository;
use App\Repository\PostRepository;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\String\Slugger\SluggerInterface;

#[Route('/recettes')]
class RecetteController extends AbstractController
{
    #[Route('/', name: 'app_recettes', methods: ['GET'])]
    public function index(PostRepository $postRepository): Response
    {
        $posts = $postRepository->findLast(10);

        return $this->render('recette/index.html.twig', [
            'posts' => $posts,
        ]);
    }

    #[Route('/new', name: 'app_recette_new', methods: ['GET', 'POST'])]
    public function new(Request $request, PostRepository $postRepo): Response
    {
        $post = new Post();
        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $post->setCreateat(new DateTime());
            $postRepo->add($post, true);

            // return $this->redirectToRoute('app_home', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('post/new.html.twig', [
            'form' => $form,
            'formTitle' => "Création d'un nouveau post",
        ]);
    }

    #[Route('/{id}', name: 'app_recette_detail', methods: ['GET', 'POST'])]
    public function recettedetail(Post $post, int $id, Request $request, CommentRepository $commentRepository, PostRepository $postRepository, LoggerInterface $logger): Response
    {
        //$logger->info('We are in recette controller');
        $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);

        $comments = $post->getComments();

        $threeRecentRecettes = $postRepository->findLast(3);

        if ($form->isSubmitted() && $form->isValid()) {
            $comment->setUser($this->getUser());
            $comment->setPost($post);
            $comment->setCreateat(new DateTime());

            $commentRepository->add($comment, true);

            return $this->redirectToRoute('app_recette_detail', ['id' => $id], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('recette/recettedetail.html.twig', [
            'post' => $post,
            'form' => $form,
            'comments' => $comments,
            'posts' => $threeRecentRecettes,
        ]);
    }
}
