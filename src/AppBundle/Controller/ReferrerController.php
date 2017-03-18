<?php

namespace AppBundle\Controller;

use AppBundle\Entity\BadDomain;
use AppBundle\Entity\Click;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class ReferrerController extends Controller
{
    /**
     * @Route("/referrers", name="referrer_bad_referrers")
     */
    public function badReferrersAction()
    {
        $em = $this->getDoctrine()->getManager();

        $badReferrerClicks = $em->getRepository(Click::class)->getBadReferrers();

        return $this->render('@App/Referrer/badReferrers.html.twig', [
            'badReferrerClicks' => $badReferrerClicks
        ]);
    }

    /**
     * @Route("/blacklist/{id}",
     *     name="referrer_add_to_black_list",
     *     condition="request.isXmlHttpRequest()",
     *     options={"expose"=true})
     * @Method("POST")
     */
    public function addToBlackList(Click $click)
    {
        if (!$click) {
            throw $this->createNotFoundException('The click does not exist');
        }

        $referrer = $click->getReferrer();
        $basePart = $this->get('app.url.parser')->parse($referrer)->getBasePart();

        $badDomain = new BadDomain();
        $badDomain->setName($basePart);

        $em = $this->getDoctrine()->getManager();
        $em->persist($badDomain);
        $em->flush();

        return new JsonResponse([
            'success' => true,
        ]);
    }
}
