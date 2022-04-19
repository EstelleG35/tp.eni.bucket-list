<?php

namespace App\Controller;

use App\Entity\Idea;
use App\Repository\IdeaRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IdeaController extends AbstractController
{
    /**
     * @Route("/idea/list", name="app_list")
     */
    public function list(EntityManagerInterface $emi): Response
    {
        // récupérer la liste en BDD
        $ideaRepo = $emi->getRepository(Idea::class);

        //on trie les différents titres d'idées selon leur dates de publication, du plus récent au plus ancien.
        $ideas = $ideaRepo->findBy([],['dateCreated' => "DESC"]);

        // on envoie les données à twig.
        return $this->render('idea/list.html.twig', [
            'ideas' => $ideas
        ]);
    }

    /**
     * @Route("/idea/detail/{id}", name="app_detail")
     */
    public function detail(Idea $idea): Response
    {
        //l'id sera filtrer grâce à la route
        //on envoie les données à twig
        return $this->render('idea/detail.html.twig', [
            'idea' => $idea
        ]);
    }
}
