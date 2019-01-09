<?php

namespace AppBundle\EntityRepository;

use Doctrine\ORM\EntityRepository;

/**
 * @author Jérémy Lefebvre <jeremy2@widop.com>
 */
class BooksRepository extends EntityRepository
{
    /**
     * @return array
     */
    public function findMostPopular()
    {
        $q = $this
            ->createQueryBuilder('b')
            ->orderBy('b.rating', 'DESC')
            ->setMaxResults(3)
        ;

        return $q->getQuery()->getResult();
    }
}
