<?php

namespace App\Controller;

use App\Entity\Subscription;
use App\Form\SubscriptionType;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\SubscriptionRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\RangeType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/subscription")
 */

class SubscriptionController extends AbstractController
{
    /**
     * @Route("/", name="subscription_index")
     */
    public function index(SubscriptionRepository $subR): Response
    {
        return $this->render('subscription/index.html.twig', [
            'subs' => $subR->findAll(),
        ]);
    }
    /**
     * @Route("/{id}", name="subscription_read")
     */
    public function read(Subscription $sub): Response
    {
        return $this->render('subscription/read.html.twig', [
            'sub' => $sub,
        ]);
    }
    /**
     * @Route("/new", name="subscription_new", priority=1)
     * @Route("/{id}/edit", name="subscription_edit")
     */
    public function new(FormFactoryInterface $ffi, Request $request, EntityManagerInterface $em, Subscription $sub = null): Response
    {
        $form = $this->createForm(SubscriptionType::class, $sub,['sub'=>$sub]);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            if (!$sub) {
                $sub = new Subscription;
                $editMode = false;
            }
            $sub->setLabel($data['label']);
            $sub->setCapacity(intval($data['capacity']));
            $sub->setPrice($data['price']);
            $em->persist($sub);
            $em->flush();
            return $this->redirectToRoute('subscription_read', ['id'=>$sub->getId()]);
        }
        return $this->render('subscription/new.html.twig', [
            'controller_name' => 'SubscriptionController',
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("/{id}/delete", name="subscription_delete")
     */
    public function delete(Subscription $sub, EntityManagerInterface $em, Request $request): Response
    {
        $em->remove($sub);
        $em->flush();
        if ($request->isXmlHttpRequest()) {
            return 0;
        } else {
            return $this->redirectToRoute('subscription_index');
        }
        // return $this->render('subscription/index.html.twig', [
        //     'controller_name' => 'SubscriptionController',
        // ]);
    }
}
