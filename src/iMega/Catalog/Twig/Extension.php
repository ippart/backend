<?php

namespace iMega\Catalog\Twig;

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
            new \Twig_SimpleFunction(
                'menu', [$this, 'menu'], [
                    'needs_environment' => true,
                    'is_safe'           => array('html'),
                ]
            ),
        ];
    }

    public function menu(\Twig_Environment $env)
    {
        /**
         * @var \iMega\Service\Catalog $c
         */
        $c = $this->c->offsetGet(Service::CATALOG);

        $categoryId = $c->getCurrentCategory();

        $data = $c->getCategories($categoryId);

        return $env->render(
            'catalog/menu/menu.html.twig',
            [
                'categories' => $data,
                'current'    => $categoryId,
            ]
        );
    }

    public function getName()
    {
        return 'imega_ext';
    }
}
