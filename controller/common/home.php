<?php

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
            'content_top'    => $this->getLoader()->controller(iMega\Route\Common::CONTENT_TOP),
            'content_bottom' => $this->getLoader()->controller(iMega\Route\Common::CONTENT_BOTTOM),
            'footer'         => $this->getLoader()->controller(iMega\Route\Common::FOOTER),
            'header'         => $this->getLoader()->controller(iMega\Route\Common::HEADER),
        ];

        $modelCatalogCategory = new \ModelCatalogCategory($this->registry);

        $categories = $modelCatalogCategory->getCategories(0);

        $data['categories'] = [];

        foreach ($categories as $category) {
            if ($category['top']) {
                // Level 2
                $children_data = [];

                $children = $modelCatalogCategory->getCategories($category['category_id']);
                foreach ($children as $child) {
                    $children_data[] = [
                        'name' => $child['name'],
                        'href' => $this->getUrl()->link(
                            \iMega\Route\Product::CATEGORY,
                            'path=' . $category['category_id'] . '_' . $child['category_id']
                        ),
                    ];
                }

                // Level 1
                $data['categories'][] = [
                    'name'     => $category['name'],
                    'children' => $children_data,
                    'column'   => $category['column'] ? $category['column'] : 1,
                    'href'     => $this->getUrl()->link(
                        \iMega\Route\Product::CATEGORY,
                        'path=' . $category['category_id']
                    )
                ];
            }
        }

        $this->getResponse()->setOutput($this->render(\iMega\Route\Common::HOME, $data));
    }
}
