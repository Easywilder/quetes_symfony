<?php
// src/Controller/WildController.php
namespace App\Controller;

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
     * @Route("/", name="index")
     */
    public function index() :Response
    {
        return $this->render('wild/index.html.twig', [
            'website' => 'Wild séries',
        ]);
    }

    /**
     * @Route("/show/{slug<^[a-z0-9- ]+$>}", name = "show")
     */
    public function show(string $slug = ""): Response
    {
        if (empty($slug)) {
            $slug = "Aucune série sélectionnée, veuillez choisir une série";
        }
        else {
            $slug = str_replace ("-", " ", $slug);
            $slug = ucwords ($slug);
        }
        return $this->render('wild/show.html.twig', [
            'page' => $slug
        ]);

    }


}