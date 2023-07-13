<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\Article1Type;
use App\Repository\UserRepository;
use App\Repository\ArticleRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


#[Route('/article')]
class ArticleController extends AbstractController
{

    #[Route('/', name: 'app_article_index', methods: ['GET'])]
    public function index(ArticleRepository $articleRepository)
    {

        return $this->render('article/index.html.twig', [
            'articles' => $articleRepository->findAll(),
        ]);

        // return $this->json($articleRepository->findAll(), 200, [], ['groups' => 'article:read']);

    }

    #[Route('/{slug}', name: 'app_article_show', methods: ['GET'])]
    public function show(Article $article): Response
    {
        $comments = $article->getComments();
        return $this->render('article/show.html.twig', [
            'article' => $article,
            'comments' => $comments,
        ]);

    }


    // #[Route('/post', name: 'app_article_post', methods: ['POST'])]
    // public function post(Request $request, SerializerInterface $serializer, EntityManagerInterface $em, ValidatorInterface $validator, UserRepository $userRepository)
    // {
    //     $jsonRecu = $request->getContent();
    
    //     try {
    //         $user = $userRepository->find(1); // Récupérer l'utilisateur numéro 1
    
    //         $post = $serializer->deserialize($jsonRecu, Article::class, 'json');
    
    //         $post->setUser($user); // Attribuer l'utilisateur à l'Article
    
    //         $errors = $validator->validate($post);
    
    //         if (count($errors) > 0) {
    //             return $this->json($errors, 400);
    //         }
    
    //         $em->persist($post);
    //         $em->flush();
    
    //         return $this->json($post, 201, [], ['groups' => 'article:read']);
    //     } catch (NotEncodableValueException $e) {
    //         return $this->json([
    //             'status' => 400,
    //             'message' => $e->getMessage()
    //         ], 400);
    //     }
    // }
    

}
