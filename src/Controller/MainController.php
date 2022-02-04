<?php

namespace App\Controller;

use App\Repository\SubscriptionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(SubscriptionRepository $subR): Response
    {
        return $this->render('main/index.html.twig', [
            'subs' => $subR->findAll(),
        ]);
    }
}
