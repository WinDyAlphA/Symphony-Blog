<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Commentaire;
use App\Form\CommentaireArticle;
use App\Repository\ArticleRepository;
use App\Repository\CategorieRepository;
use App\Repository\CommentaireRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class ConferenceController extends AbstractController
{
    #[Route('/', name: 'app_conference')]
    
    public function index(ArticleRepository $varArt, CategorieRepository $varCat): Response
    {
        $articles = $varArt->findAll();
        $categories = $varCat->findAll();
        return $this->render('base/index.html.twig', [
            'controller_name' => 'ConferenceController',
            'articles' => $articles,
            'categories' => $categories,
        ]);
    }
    #[Route('article/{id}', name: 'article_show', methods: ['GET'])]
    public function show(Article $article, Request $request, CommentaireRepository $commentaireRepository): Response
    {
        $commentaire = new Commentaire();
        $commentaire->setArticle($article);
        $form = $this->createForm(CommentaireArticle::class, $commentaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $commentaireRepository->save($commentaire, true);

            return $this->redirectToRoute('app_commentaire_index', [], Response::HTTP_SEE_OTHER);
        }
        return $this->render('article/visit.html.twig', [
            'article' => $article,
        ]);
    }
}
