<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Click;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ClickController extends Controller
{
    /**
     * @Route("/click/", name="click_index")
     */
    public function clickAction(Request $request)
    {
        if (!$request->query->has('param1') || !$request->query->has('param2')) {
            throw new NotFoundHttpException("Need param1 and param2 in request query string");
        };

        $em = $this->getDoctrine()->getManager();

        $click = Click::createByRequest($request);

        $errors = $this->get('validator')->validate($click);

        if (count($errors) > 0) {
            $alreadyIssetClick = $em->getRepository(Click::class)->findOneBy([
                'userAgent' => $click->getUserAgent(),
                'ip' => $click->getIp(),
                'referrer' => $click->getReferrer(),
                'firstParam' => $click->getFirstParam()
            ]);

            $alreadyIssetClick->increaseErrorCounter();

            $em->persist($alreadyIssetClick);
            $em->flush();

            return $this->redirect($this->generateUrl('click_error', ['id' => $alreadyIssetClick->getId()]));
        }

        $em->persist($click);
        $em->flush();

        return $this->redirect($this->generateUrl('click_success', ['id' => $click->getId()]));
    }

    /**
     * @Route("/success/{id}", name="click_success")
     */
    public function successAction(Click $click)
    {
        if (!$click) {
            throw $this->createNotFoundException('The click does not exist');
        }

        return $this->render('@App/Click/success.html.twig', [
            'click' => $click
        ]);
    }

    /**
     * @Route("/error/{id}", name="click_error")
     */
    public function errorAction(Click $click)
    {
        if (!$click) {
            throw $this->createNotFoundException('The click does not exist');
        }

        return $this->render('@App/Click/error.html.twig', [
            'click' => $click
        ]);
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
