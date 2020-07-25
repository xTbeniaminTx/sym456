<?php

namespace App\Controller;

use App\Repository\UserRepository;
use App\Services\GiftsService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{

    /**
     * @Route("/", name="default_home")
     */
    public function index(UserRepository $userRepository, GiftsService $gifts)
    {

        $users = $userRepository->findAll();

        $this->addFlash(
            'notice',
            'Hello with flash Message Notice'
        );

        $this->addFlash(
            'warning',
            'Hello with flash Message Warning'
        );

        return $this->render('default/index.html.twig', [
            'users' => $users,
            'random_gift' => $gifts->gifts
        ]);
    }

    /**
     * @Route("/blog/{page}", name="blog_list", requirements={"page"="\d+"})
     */
    public function index2()
    {
        return new Response("Optional parameters in url and requiremants for parameters!");
    }

    /**
     * @Route(
     *     "/articles/{_locale}/{year}/{slug}/{category}",
     *     defaults={"category": "computers"},
     *     requirements={
     *          "_locale": "en|fr",
     *          "category": "computers|rtv",
     *          "year": "\d+"
     *        }
     * )
     *
     */
    public function index3()
    {
        return new Response("Advance route!");
    }

    /**
     * @Route({
     *     "nl": "/over-ons",
     *     "en": "/about-us"
     *     }, name="about_us")
     */
    public function index4()
    {
        return new Response("Advance route 4 --- Translated routes!");
    }

}
