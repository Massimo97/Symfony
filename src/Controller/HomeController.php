<?php

namespace App\Controller;

use App\Entity\Post;
use App\Repository\CommentRepository;
use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


#[Route('/')]
class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(PostRepository $postRepository, CommentRepository $commentRepository): Response
    {
        $posts = $postRepository->findLast(10);
        $recent = $postRepository->findLast(1)[0];
        
        return $this->render('home/index.html.twig', [
            'posts' => $posts,
            'recent' => $recent,
        ]);
    }
}
