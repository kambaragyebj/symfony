<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

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

    /**
     * @Route("/generate-url/{param?}", name="generate_url")
     */
    public function generate_url()
    {
        exit($this->generateUrl(
            'generate_url',
            array('param' => 10),
            UrlGeneratorInterface::ABSOLUTE_URL
        ));
    }


    /**
     * @Route("/download")
     */
    public function download()
    {
        $path =  $this->getParameter('download_directory');
        return $this->file($path.'part2.pdf');
    }
}
