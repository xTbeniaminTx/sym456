<?php

namespace App\Controller;

use App\Repository\UserRepository;
use App\Services\GiftsService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{

    /**
     * @Route("/", name="default_home")
     */
    public function index(UserRepository $userRepository, GiftsService $gifts)
    {

        $users = $userRepository->findAll();

        return $this->render('default/index.html.twig', [
            'users' => $users,
            'random_gift' => $gifts->gifts
        ]);
    }

}
