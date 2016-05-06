<?php

namespace AppBundle\Controller;

use AppBundle\Entity\ParticipantTimelineData;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        return $this->render('default/index.html.twig');
    }

    /**
     * @Route("/champSelect", name="champion_select")
     */
    public function champSelectAction()
    {
        return $this->redirectToRoute('homepage');
    }
}
