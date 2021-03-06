<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="app_home")
     */
    public function home(): Response
    {
        return $this->render("main/home.html.twig");
    }

    /**
     * @Route("/aboutUs", name="app_about_us")
     */
    public function aboutUs(): Response
    {
        return $this->render("main/aboutUs.html.twig");
    }

}
