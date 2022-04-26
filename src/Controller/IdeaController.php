<?php

namespace App\Controller;

use App\Entity\Idea;
use App\Form\CreerIdeeType;
use App\Repository\CategoryRepository;
use App\Repository\IdeaRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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

    /**
     * @Route("/idea/creerIdee", name="app_creer_idee")
     */
    public function add(IdeaRepository $ideaRepo, Request $request, EntityManagerInterface $emi, CategoryRepository $cateRepo): Response
    {
        $idea = new Idea();
        $dateCreated = $idea->setDateCreated(new \DateTime('now'));
        $category = $cateRepo->findAll();
        $form = $this->createForm(CreerIdeeType::class, $idea);

//        demander au formulaire, d’analyser la requête http passée en paramètre
        $form -> handleRequest($request);

        if ($form -> isSubmitted() && $form -> isValid()){

            $emi = $this->getDoctrine()->getManager();
            $emi ->persist($idea);
            $emi ->flush();
            $this->addFlash(
                'notice',
                'Vous venez de rallonger la liste..'
            );

            return $this->redirectToRoute('app_list');
        }

        return $this->render('idea/add.html.twig',[
            'dateCreated'=>$dateCreated,
            'category'=>$category,
            'idea'=>$idea,
            'form'=>$form->createView()
        ]);
    }
}
