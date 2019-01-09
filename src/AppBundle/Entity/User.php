<?php

namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @author Jérémy Lefebvre <jeremy2@widop.com>
 *
 * @ORM\Entity
 */
class User extends \FOS\UserBundle\Model\User
{
    /**
     * @ORM\Id
     * @ORM\Column(type = "integer")
     * @ORM\GeneratedValue
     */
    protected $id;

    /**
     * @ORM\Column(type = "integer", nullable = true)
     */
    protected $rating;

    /**
     * @ORM\OneToMany(targetEntity = "Annonce", mappedBy = "user")
     */
    protected $annonces;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return mixed
     */
    public function getRating()
    {
        return $this->rating;
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
    public function getId()
    {
        return $this->id;
    }
}
