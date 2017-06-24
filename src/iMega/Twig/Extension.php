<?php

namespace iMega\Twig;

use iMega\Service;
use Pimple\Container;

class Extension extends \Twig_Extension
{
    /**
     * @var Container
     */
    private $c;

    public function __construct(Container $c)
    {
        $this->c = $c;
    }

    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('url', [$this, 'url']),
        ];
    }

    public function getFilters()
    {
        return [
            new \Twig_SimpleFilter('short', [$this, 'short']),
        ];
    }

    public function url($route, $path, $args = [])
    {
        /**
         * @var \Url            $u
         * @var \ModelToolImage $r
         */
        $u = $this->c->offsetGet(Service::URL_GENERATOR);
        $r = $this->c->offsetGet(Service::RESIZER);

        if ('image' == $route) {
            return $r->resize($path, $args['width'], $args['height']);
        }

        return $u->link($route, $path);
    }

    public function short($value)
    {
        /**
         * @var \Config $c
         */
        $c = $this->c->offsetGet(Service::CONFIG);

        return utf8_substr(
                strip_tags(html_entity_decode($value, ENT_QUOTES, 'UTF-8')),
                0,
                $c->get($c->get('config_theme') . '_product_description_length')
            ) . '..';
    }

    public function getName()
    {
        return 'imega_ext';
    }
}
