<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @author Maxence Vaast
 *
 * @ORM\Entity
 */
class Type
{
    const TYPES = [
        'Science-fiction',
        'Polar',
        'Thriller',
        'Fantastique',
        'Romantique',
        'Bande dessinée',
        'Manga',
    ];

    /**
     * @ORM\Id
     * @ORM\Column(type = "integer")
     * @ORM\GeneratedValue
     */
    protected $id;

    /**
     * @ORM\Column(type ="string", length=255)
     */
    private $type;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
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
    public function getType()
    {
        return $this->type;
    }

    public function __toString()
    {
        return $this->type;
    }
}
