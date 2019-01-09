<?php
/**
 * Created by PhpStorm.
 * User: MUD0
 * Date: 08/01/2019
 * Time: 14:56
 */

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass = "AppBundle\EntityRepository\BooksRepository")
 */
class Book
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
    private $title;

    /**
     * @ORM\Column(type ="string", length=255, nullable=true)
     */
    private $collection;

    /**
     * @ORM\Column(type ="integer", nullable=true)
     */
    private $rating;

    /**
     * @ORM\ManyToOne(targetEntity="Type")
     * @ORM\JoinColumn(name="type_id", referencedColumnName="id")
     */
    private $type;

    /**
     * @ORM\ManyToMany(targetEntity="Author", inversedBy="books")
     */
    private $authors;

    /**
     * @ORM\OneToMany(targetEntity="Contain", mappedBy="book")
     */
    protected $contain;

    /**
     * @ORM\Column(type ="string", length=255)
     */
    private $description;

    public function __construct()
    {
        $this->authors = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getContain()
    {
        return $this->contain;
    }

    /**
     * @param mixed $contain
     */
    public function setContain($contain): void
    {
        $this->contain = $contain;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description): void
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $collection
     */
    public function setCollection($collection)
    {
        $this->collection = $collection;
    }

    /**
     * @return mixed
     */
    public function getCollection()
    {
        return $this->collection;
    }

    /**
     * @param mixed $rating
     */
    public function setRating($rating)
    {
        $this->rating = $rating;
    }

    /**
     * @return mixed
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getAuthors()
    {
        return $this->authors;
    }

    /**
     * @param mixed $authors
     */
    public function setAuthors($authors)
    {
        $this->authors = $authors;
    }

    /**
     * @param Author $author
     */
    public function addAuthor(Author $author)
    {
        $this->authors->add($author);
    }

    public function getAnnonces()
    {
        $annonces = [];

        foreach ($this->contain as $contain) {
            $annonces[]['annonce'] = $contain->getAnnonce();
            $annonces[]['qte'] = $contain->getQte();
        }

        return $annonces;
    }
}
