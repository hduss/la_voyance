<?php

namespace App\Controller;

use App\Repository\BlogPostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BlogPostController extends AbstractController
{
    public function __construct(private BlogPostRepository $blogPostRepository)
    {
    }

    #[Route('/blog/post', name: 'app_blog_post')]
    public function index(): Response
    {
        $posts = $this->blogPostRepository->findAll();
        return $this->render('blog_post/index.html.twig', [
            'posts' => $posts,
        ]);
    }

    #[Route('/blog/post/{id}', name: 'app_blog_post_detail', requirements: ['id' => '\d+'])]
//    #[Route('/blog/{page}', name: 'blog_list', requirements: ['page' => '\d+'])]
    public function detail($id): Response
    {
        $post = $this->blogPostRepository->findOneBy(['id' => $id]);
        return $this->render('blog_post/detail.html.twig', [
            'post' => $post,
        ]);    }
}
