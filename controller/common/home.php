<?php

class ControllerCommonHome extends \iMega\Controller
{
    public function index()
    {
        $this->getDocument()->setTitle($this->getConfig()->get('config_meta_title'));
        $this->document->setDescription($this->config->get('config_meta_description'));
        $this->document->setKeywords($this->config->get('config_meta_keyword'));

        if (isset($this->request->get['route'])) {
            $this->document->addLink($this->config->get('config_url'), 'canonical');
        }

        $data['column_left']    = $this->load->controller('common/column_left');
        $data['column_right']   = $this->load->controller('common/column_right');
        $data['content_top']    = $this->load->controller('common/content_top');
        $data['content_bottom'] = $this->load->controller('common/content_bottom');
        $data['footer']         = $this->load->controller('common/footer');
        $data['header']         = $this->load->controller('common/header');

        $categories = (new \ModelCatalogCategory($this->registry))->getCategories(0);
        $data['categories'] = [];

        foreach ($categories as $category) {
            if ($category['top']) {
                // Level 2
                $children_data = [];
                $children = (new \ModelCatalogCategory($this->registry))->getCategories($category['category_id']);

                foreach ($children as $child) {
                    $filter_data = [
                        'filter_category_id'  => $child['category_id'],
                        'filter_sub_category' => true,
                    ];

                    $children_data[] = [
                        'name'  => $child['name'] . ($this->getConfig()->get('config_product_count') ? ' (' . (new \ModelCatalogProduct($this->registry))->getTotalProducts($filter_data) . ')' : ''),
                        'href'  => $this->getUrl()->link(\iMega\Route\Product::CATEGORY, 'path=' . $category['category_id'] . '_' . $child['category_id'])
                    ];
                }

                // Level 1
                $data['categories'][] = [
                    'name'     => $category['name'],
                    'children' => $children_data,
                    'column'   => $category['column'] ? $category['column'] : 1,
                    'href'     => $this->getUrl()->link(\iMega\Route\Product::CATEGORY, 'path=' . $category['category_id'])
                ];
            }
        }

        $this->response->setOutput($this->getLoader()->view(\iMega\Route\Common::HOME, $data));
    }
}
