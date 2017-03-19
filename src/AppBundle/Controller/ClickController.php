<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Click;
use Doctrine\ORM\EntityManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Exception\RouteNotFoundException;

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
            $alreadyIssetClick = $this->getAlreadyIssetClick($em, $click);
            $alreadyIssetClick->increaseErrorCounter();

            if ($this->get('app.bad.domain')->isInBlackList($click->getReferrer())) {
                $alreadyIssetClick->setBadDomain(true);
            } else {
                $alreadyIssetClick->setBadDomain(false);
            }

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

        if ($click->getError() > 0) {
            throw new RouteNotFoundException("Fired error route with errors click object");
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

        if ($click->getError() == 0) {
            throw new RouteNotFoundException("Fired error route with no errors click object");
        }

        $response = new Response();

        if ($click->getBadDomain()) {
            $domainToRedirect = $this->getParameter("domain_to_redirect");

            if (!$domainToRedirect) {
                throw new \InvalidArgumentException("Maybe domain_to_redirect not defined in parameters");
            }

            $this->addFlash('redirect_notice',
                $this->get('translator')->trans('page.click.error.redirect_notice', ['%url%' => $domainToRedirect])
            );

            $response->headers->set('Refresh', '5; url=' . $domainToRedirect);
        }

        return $this->render('@App/Click/error.html.twig', ['click' => $click], $response);
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

    /**
     * @param EntityManager $em
     * @param Click $click
     * @return Click
     */
    private function getAlreadyIssetClick(EntityManager $em, Click $click)
    {
        $alreadyIssetClick = $em->getRepository(Click::class)->findOneBy([
            'userAgent' => $click->getUserAgent(),
            'ip' => $click->getIp(),
            'referrer' => $click->getReferrer(),
            'firstParam' => $click->getFirstParam()
        ]);

        if (!$alreadyIssetClick) {
            throw $this->createNotFoundException('The click does not exist');
        }

        return $alreadyIssetClick;
    }
}
