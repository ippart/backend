<?php

namespace iMega\Service;

use iMega\Service;
use Pimple\Container;

class Breadcrumb
{
    /**
     * @var array []iMega\Component\Breadcrumb
     */
    private $items = [];
    /**
     * @var Container
     */
    private $c;

    /**
     * Breadcrumb constructor.
     *
     * @param Container $c
     */
    public function __construct(Container $c)
    {
        $this->c = $c;

        /**
         * @var \Request $r
         */
        $r = $this->c->offsetGet(Service::REQUEST);

        if (isset($r->get['path'])) {
            /**
             * @var \iMega\Service\Catalog $catalog
             */
            $catalog = $this->c->offsetGet(Service::CATALOG);

            $items = explode('_', $r->get['path']);
            foreach ($items as $k => $v) {
                $path = implode('_', array_slice($items, 0, $k + 1));
                $cat  = $catalog->getCategory((int)$v);
                $this->append(new \iMega\Component\Breadcrumb($cat->getName(), 'product/category', 'path=' . $path));
            }
        }
    }

    public function append(\iMega\Component\Breadcrumb $b)
    {
        $this->items[] = $b;
    }

    /**
     * @return \array[] \iMega\Component\Breadcrumb
     */
    public function getItems()
    {
        return $this->items;
    }
}
