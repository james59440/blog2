<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Comment;
use App\Form\CommentType;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use App\Entity\Article;

class BlogController extends AbstractController
{

    /**
     * @Route("/", name="home")
     */

    public function home()
    {
        return $this ->render('site/home.html.twig');
    }



    /**
     * @Route("/site", name="site")
     */
    public function index()
    {
        $repo = $this->getDoctrine()->getRepository(Article::class);
        $articles = $repo ->findAll();

        return $this->render('site/index.html.twig', [
            'controller_name' => 'BlogController',
            'articles' => $articles
        ]);
    }

    /**
     * @Route("/site/new", name="blog_create")
     * @Route("/site/{id}/edit", name="blog_edit")
     */
    public function form(Article $article = null ,Request $request, ObjectManager $manager)
    {
        if (!$article){

            $article = new Article();
        }


        $form = $this->createFormBuilder($article)
            ->add('title')
            ->add('category', EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'title'
            ])
            ->add('content')
            ->add('image')

            ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            if(!$article->getId()){
                $article->setCreatedAt(new \DateTime());

            }



            $manager->persist($article);
            $manager->flush();

            return $this->redirectToRoute('blog_show', [
                'id' => $article->getId()
            ]);
        }

        return $this->render('site/create.html.twig', [
            'formArticle' => $form->createView(),
            'editMode' =>$article->getId() !== null
        ]);

    }



    /**
     * @Route("/site{id}", name="blog_show")
     */
    public function show(Article $article, Request $request, ObjectManager $manager)
    {
        $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $comment->setCreatedAt(new \DateTime())
                ->setArticle($article);

            $manager->persist($comment);
            $manager->flush();

                return $this->redirectToRoute('blog_show', ['id' => $article->getId()]);
        }


        return $this ->render('site/show.html.twig', [
            'article' => $article,
            'commentForm' => $form->createView()
        ]);
    }

    /**
     * @Route("/site/event", name="blog_event")
     */
    public function calen()
    {
        return $this->render('site/event.html.twig');
    }

    /**
     * @Route("/site/produits", name="blog_produits")
     */
    public function produits(){
        return $this->render('site/produits.html.twig');
    }

    /**
     * @Route("/site/createProduit", name="blog_createProduit")
     */
    public function CreateProduit(){
        return $this->render('site/createProduit.html.twig');
    }



}
