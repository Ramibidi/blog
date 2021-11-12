<?php

namespace App\Controller;

use App\Entity\Article;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use FOS\RestBundle\Controller\AbstractFOSRestController;




class ArticleController extends AbstractFOSRestController
{
    /**
     * @Route("/RecupererArticles", name="RecupererArticles")
     */
    public function RecupererArticles()
    {
        $article = $this->getDoctrine()
            ->getRepository(Article::class)
            ->findAll();
        foreach ($article as $key => $article) {
            $data[$key]['title'] = $article->getTitre();
            $data[$key]['auteur'] = $article->getAuteur();
            $data[$key]['contenu'] = $article->getContenu();
            $data[$key]['Date De Publication'] = $article->getDateDePublication();
        }
        return new JsonResponse($data);
    }


    /**
     * @Route("/article/{id}", name="controller_RecupererIdArticles")
     */
    public function RecupererIdArticles($id)
    {
        $article = $this->getDoctrine()
            ->getRepository(Article::class)
            ->find($id);
        $data['title'] = $article->getTitre();
        $data['auteur'] = $article->getAuteur();
        $data['contenu'] = $article->getContenu();
        $data['Date De Publication'] = $article->getDateDePublication();
        return new JsonResponse($data);
    }

    /**
     * @Rest\Get("/GetRecupererArticles", name="controller_GetRecupererArticles")
     */
    public function getarticle()
    {
        $article = $this->getDoctrine()
            ->getRepository(Article::class)
            ->findAll();
        foreach ($article as $key => $article) {
            $data[$key]['title'] = $article->getTitre();
            $data[$key]['auteur'] = $article->getAuteur();
            $data[$key]['contenu'] = $article->getContenu();
            $data[$key]['Date De Publication'] = $article->getDateDePublication();
        }
        return new JsonResponse($data);
    }

    /**
     * @Rest\Get("/articleTrois", name="controller_article_trois")
     */
    public function getTroisarticles()
    {
        $article = $this->getDoctrine()
            ->getRepository(Article::class)
            ->findAll();
        foreach ($article as $key => $article) {
            $data[$key]['title'] = $article->getTitre();
            $data[$key]['auteur'] = $article->getAuteur();
            $data[$key]['contenu'] = $article->getContenu();
            $data[$key]['Date De Publication'] = $article->getDateDePublication();
        }
        $array = array_slice($data, -3);
        return new JsonResponse($array);
    }
}
