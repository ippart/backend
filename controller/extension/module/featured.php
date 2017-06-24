<?php

use iMega\Service;

class ControllerExtensionModuleFeatured extends \iMega\Controller
{
    public function index($setting)
    {
        $this->getLoader()->language('extension/module/featured');

        if (!$setting['limit']) {
            $setting['limit'] = 4;
        }

        if (empty($setting['product'])) {
            return '';
        }

        /**
         * @var \iMega\Service\Catalog $catalog
         */
        $catalog  = $this->getContainer()->offsetGet(Service::CATALOG);
        $items    = array_slice($setting['product'], 0, (int) $setting['limit']);
        $products = [];
        foreach ($items as $product_id) {
            $p = $catalog->getProduct((int) $product_id);

            if (null === $p) {
                continue;
            }

            if ($this->getConfig()->get('config_tax')) {
                $p->setTax($p->getSpecial() ? $p->getSpecial() : $p->getPrice());
            }

            $products[] = $p;
        }

        return $this->render(
            'catalog/product/collection.html.twig',
            [
                'title'    => $this->getLanguage()->get('heading_title'),
                'products' => $catalog->renderProducts($products),
            ]
        );
    }
}
