<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Book;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends Controller
{
    /**
     * @Route("/", name="homepage")
     *
     * @Template
     *
     * @param Request $request
     *
     * @return array
     */
    public function indexAction(Request $request)
    {
        $books = $this
            ->getDoctrine()
            ->getRepository(Book::class)
            ->findMostPopular()
        ;

        return ['books' => $books];
    }
}
