<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * @author Jérémy Lefebvre <jeremy2@widop.com>
 */
class AnnonceRepository extends EntityRepository
{
    /**
     * @return array
     */
    public function threeLatest()
    {
        $qb = $this
            ->createQueryBuilder('a')
            ->orderBy('a.createdAt', 'DESC')
            ->setMaxResults('3');
        ;

        return $qb->getQuery()->getResult();
    }
}
