<?php

namespace iMega\Service;

use iMega\LoaderInterface;

class Breadcrumb
{
    /**
     * @var LoaderInterface
     */
    private $loader;
    /**
     * @var array []iMega\Component\Breadcrumb
     */
    private $items = [];

    public function __construct($loader)
    {
        $this->loader = $loader;
    }

    public function append(\iMega\Component\Breadcrumb $b)
    {
        $this->items[] = $b;
    }

    /**
     * @return string
     */
    public function render()
    {
        return $this->loader->view('components/navigation/breadcrumb', ['breadcrumbs' => $this->items]);
    }
}
