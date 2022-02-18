<?php

namespace App\Controller\Back;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class LoginController extends AbstractController
{
    /**
     * @Route("/login", name="login_index")
     */
     public function index(AuthenticationUtils $authenticationUtils): Response
      {

         // get the login error if there is one
         $error = $authenticationUtils->getLastAuthenticationError();

         // last username entered by the user
         $lastUsername = $authenticationUtils->getLastUsername();


          return $this->render('back/login/index.html.twig', [
            'last_username' => $lastUsername,
            'error'         => $error,
          ]);
      }



    /**
     * Logout
     * 
     * @Route("/logout", name="login_logout")
     */
    public function logout()
    {

         return $this->render('back/login/index.html.twig');
    }


    
}