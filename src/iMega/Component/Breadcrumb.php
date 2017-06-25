<?php

namespace iMega\Component;

class Breadcrumb
{
    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $route;

    /**
     * @var string
     */
    private $path;

    /**
     * Breadcrumb constructor.
     *
     * @param string $title
     * @param string $route
     * @param string $path
     */
    public function __construct($title, $route, $path = '')
    {
        $this->title = $title;
        $this->route = $route;
        $this->path  = $path;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getRoute()
    {
        return $this->route;
    }

    /**
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }
}
