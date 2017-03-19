<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class LinkController extends Controller
{
    /**
     * @Route("/links", name="link_index")
     */
    public function indexAction()
    {
        $linksCount = $this->getParameter("links_count");

        if (!$linksCount || $linksCount < 1) {
            throw new \InvalidArgumentException("Maybe links_count not defined in parameters");
        }

        $links = $this->get('app.link.generator')->generate($linksCount);

        return $this->render('@App/Link/index.html.twig', [
            'links' => $links
        ]);
    }
}
