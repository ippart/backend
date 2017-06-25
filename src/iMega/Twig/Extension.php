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
            new \Twig_SimpleFunction('breadcrumbs', [$this, 'breadcrumbs'],
                [
                    'needs_environment' => true,
                    'is_safe'           => array('html'),
                ]
            ),
        ];
    }

    public function getFilters()
    {
        return [
            new \Twig_SimpleFilter('short', [$this, 'short']),
            new \Twig_SimpleFilter('trans', [$this, 'trans']),
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

    public function breadcrumbs(\Twig_Environment $env)
    {
        /**
         * @var \iMega\Service\Breadcrumb $b
         */
        $b = $this->c->offsetGet(Service::BREADCRUMB);

        return $env->render('components/navigation/breadcrumb.html.twig', ['breadcrumbs' => $b->getItems()]);
    }

    public function trans($value)
    {
        /**
         * @var \Language $l
         */
        $l = $this->c->offsetGet(Service::TRANSLATE);

        return $l->get($value);
    }

    public function getName()
    {
        return 'imega_ext';
    }
}
