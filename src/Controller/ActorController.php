<?php

namespace App\Controller;

use App\Entity\Actor;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ActorController extends AbstractController
{
    /**
     * @Route("/actor/{id}", name="actor")
     * @param Actor $actor
     * @return Response
     */
    public function show(Actor $actor)
    {
        return $this->render('actor/index.html.twig', [
            'actor' => $actor,
        ]);
    }
}
