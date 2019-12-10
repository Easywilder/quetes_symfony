<?php
// src/Controller/WildController.php
namespace App\Controller;

use App\Entity\Category;
use App\Entity\Episode;
use App\Entity\Program;
use App\Entity\Season;
use PhpParser\Node\Scalar\String_;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
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
                ->createNotFoundException ('Merde!!!.');
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
                'No program with ' . $slug . ' rajoute le nom une serie!.'
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
    /**
     * Getting a program with a formatted slug for title
     *
     * @Route("/showByprogram/{slug<^[a-z0-9-]+$>}",name="show_program")
     * @param string $slug
     * @return Response
     */

    public function showByProgram(?string $slug): Response
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
        $season = $this->getDoctrine ()
            ->getRepository (Season::class);


        return $this->render ('wild/show.html.twig', [
            'program' => $program,
            'season' => $season,
            'slug' => $slug
        ]);
    }

    /**
     * Getting a program with a formatted slug for title
     *
     * @Route("/showBySeason/{id<^[a-z0-9-]+$>}",name="show_season")
     * @param int $id
     * @return Response
     */

    public function showBySeason(?int $id): Response
    {

        $season = $this->getDoctrine ()
            ->getRepository (Season::class)
            ->find($id);


        if (!$season) {
            throw $this->createNotFoundException (
                'No season with id ' . $id
            );
        }

        $episodes = $season->getEpisodes();

        return $this->render ('wild/show_season.html.twig', [
            'episodes'=> $episodes,
            'season' => $season,
            'id' => $id
        ]);

    }

    /**
     * Getting a program with a formatted slug for title
     *
     * @Route("/showByEpisode/{episodeid<^[a-z0-9-]+$>}",name="show_episode")
     * @ParamConverter("episode", class="App\Entity\Episode", options={"id"="episodeid"})
     * @param Episode $episode    l'épisode de ma série
     * @return Response
     */

    public function showByEpisode(Episode $episode): Response
    {

        if (!$episode) {
            throw $this->createNotFoundException (
                'No episode with this . $id '
            );
        }

        return $this->render ('wild/show_episode.html.twig', [
           'episode' => $episode,


        ]);

    }



}





