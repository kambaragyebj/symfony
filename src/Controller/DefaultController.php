<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends AbstractController
{
     public function __construct($logger)
    {
        // use $logger service
    }

    /**
     * @Route("/default", name="default")
     */
    public function index(SessionInterface $session)
    {
        
    $session->set('name', 'session value');
        if($session->has('name'))
        {
            exit($session->get('name')); //display 
        }

        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }
}
