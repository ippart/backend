<?php

namespace iMega\Component;

class Breadcrumb
{
    protected $title;
    protected $url;

    /**
     * Breadcrumb constructor.
     *
     * @param string $title
     * @param string $url
     */
    public function __construct($title, $url)
    {
        $this->title = $title;
        $this->url   = $url;
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
    public function getUrl()
    {
        return $this->url;
    }
}
