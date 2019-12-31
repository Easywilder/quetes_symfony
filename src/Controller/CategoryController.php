<?php

namespace App\Controller;

use App\Entity\Category;
use App\Form\CategoryType;
use App\Form\ProgramSearchType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    /**
     * @Route("/admin/category", name="category")
     */
    public function index()
    {
        //pour afficher une boucle de la liste des catégories sur la route /category

        $categories = $this->getDoctrine ()
            ->getRepository (Category::class)
            ->findAll ();

        return $this->render (
            'category/index.html.twig',
            ['categories' => $categories]
        );
    }

    /**
     * @Route("/category/add", name="category_add")
     * @param Request $request
     * @return Response
     */
    public function add(Request $request)
    {
        $category = new Category();
        $form = $this->createForm (
            CategoryType::class,
            $category);

        // gestion de la requete par le form (handlerequest)
        // Si formulaire est soumis et valide

        // inutile car objet category deja modifie
        // $category = $form->getData();

        // persist $category et flush
        // redirect vers la liste des categories
        $form->handleRequest ($request);
        if ($form->isSubmitted () && $form->isValid ()) {
           // $category = $form->getData ();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($category);
            $entityManager->flush();
            return $this->redirectToRoute ('category');
        }

        return $this->render ('category/add.html.twig', [
            'form' => $form->createView (),
        ]);
    }
}
