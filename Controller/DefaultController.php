<?php

namespace RJM\Bundle\MaxmindBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('RJMMaxmindBundle:Default:index.html.twig', array('name' => $name));
    }
}
