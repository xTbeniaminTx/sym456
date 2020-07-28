<?php

namespace App\Controller;

use App\Entity\Address;
use App\Entity\User;
use App\Entity\Video;
use App\Repository\UserRepository;
use App\Services\GiftsService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Serializer\Annotation\Groups;

class DefaultController extends AbstractController
{

    public function __construct($logger)
    {

    }

    /**
     * @Route("/home", name="home")
     */
    public function index(Request $request, EntityManagerInterface $entityManager)
    {
        $user11 = $entityManager->find(User::class, 11);
        $user12 = $entityManager->find(User::class, 12);
        $user13 = $entityManager->find(User::class, 13);
        $user14 = $entityManager->find(User::class, 14);
//
//        $user11->addFollowed($user12);
//        $user11->addFollowed($user13);
//        $user11->addFollowed($user14);

//        $entityManager->flush();

        dump($user11->getFollowed()->count());
        dump($user13->getFollowing()->count());


        return $this->render('default/index.html.twig', []);
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

    /**
     * @Route("/generate-url/{param?}", name="generate_url")
     */
    public function generate_url()
    {
        exit($this->generateUrl(
            'generate_url',
            array('param' => 10),
            UrlGeneratorInterface::ABSOLUTE_URL
        ));
    }

    /**
     * @Route("/download", name="download")
     */
    public function download()
    {
        $path = $this->getParameter('download_directory');
        return $this->file($path . 'file.pdf');
    }

    /**
     * @Route("/redirect-test")
     */
    public function redirectTest()
    {
        return $this->redirectToRoute('route_to_redirect', array('param' => 10));
    }

    /**
     * @Route("/url-to-redirect/{param?}", name="route_to_redirect")
     */
    public function methodToRedirect()
    {
        exit('Test redirection!');
    }

    /**
     * @Route("/forwarding_to_controller")
     */
    public function forwardingToController()
    {
        $response = $this->forward(
            'App\Controller\DefaultController::methodToForward',
            array('param' => '15')
        );
        return $response;
    }

    /**
     * @Route("/url-to-forward-to/{param?}", name="route_to_forward_to")
     */
    public function methodToForward($param)
    {
        exit('Test controller forwarding - ' . $param);
    }

    public function mostPopularPosts($number = 2)
    {
        $posts = ["post1", "post2", "post3", "post4"];

        return $this->render('default/most_popular_posts.html.twig', [
            'posts' => $posts
        ]);

    }

}
