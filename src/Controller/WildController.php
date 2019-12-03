<?php
// src/Controller/WildController.php
namespace App\Controller;

use App\Entity\Category;
use App\Entity\Program;
use PhpParser\Node\Scalar\String_;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/wild", name="wild_")
 */
class WildController extends AbstractController
{
    /*public function index() :Response
    {
        return new Response(
            '<html><body>Wild Series Index</body></html>'
        );
    }*/
    /**
     * Show all rows from Program's entity
     *
     * @Route("/", name="index")
     * @return Response A response instance
     */
    public function index(): Response
    {
        $programs = $this->getDoctrine ()
            ->getRepository (Program::class)
            ->findAll ();
        if (!$programs) {
            throw $this->createNotFoundException ('No program found in program\'s table.'
            );
        }
        return $this->render (
            'wild/index.html.twig',
            ['programs' => $programs]
        );
        /*return $this->render('wild/index.html.twig', [
            'website' => 'Wild séries',
        ]);
        */
    }

    /**
     * Getting a program with a formatted slug for title
     *
     * @param string $slug The slugger
     * @Route("/show/{slug<^[a-z0-9-]+$>}", defaults={"slug" = null}, name="show")
     * @return Response
     */
    public function show(?string $slug): Response
    {
        if (!$slug) {
            throw $this
                ->createNotFoundException ('No slug has been sent to find a program in program\'s table.');
        }
        $slug = preg_replace (
            '/-/',
            ' ', ucwords (trim (strip_tags ($slug)), "-")
        );
        $program = $this->getDoctrine ()
            ->getRepository (Program::class)
            ->findOneBy (['title' => mb_strtolower ($slug)]);
        if (!$program) {
            throw $this->createNotFoundException (
                'No program with ' . $slug . ' title, found in program\'s table.'
            );
        }

        return $this->render ('wild/show.html.twig', [
            'program' => $program,
            'slug' => $slug,
        ]);
    }

    /**
     * Getting a program with a formatted slug for title
     *
     * @Route("/showCategory/{categoryName}",name="show_category")
     * @param string $categoryName
     * @return Response
     */
    public function showByCategory(string $categoryName): Response
    {
        $category = $this->getDoctrine ()
            ->getRepository (Category::class)
            ->findOneBy (['name' => $categoryName]);
        $repo = $this->getDoctrine ()
            ->getRepository (Program::class);

        $programs = $repo->findBy (['Category' => $category],
            ['id' => 'DESC'], 3, 0
        );
        return $this->render ('wild/category.html.twig',
            ['category' => $category,
                'programs' => $programs]
        );

    }
}





