<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Author;
use AppBundle\Entity\Book;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $authors = $em->getRepository(Author::class)->findAll();

        return $this->render('default/index.html.twig', [
            "text"  => "PRE_Home Bookify",
            "authors" => $authors,
        ]);
    }

    /**
     * @Route("/books/{id}", name="bookAuthor")
     */
    public function showBookAuthor(Author $author){
        $author->getId();
        $books = $author->getBooks();

        return $this->render('default/index.html.twig', [
            "text"  => "PRE_Home Bookify",
            "books"     => $books,
            "author"    => $author,
        ]);
    }
}
