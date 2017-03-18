<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Click;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ClickController extends Controller
{
    /**
     * @Route("/click/", name="click_index")
     */
    public function clickAction(Request $request)
    {
        $firstParam = $request->query->get('param1');
        $secondParam = $request->query->get('param2');

        $click = new Click();
        $click->setFirstParam($firstParam);
        $click->setSecondParam($secondParam);
        $click->setUserAgent($request->headers->get('user-agent'));
        $click->setReferrer($request->headers->get('referer'));
        $click->setIp($request->getClientIp());

        $validator = $this->get('validator');
        $errors = $validator->validate($click);

        if (count($errors) > 0) {

        }

        $em = $this->getDoctrine()->getManager();
        $em->persist($click);
        $em->flush();

        die('stop');
        return $this->render('');
    }

    /**
     * @Route("/success", name="click_success")
     */
    public function successAction()
    {
        return $this->render('@App/Click/success.html.twig');
    }

    /**
     * @Route("/error", name="click_error")
     */
    public function errorAction()
    {
        return $this->render('@App/Click/error.html.twig');
    }

    /**
     * @return Response
     */
    public function showAllAction()
    {
        $em = $this->getDoctrine()->getManager();
        $clicks = $em->getRepository(Click::class)->findAll();

        return $this->render('@App/Click/showAll.html.twig', [
            'clicks' => $clicks
        ]);
    }
}
