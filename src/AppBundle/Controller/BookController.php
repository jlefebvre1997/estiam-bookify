<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Book;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Created by PhpStorm.
 * User: yannickmaelraoumbe
 * Date: 2019-01-08
 * Time: 15:22
 *
 * @Route("/books")
 */
class BookController extends Controller {

    /**
     * @Template
     *
     * @Route("/", name="book_list")
     */
    public  function listOfBooks() {
        return ['bite' => 'ccc'];
    }

    /**
     * @Template
     *
     * @Route("/{id}", name ="get_one_book")
     */
     public function getOneBook(Book $book){
        return ['book' => $book];
     }

    /**
     * @Template
     *
     * @Route("/{id}/update", name="update_one_book")
     */
    public function update(Book $book){
        return ['book' => $book];
    }

    /**
     * @Template
     *
     * @Route("/{id}/delete", name="delete_one_book")
     */
    public function delete(Book $book){
        return ['book' => $book];
    }
}
