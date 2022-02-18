<?php

namespace App\Controller\Back;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MainController extends AbstractController
{
    /**
     *  Homepage back-office
     * 
     * @Route("/", name="back_main_home")
     */
    public function home()
    {

        return $this->render('back/main/home.html.twig');
    }

}
