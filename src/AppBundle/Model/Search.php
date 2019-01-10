<?php

namespace AppBundle\Model;

/**
 * @author Jérémy Lefebvre <jeremy2@widop.com>
 */
class Search
{
    private $search;

    private $titleFilter;

    private $authorFilter;

    private $cityFilter;

    private $minPrice;

    private $maxPrice;

    /**
     * @return mixed
     */
    public function getSearch()
    {
        return $this->search;
    }

    /**
     * @param mixed $search
     */
    public function setSearch($search): void
    {
        $this->search = $search;
    }

    /**
     * @return mixed
     */
    public function getTitleFilter()
    {
        return $this->titleFilter;
    }

    /**
     * @param mixed $titleFilter
     */
    public function setTitleFilter($titleFilter): void
    {
        $this->titleFilter = $titleFilter;
    }

    /**
     * @return mixed
     */
    public function getAuthorFilter()
    {
        return $this->authorFilter;
    }

    /**
     * @param mixed $authorFilter
     */
    public function setAuthorFilter($authorFilter): void
    {
        $this->authorFilter = $authorFilter;
    }

    /**
     * @return mixed
     */
    public function getCityFilter()
    {
        return $this->cityFilter;
    }

    /**
     * @param mixed $cityFilter
     */
    public function setCityFilter($cityFilter): void
    {
        $this->cityFilter = $cityFilter;
    }

    /**
     * @return mixed
     */
    public function getMinPrice()
    {
        return $this->minPrice;
    }

    /**
     * @param mixed $minPrice
     */
    public function setMinPrice($minPrice): void
    {
        $this->minPrice = $minPrice;
    }

    /**
     * @return mixed
     */
    public function getMaxPrice()
    {
        return $this->maxPrice;
    }

    /**
     * @param mixed $maxPrice
     */
    public function setMaxPrice($maxPrice): void
    {
        $this->maxPrice = $maxPrice;
    }
}
