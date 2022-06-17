<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Post;
use App\Form\CommentType;
use App\Repository\CommentRepository;
use App\Repository\PostRepository;
use DateTime;
use Doctrine\Persistence\ManagerRegistry;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

#[Route('/comment')]
class CommentController extends AbstractController
{
    /**
     * @var Security
     */
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    #[Route('/', name: 'app_comment_index', methods: ['GET'])]
    public function index(CommentRepository $commentRepo, LoggerInterface $logger): Response
    {
        $logger->info('We are in GET comment controller');
        return $this->render('comment/index.html.twig', [
            'comments' => $commentRepo->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_comment_new', methods: ['POST'])]
    public function new(Request $request, CommentRepository $commentRepo, LoggerInterface $logger, Comment $comment, ManagerRegistry $doctrine): Response
    {
        //$logger->info('We are in POST comment controller');
        //$logger->info($request);
        $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager = $doctrine->getManager();
            $comment->setUser($this->security->getUser());
            $manager->persist($comment);
            $manager->flush();

            return $this->redirectToRoute('app_home');
        }

        return $this->renderForm('comment/new.html.twig', [
            'comment' => $comment,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_comment_show', methods: ['GET'])]
    public function show(Comment $comment): Response
    {
        return $this->render('comment/show.html.twig', [
            'comment' => $comment,
        ]);
    }

    #[Route('/{idP}/{idC}/edit', name: 'app_comment_edit', methods: ['GET', 'POST'])]
    public function edit(int $idP, int $idC, Request $request, CommentRepository $commentRepo, PostRepository $postRepo): Response
    {
        $post = $postRepo->find($idP);
        $comments = [$commentRepo->find($idC)];
        $form = $this->createForm(CommentType::class, $comments[0]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $comments[0]->setCreateat(new DateTime());
            $commentRepo->add($comments[0], true);

            // return $this->redirectToRoute('app_comment_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('comment/edit.html.twig', [
            'comments' => $comments,
            'post' => $post,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_comment_delete', methods: ['POST'])]
    public function delete(Request $request, Comment $comment, CommentRepository $commentRepo): Response
    {

        $commentRepo->remove($comment, true);

        return $this->redirectToRoute('app_recette_detail', [], Response::HTTP_SEE_OTHER);
    }
}
