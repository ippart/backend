<?php

namespace iMega\Request;

use iMega\Catalog\Filter;
use Request;

class RequestToFilter
{
    /**
     * @var int
     */
    private $productLimit;

    /**
     * RequestToFilter constructor.
     *
     * @param int $productLimit
     */
    public function __construct($productLimit)
    {
        $this->productLimit = $productLimit;
    }

    /**
     * @param Request $r
     *
     * @return Filter
     */
    public function invoke(Request $r)
    {
        $f = new Filter();

        if (isset($r->get['filter'])) {
            $f->setFilter($r->get['filter']);
        }

        if (isset($r->get['sort'])) {
            $f->setSort($r->get['sort']);
        }

        if (isset($r->get['order'])) {
            $f->setOrder($r->get['order']);
        }

        $limit = $this->productLimit;
        if (isset($r->get['limit'])) {
            $limit = (int) $r->get['limit'];
        }
        $f->setLimit($limit);

        if (isset($r->get['page'])) {
            $f->setStart(((int) $r->get['page'] - 1) * $limit);
        }

        return $f;
    }
}
