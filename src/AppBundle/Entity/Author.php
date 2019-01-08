<?php
/**
 * Created by PhpStorm.
 * User: MUD0
 * Date: 08/01/2019
 * Time: 15:17
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity
 */
class Author
{
    /**
     * @ORM\Id
     * @ORM\Column(type = "integer")
     * @ORM\GeneratedValue
     */
    protected $id;

    /**
     * @ORM\Column(type ="string", length=255)
     */
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity="Book", mappedBy="authors")
     */
    private $books;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $books
     */
    public function setBooks($books)
    {
        $this->books = $books;
    }

    /**
     * @return mixed
     */
    public function getBooks()
    {
        return $this->books;
    }
}