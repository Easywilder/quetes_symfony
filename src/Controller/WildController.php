<?php
// src/Controller/WildController.php
namespace App\Controller;
//namespace App\Form;  //ajouté pour la quête form

use App\Entity\Category;
use App\Entity\Episode;
use App\Entity\Program;
use App\Entity\Season;
use App\Form\CategoryType;
use App\Form\ProgramSearchType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

// ajouté pour la quête form

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

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

    }

    /**
     * Getting a program with a formatted slug for title
     *
     *
     * @param Program $program
     * @return Response
     * @Route("/show/{slug}", defaults={"slug" = null}, name="show")
     */
    public function show(Program $program) : Response
    {
        if (!$program) {
            throw $this->createNotFoundException (
                'No program with '  . ' rajoute le en base de données!.'
            );
        }

        return $this->render ('wild/show.html.twig', [
            'program' => $program,
        ]);
    }
   /* public function show(?string $slug): Response
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
                'No program with ' . $slug . ' rajoute le en base de données!.'
            );
        }

        return $this->render ('wild/show.html.twig', [
            'program' => $program,
            'slug' => $slug,
        ]);
    } */

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
        $programs = $this->getDoctrine ()
            ->getRepository (Program::class)
            ->findBy (['Category' => $category],
            ['id' => 'DESC'], 6, 0
        );
        return $this->render ('wild/category.html.twig',
            ['category' => $category,
                'programs' => $programs]
        );

    }

    /**
     * Getting a program with a formatted slug for title
     *
     * @Route("/showByprogram/{slug}",name="show_program")
     * @param
     * @return Response
     */

    public function showByProgram(string $slug): Response
    {
        if (!$slug) {
            throw $this
                ->createNotFoundException ('No slug has been sent to find a program in program\'s table.');
        }

        $program = $this->getDoctrine ()
            ->getRepository (Program::class)
            ->findOneBy (['slug' =>($slug)]);


        if (!$program) {
            throw $this->createNotFoundException (
                'No program with ' . $slug . ' title, found in program\'s table.'
            );
        }

        return $this->render ('wild/show.html.twig', [
            'program' => $program,
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
            ->find ($id);


        if (!$season) {
            throw $this->createNotFoundException (
                'No season with id ' . $id
            );
        }

        $episodes = $season->getEpisodes ();

        return $this->render ('wild/show_season.html.twig', [
            'episodes' => $episodes,
            'season' => $season,
            'id' => $id
        ]);

    }

    /**
     * Getting a program with a formatted slug for title
     *
     * @Route("/showByEpisode/{episodeid<^[a-z0-9-]+$>}",name="show_episode")
     * @ParamConverter("episode", class="App\Entity\Episode", options={"id"="episodeid"})
     * @param Episode $episode l'épisode de ma série
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





