<?php

namespace AppBundle\Repository;

use AppBundle\Model\Search;
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

    public function search(Search $search)
    {
        $s = $search->getSearch();

        $qb = $this->createQueryBuilder('a');

        if ($search->getAuthorFilter()) {
            $qb
                ->orWhere('a.author like :author')
                ->setParameter('author', '%' . $s . '%')
            ;
        }

        if ($search->getTitleFilter()) {
            $qb
                ->orWhere('a.title like :title')
                ->setParameter('title', '%' . $s . '%')
            ;
        }

        if ($search->getCityFilter()) {
            $qb
                ->orWhere('a.city like :city')
                ->setParameter('city', '%' . $s . '%')
            ;
        }

        if ($search->getMinPrice()) {
            $qb
                ->andWhere('a.price >= :price')
                ->setParameter('price', $search->getMinPrice() * 100)
            ;
        }

        if ($search->getMaxPrice()) {
            $qb
                ->andWhere('a.price <= :price')
                ->setParameter('price', $search->getMaxPrice() * 100)
            ;
        }

        return $qb->getQuery()->getResult();
    }
}
