<?php

use iMega\Component\Breadcrumb;
use iMega\Service;

class ControllerProductCategory extends \iMega\Controller
{
    protected $breadcrumbs = [];

    public function index()
    {
        $this->getLoader()->language(\iMega\Route\Product::CATEGORY);
        $catalogCategory = new \ModelCatalogCategory($this->registry);
        $catalogProduct  = new \ModelCatalogProduct($this->registry);

        /**
         * @var \ModelToolImage $toolImage
         */
        $toolImage = $this->getContainer()->offsetGet(Service::RESIZER);

        $data = [
            'column_left'    => $this->getLoader()->controller(iMega\Route\Common::COLUMN_LEFT),
            'column_right'   => $this->getLoader()->controller(iMega\Route\Common::COLUMN_RIGHT),
            'content_top'    => $this->getLoader()->controller(iMega\Route\Common::CONTENT_TOP),
            'content_bottom' => $this->getLoader()->controller(iMega\Route\Common::CONTENT_BOTTOM),
            'footer'         => $this->getLoader()->controller(iMega\Route\Common::FOOTER),
            'header'         => $this->getLoader()->controller(iMega\Route\Common::HEADER),
        ];

        $l       = $this->getConfig()->get($this->getConfig()->get('config_theme') . '_product_limit');
        $filter1 = (new \iMega\Request\RequestToFilter($l))->invoke($this->getRequest());

        if (isset($this->request->get['filter'])) {
            $filter = $this->request->get['filter'];
        } else {
            $filter = '';
        }

        if (isset($this->request->get['sort'])) {
            $sort = $this->request->get['sort'];
        } else {
            $sort = 'p.sort_order';
        }

        if (isset($this->request->get['order'])) {
            $order = $this->request->get['order'];
        } else {
            $order = 'ASC';
        }

        if (isset($this->request->get['page'])) {
            $page = $this->request->get['page'];
        } else {
            $page = 1;
        }

        if (isset($this->request->get['limit'])) {
            $limit = (int)$this->request->get['limit'];
        } else {
            $limit = $this->config->get($this->config->get('config_theme') . '_product_limit');
        }

        if (isset($this->request->get['path'])) {
            $url = '';

            if (isset($this->request->get['sort'])) {
                $url .= '&sort=' . $this->request->get['sort'];
            }

            if (isset($this->request->get['order'])) {
                $url .= '&order=' . $this->request->get['order'];
            }

            if (isset($this->request->get['limit'])) {
                $url .= '&limit=' . $this->request->get['limit'];
            }

            $path = '';

            $parts = explode('_', (string)$this->request->get['path']);

            $category_id = (int)array_pop($parts);

            foreach ($parts as $path_id) {
                if (!$path) {
                    $path = (int)$path_id;
                } else {
                    $path .= '_' . (int)$path_id;
                }

                $category_info = $catalogCategory->getCategory($path_id);
            }
        } else {
            $category_id = 0;
        }

        $category_info = $catalogCategory->getCategory($category_id);

        if ($category_info) {
            $this->document->setTitle($category_info['meta_title']);
            $this->document->setDescription($category_info['meta_description']);
            $this->document->setKeywords($category_info['meta_keyword']);

            $data['heading_title'] = $category_info['name'];

            $data['text_refine']       = $this->language->get('text_refine');
            $data['text_empty']        = $this->language->get('text_empty');
            $data['text_quantity']     = $this->language->get('text_quantity');
            $data['text_manufacturer'] = $this->language->get('text_manufacturer');
            $data['text_model']        = $this->language->get('text_model');
            $data['text_price']        = $this->language->get('text_price');
            $data['text_tax']          = $this->language->get('text_tax');
            $data['text_points']       = $this->language->get('text_points');
            $data['text_compare']      = sprintf(
                $this->language->get('text_compare'),
                (isset($this->session->data['compare']) ? count($this->session->data['compare']) : 0)
            );
            $data['text_sort']         = $this->language->get('text_sort');
            $data['text_limit']        = $this->language->get('text_limit');

            $data['button_cart']     = $this->language->get('button_cart');
            $data['button_wishlist'] = $this->language->get('button_wishlist');
            $data['button_compare']  = $this->language->get('button_compare');
            $data['button_continue'] = $this->language->get('button_continue');
            $data['button_list']     = $this->language->get('button_list');
            $data['button_grid']     = $this->language->get('button_grid');

            if ($category_info['image']) {
                $data['thumb'] = $toolImage->resize(
                    $category_info['image'],
                    $this->config->get($this->config->get('config_theme') . '_image_category_width'),
                    $this->config->get($this->config->get('config_theme') . '_image_category_height')
                );
            } else {
                $data['thumb'] = '';
            }

            $data['description'] = html_entity_decode($category_info['description'], ENT_QUOTES, 'UTF-8');
            $data['compare']     = $this->url->link('product/compare');

            $url = '';

            if (isset($this->request->get['filter'])) {
                $url .= '&filter=' . $this->request->get['filter'];
            }

            if (isset($this->request->get['sort'])) {
                $url .= '&sort=' . $this->request->get['sort'];
            }

            if (isset($this->request->get['order'])) {
                $url .= '&order=' . $this->request->get['order'];
            }

            if (isset($this->request->get['limit'])) {
                $url .= '&limit=' . $this->request->get['limit'];
            }

            $data['categories'] = array();

            $results = $catalogCategory->getCategories($category_id);

            foreach ($results as $result) {
                $data['categories'][] = array(
                    'name' => $result['name'],
                    'href' => $this->url->link(
                        'product/category',
                        'path=' . $this->request->get['path'] . '_' . $result['category_id'] . $url
                    )
                );
            }

            $data['products'] = array();

            $filter_data = array(
                'filter_category_id' => $category_id,
                'filter_filter'      => $filter,
                'sort'               => $sort,
                'order'              => $order,
                'start'              => ($page - 1) * $limit,
                'limit'              => $limit
            );

            /**
             * @var \iMega\Service\Catalog $catalog
             */
            $catalog = $this->getContainer()->offsetGet(Service::CATALOG);

            $filter1->setCategoryId($catalog->getCurrentCategory()->getId());

            $items    = $catalog->getProducts($filter1);
            $products = $catalog->renderProducts($items);

            $product_total = $catalogProduct->getTotalProducts($filter_data);
            $results       = $catalogProduct->getProducts($filter_data);

            foreach ($results as $result) {
                if ($result['image']) {
                    $image = $toolImage->resize(
                        $result['image'],
                        $this->config->get($this->config->get('config_theme') . '_image_product_width'),
                        $this->config->get($this->config->get('config_theme') . '_image_product_height')
                    );
                } else {
                    $image = $toolImage->resize(
                        'placeholder.png',
                        $this->config->get($this->config->get('config_theme') . '_image_product_width'),
                        $this->config->get($this->config->get('config_theme') . '_image_product_height')
                    );
                }

                if ($this->customer->isLogged() || !$this->getConfig()->get('config_customer_price')) {
                    $price = $this->currency->format(
                        $this->tax->calculate(
                            $result['price'],
                            $result['tax_class_id'],
                            $this->config->get('config_tax')
                        ),
                        $this->session->data['currency']
                    );
                } else {
                    $price = false;
                }

                if ((float)$result['special']) {
                    $special = $this->currency->format(
                        $this->tax->calculate(
                            $result['special'],
                            $result['tax_class_id'],
                            $this->config->get('config_tax')
                        ),
                        $this->session->data['currency']
                    );
                } else {
                    $special = false;
                }

                if ($this->config->get('config_tax')) {
                    $tax = $this->currency->format(
                        (float)$result['special'] ? $result['special'] : $result['price'],
                        $this->session->data['currency']
                    );
                } else {
                    $tax = false;
                }

                $data['products'][] = array(
                    'product_id'  => $result['product_id'],
                    'thumb'       => $image,
                    'name'        => $result['name'],
                    'description' => utf8_substr(
                            strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8')),
                            0,
                            $this->config->get($this->config->get('config_theme') . '_product_description_length')
                        ) . '..',
                    'price'       => $price,
                    'special'     => $special,
                    'tax'         => $tax,
                    'minimum'     => $result['minimum'] > 0 ? $result['minimum'] : 1,
                    'rating'      => $result['rating'],
                    'href'        => $this->url->link(
                        'product/product',
                        'path=' . $this->request->get['path'] . '&product_id=' . $result['product_id'] . $url
                    )
                );
            }

            $url = '';

            if (isset($this->request->get['filter'])) {
                $url .= '&filter=' . $this->request->get['filter'];
            }

            if (isset($this->request->get['limit'])) {
                $url .= '&limit=' . $this->request->get['limit'];
            }

            $data['sorts'] = array();

            $data['sorts'][] = array(
                'text'  => $this->language->get('text_default'),
                'value' => 'p.sort_order-ASC',
                'href'  => $this->url->link(
                    'product/category',
                    'path=' . $this->request->get['path'] . '&sort=p.sort_order&order=ASC' . $url
                )
            );

            $data['sorts'][] = array(
                'text'  => $this->language->get('text_name_asc'),
                'value' => 'pd.name-ASC',
                'href'  => $this->url->link(
                    'product/category',
                    'path=' . $this->request->get['path'] . '&sort=pd.name&order=ASC' . $url
                )
            );

            $data['sorts'][] = array(
                'text'  => $this->language->get('text_name_desc'),
                'value' => 'pd.name-DESC',
                'href'  => $this->url->link(
                    'product/category',
                    'path=' . $this->request->get['path'] . '&sort=pd.name&order=DESC' . $url
                )
            );

            $data['sorts'][] = array(
                'text'  => $this->language->get('text_price_asc'),
                'value' => 'p.price-ASC',
                'href'  => $this->url->link(
                    'product/category',
                    'path=' . $this->request->get['path'] . '&sort=p.price&order=ASC' . $url
                )
            );

            $data['sorts'][] = array(
                'text'  => $this->language->get('text_price_desc'),
                'value' => 'p.price-DESC',
                'href'  => $this->url->link(
                    'product/category',
                    'path=' . $this->request->get['path'] . '&sort=p.price&order=DESC' . $url
                )
            );

            if ($this->config->get('config_review_status')) {
                $data['sorts'][] = array(
                    'text'  => $this->language->get('text_rating_desc'),
                    'value' => 'rating-DESC',
                    'href'  => $this->url->link(
                        'product/category',
                        'path=' . $this->request->get['path'] . '&sort=rating&order=DESC' . $url
                    )
                );

                $data['sorts'][] = array(
                    'text'  => $this->language->get('text_rating_asc'),
                    'value' => 'rating-ASC',
                    'href'  => $this->url->link(
                        'product/category',
                        'path=' . $this->request->get['path'] . '&sort=rating&order=ASC' . $url
                    )
                );
            }

            $data['sorts'][] = array(
                'text'  => $this->language->get('text_model_asc'),
                'value' => 'p.model-ASC',
                'href'  => $this->url->link(
                    'product/category',
                    'path=' . $this->request->get['path'] . '&sort=p.model&order=ASC' . $url
                )
            );

            $data['sorts'][] = array(
                'text'  => $this->language->get('text_model_desc'),
                'value' => 'p.model-DESC',
                'href'  => $this->url->link(
                    'product/category',
                    'path=' . $this->request->get['path'] . '&sort=p.model&order=DESC' . $url
                )
            );

            $url = '';

            if (isset($this->request->get['filter'])) {
                $url .= '&filter=' . $this->request->get['filter'];
            }

            if (isset($this->request->get['sort'])) {
                $url .= '&sort=' . $this->request->get['sort'];
            }

            if (isset($this->request->get['order'])) {
                $url .= '&order=' . $this->request->get['order'];
            }

            $data['limits'] = array();

            $limits = array_unique(
                array($this->config->get($this->config->get('config_theme') . '_product_limit'), 25, 50, 75, 100)
            );

            sort($limits);

            foreach ($limits as $value) {
                $data['limits'][] = array(
                    'text'  => $value,
                    'value' => $value,
                    'href'  => $this->url->link(
                        'product/category',
                        'path=' . $this->request->get['path'] . $url . '&limit=' . $value
                    )
                );
            }

            $url = '';

            if (isset($this->request->get['filter'])) {
                $url .= '&filter=' . $this->request->get['filter'];
            }

            if (isset($this->request->get['sort'])) {
                $url .= '&sort=' . $this->request->get['sort'];
            }

            if (isset($this->request->get['order'])) {
                $url .= '&order=' . $this->request->get['order'];
            }

            if (isset($this->request->get['limit'])) {
                $url .= '&limit=' . $this->request->get['limit'];
            }

            $pagination        = new Pagination();
            $pagination->total = $product_total;
            $pagination->page  = $page;
            $pagination->limit = $limit;
            $pagination->url   = $this->url->link(
                'product/category',
                'path=' . $this->request->get['path'] . $url . '&page={page}'
            );

            $data['pagination'] = $pagination->render();

            $data['results'] = sprintf(
                $this->language->get('text_pagination'),
                ($product_total) ? (($page - 1) * $limit) + 1 : 0,
                ((($page - 1) * $limit) > ($product_total - $limit)) ? $product_total : ((($page - 1) * $limit) + $limit),
                $product_total,
                ceil($product_total / $limit)
            );

            // http://googlewebmastercentral.blogspot.com/2011/09/pagination-with-relnext-and-relprev.html
            if ($page == 1) {
                $this->document->addLink(
                    $this->url->link('product/category', 'path=' . $category_info['category_id'], true),
                    'canonical'
                );
            } elseif ($page == 2) {
                $this->document->addLink(
                    $this->url->link('product/category', 'path=' . $category_info['category_id'], true),
                    'prev'
                );
            } else {
                $this->document->addLink(
                    $this->url->link(
                        'product/category',
                        'path=' . $category_info['category_id'] . '&page=' . ($page - 1),
                        true
                    ),
                    'prev'
                );
            }

            if ($limit && ceil($product_total / $limit) > $page) {
                $this->document->addLink(
                    $this->url->link(
                        'product/category',
                        'path=' . $category_info['category_id'] . '&page=' . ($page + 1),
                        true
                    ),
                    'next'
                );
            }

            $data['sort']  = $sort;
            $data['order'] = $order;
            $data['limit'] = $limit;

            $data['continue'] = $this->url->link('common/home');

            $this->response->setOutput(
                $this->render(
                    'catalog/category.html.twig',
                    [
                        'products'   => $products,
                        'title_page' => 'Title',
                    ]
                )
            );
        } else {
            $url = '';

            if (isset($this->request->get['path'])) {
                $url .= '&path=' . $this->request->get['path'];
            }

            if (isset($this->request->get['filter'])) {
                $url .= '&filter=' . $this->request->get['filter'];
            }

            if (isset($this->request->get['sort'])) {
                $url .= '&sort=' . $this->request->get['sort'];
            }

            if (isset($this->request->get['order'])) {
                $url .= '&order=' . $this->request->get['order'];
            }

            if (isset($this->request->get['page'])) {
                $url .= '&page=' . $this->request->get['page'];
            }

            if (isset($this->request->get['limit'])) {
                $url .= '&limit=' . $this->request->get['limit'];
            }

            $this->document->setTitle($this->language->get('text_error'));

            $data['heading_title'] = $this->language->get('text_error');

            $data['text_error'] = $this->language->get('text_error');

            $data['button_continue'] = $this->language->get('button_continue');

            $data['continue'] = $this->url->link('common/home');

            $this->response->addHeader($this->request->server['SERVER_PROTOCOL'] . ' 404 Not Found');

            $this->response->setOutput($this->load->view('error/not_found', $data));
        }
    }
}
