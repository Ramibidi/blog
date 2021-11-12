<?php

namespace App\Controller;


use DateTime;
use App\Entity\Article;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\BrowserKit\Response;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AddController extends AbstractController
{

    /**
     * @Rest\Post("/articlesPost", name="articlesPost")
     */
    public function articlePost(Request $request, EntityManagerInterface $em)

    {
        $data = $request->request->all();
        if (isset($data['title']) && isset($data['auteur']) && isset($data['contenu'])) {
            $article = new Article();
            $article->setTitre($data['title']);
            $article->setAuteur($data['auteur']);
            $article->setContenu($data['contenu']);
            $date = new DateTime('2021-11-11');
            $article->setDateDePublication($date);
            $em->persist($article);
            $em->flush();
            return new Response('bien poster!!!');
        } else {
            return new Response('error');
        }
    }


    /**
     * @Rest\Put("/articlesPut/{id}", name="liste_put")
     */
    public function articlePut(Article $id, Request $request, EntityManagerInterface $em)

    {
        $data = $request->request->all();
        //dd($data);
        if (isset($data['title']) && isset($data['auteur']) && isset($data['contenu'])) {
            $articles = new Article();
            $articles = $this->getDoctrine()->getRepository(Article::class)->find($id);
            $articles->setTitre($data['title']);
            $articles->setContenu($data['auteur']);
            $articles->setAuteur($data['contenu']);
            $date = new \DateTime('2021-11-11');
            $articles->setDateDePublication($date);
            $em->persist($articles);
            $em->flush();
            return new Response('bien modifer!!!' . $id->getContenu());
        } else {
            return new Response('error!!!');
        }
    }

    /**
     * @Rest\Delete("/articlesDelte/{id}", name="liste_delete")
     */
    public function articleDelete($id, EntityManagerInterface $em)

    {

        $article = new Article();
        $article = $this->getDoctrine()->getRepository(Article::class)->find($id);
        $em->remove($article);
        $em->flush();
        return new Response('bien suprimer!!!');
    }


    /**
     * @Rest\Put("/articlesPutMod/{id}", name="liste_putMar")
     */
    public function articleMergePersiste($id, Request $request, EntityManagerInterface $em)

    {
        $data = $request->request->all();
        $article = new Article();
        $article = $this->getDoctrine()->getRepository(Article::class)->find($id);
        //dd($article);
        if (isset($article)) {
            if (isset($data['title']) && isset($data['auteur']) && isset($data['contenu'])) {
                $article->setTitre($data['title']);
                $article->setContenu($data['auteur']);
                $article->setAuteur($data['contenu']);
                $date = new \DateTime('2021-11-11');
                $article->setDateDePublication($date);
                $em->merge($article);
                $em->flush();
                return new Response('bien modifer!!!');
            } else {
                return new Response('error 1');
            }
        } else {
            if (isset($data['title']) && isset($data['auteur']) && isset($data['contenu'])) {
                $article = new Article();
                $article->setTitre($data['title']);
                $article->setContenu($data['auteur']);
                $article->setAuteur($data['contenu']);
                $date = new \DateTime('2021-11-11');
                $article->setDateDePublication($date);
                $em->persist($article);
                $em->flush();
                return new Response('bien ajouter!!!');
            } else {
                return new Response('error3');
            }
        }
    }
}
