<?php

use iMega\Service;

class ControllerCommonHome extends \iMega\Controller
{
    public function index()
    {
        $this->getDocument()->setTitle($this->getConfig()->get('config_meta_title'));
        $this->getDocument()->setDescription($this->getConfig()->get('config_meta_description'));
        $this->getDocument()->setKeywords($this->getConfig()->get('config_meta_keyword'));

        if (isset($this->getRequest()->get['route'])) {
            $this->getDocument()->addLink($this->getConfig()->get('config_url'), 'canonical');
        }

        $data = [
            'column_left'    => $this->getLoader()->controller(iMega\Route\Common::COLUMN_LEFT),
            'column_right'   => $this->getLoader()->controller(iMega\Route\Common::COLUMN_RIGHT),
            //'content_top'    => $this->getLoader()->controller(iMega\Route\Common::CONTENT_TOP),
            'content_bottom' => $this->getLoader()->controller(iMega\Route\Common::CONTENT_BOTTOM),
            'footer'         => $this->getLoader()->controller(iMega\Route\Common::FOOTER),
            'header'         => $this->getLoader()->controller(iMega\Route\Common::HEADER),
        ];

        $catalog = $this->getContainer()->offsetGet(Service::CATALOG);
        //$products = $catalog->renderProducts($items);
        $this->response->setOutput(
            $this->render(
                'catalog/index.html.twig',
                [
                    'content_top' => $this->getLoader()->controller(iMega\Route\Common::CONTENT_TOP),
                ]
            )
        );
    }
}
