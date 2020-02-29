<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Doctrine\Bundle\FixturesBundle\Fixture;

class DefaultController extends AbstractController
{
     public function __construct($logger)
    {
        // use $logger service
    }

    /**
     * @Route("/home", name="default")
     */
    public function index(SessionInterface $session)
    {
       /* 
       $session->set('name', 'session value');
        if($session->has('name'))
        {
            exit($session->get('name')); //display 
        }*/

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


     /**
     * @Route("/redirect-test")
     */
    public function redirectTest()
    {
        return $this->redirectToRoute('route_to_redirect', array('param' => 10));
    }

     /**
     * @Route("/url-to-redirect/{param?}", name="route_to_redirect")
     */
    public function methodToRedirect()
    {
        exit('Test redirection');
    }

    /**
     * @Route("/forwarding-to-controller")
     */
    public function forwardingToController()
    {
        $response = $this->forward(
            'App\Controller\DefaultController::methodToForwardTo',
            array('param'  => '1')
        );
        return $response;
    }

    /**
     * @Route("/url-to-forward-to/{param?}", name="route_to_forward_to")
     */
    public function methodToForwardTo($param)
    {
        exit('Test controller forwarding - '.$param);
    }

}
