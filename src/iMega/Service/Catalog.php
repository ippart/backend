<?php

namespace iMega\Service;

use iMega\Catalog\Category;
use iMega\Catalog\Manufacturer;
use iMega\Catalog\MetaData;
use iMega\Catalog\Product;
use iMega\Service;
use Pimple\Container;
use \Registry;
use iMega\Catalog\Filter;
use iMega\LoaderInterface;

class Catalog
{
    /**
     * @var Container
     */
    private $c;

    /**
     * Catalog constructor.
     *
     * @param Container $c
     */
    public function __construct(Container $c)
    {
        $this->c = $c;
    }

    /**
     * @param Filter $f
     *
     * @return array []Product
     */
    public function getProducts(Filter $f)
    {
        $catalogProduct = new \ModelCatalogProduct($this->c->offsetGet(Service::REGISTRY));

        $items = $catalogProduct->getProducts(
            [
                'filter_category_id' => $f->getCategoryId(),
                'filter_filter'      => $f->getFilter(),
                'sort'               => $f->getSort(),
                'order'              => $f->getOrder(),
                'start'              => $f->getStart(),
                'limit'              => $f->getLimit(),
            ]
        );

        $ret = [];
        foreach ($items as $item) {
            $m = new Manufacturer();
            $m->setId($item['manufacturer_id']);
            $m->setName($item['manufacturer']);

            $meta = new MetaData();
            $meta->setTitle($item['meta_title']);
            $meta->setDescription($item['meta_description']);
            $meta->setKeyword($item['meta_keyword']);

            $p = new Product();
            $p->setId($item['product_id']);
            $p->setName($item['name']);
            $p->setDescription($item['description']);
            $p->setTag($item['tag']);
            $p->setModel($item['model']);
            $p->setSku($item['sku']);
            $p->setUpc($item['upc']);
            $p->setEan($item['ean']);
            $p->setJan($item['jan']);
            $p->setIsbn($item['isbn']);
            $p->setMpn($item['mpn']);
            $p->setLocation($item['location']);
            $p->setQuantity($item['quantity']);
            $p->setStockStatus($item['stock_status']);
            $p->setImage($item['image']);
            $p->setManufacturer($m);
            $p->setMeta($meta);
            $p->setPrice($item['price']);
            $p->setSpecial($item['special']);
            $p->setReward($item['reward']);
            $p->setPoints($item['points']);
            $p->setTaxClassId($item['tax_class_id']);
            $date = date_create_from_format('Y-m-d H:i:s', $item['date_available']);
            if (false !== $date) {
                $p->setDateAvailable($date);
            }
            $p->setWeight($item['weight']);
            $p->setWeightClassId($item['weight_class_id']);
            $p->setLength($item['length']);
            $p->setWidth($item['width']);
            $p->setHeight($item['height']);
            $p->setLengthClassId($item['length_class_id']);
            $p->setSubtract($item['subtract']);
            $p->setRating($item['rating']);
            $p->setReviews($item['reviews']);
            $p->setMinimum($item['minimum']);
            $p->setSortOrder($item['sort_order']);
            $p->setStatus($item['status']);
            $date = date_create_from_format('Y-m-d H:i:s', $item['date_added']);
            if (false !== $date) {
                $p->setDateAdded($date);
            }
            $date = date_create_from_format('Y-m-d H:i:s', $item['date_modified']);
            if (false !== $date) {
                $p->setDateModified($date);
            }
            $p->setViewed($item['viewed']);

            $ret[] = $p;
        }

        return $ret;
    }

    /**
     * @param int $id
     *
     * @return Product|null
     */
    public function getProduct($id)
    {
        if (!is_int($id) || $id == 0) {
            return null;
        }

        $item = (new \ModelCatalogProduct($this->c->offsetGet(Service::REGISTRY)))->getProduct($id);

        $m = new Manufacturer();
        $m->setId($item['manufacturer_id']);
        $m->setName($item['manufacturer']);

        $meta = new MetaData();
        $meta->setTitle($item['meta_title']);
        $meta->setDescription($item['meta_description']);
        $meta->setKeyword($item['meta_keyword']);

        $p = new Product();
        $p->setId($item['product_id']);
        $p->setName($item['name']);
        $p->setDescription($item['description']);
        $p->setTag($item['tag']);
        $p->setModel($item['model']);
        $p->setSku($item['sku']);
        $p->setUpc($item['upc']);
        $p->setEan($item['ean']);
        $p->setJan($item['jan']);
        $p->setIsbn($item['isbn']);
        $p->setMpn($item['mpn']);
        $p->setLocation($item['location']);
        $p->setQuantity($item['quantity']);
        $p->setStockStatus($item['stock_status']);
        $p->setImage($item['image']);
        $p->setManufacturer($m);
        $p->setMeta($meta);
        $p->setPrice($item['price']);
        $p->setSpecial($item['special']);
        $p->setReward($item['reward']);
        $p->setPoints($item['points']);
        $p->setTaxClassId($item['tax_class_id']);
        $p->setWeight($item['weight']);
        $p->setWeightClassId($item['weight_class_id']);
        $p->setLength($item['length']);
        $p->setWidth($item['width']);
        $p->setHeight($item['height']);
        $p->setLengthClassId($item['length_class_id']);
        $p->setSubtract($item['subtract']);
        $p->setRating($item['rating']);
        $p->setReviews($item['reviews']);
        $p->setMinimum($item['minimum']);
        $p->setSortOrder($item['sort_order']);
        $p->setStatus($item['status']);
        $p->setViewed($item['viewed']);

        $date = date_create_from_format('Y-m-d H:i:s', $item['date_available']);
        if (false !== $date) {
            $p->setDateAvailable($date);
        }
        $date = date_create_from_format('Y-m-d H:i:s', $item['date_added']);
        if (false !== $date) {
            $p->setDateAdded($date);
        }
        $date = date_create_from_format('Y-m-d H:i:s', $item['date_modified']);
        if (false !== $date) {
            $p->setDateModified($date);
        }

        return $p;
    }

    /**
     * @return Category
     */
    public function getCurrentCategory()
    {
        $categoryId = 0;
        /**
         * @var \Request $r
         */
        $r = $this->c->offsetGet(Service::REQUEST);
        if (isset($r->get['path'])) {
            $parts      = explode('_', (string) $r->get['path']);
            $categoryId = (int) array_shift($parts);
        }
        $c = $this->getCategory($categoryId);
        if (null !== $c) {
            return $c;
        }

        return new Category();
    }

    /**
     * @param $id
     *
     * @return Category|null
     */
    public function getCategory($id)
    {
        if (!is_int($id) || $id == 0) {
            return null;
        }

        $m = new \ModelCatalogCategory($this->c->offsetGet(Service::REGISTRY));

        $data = $m->getCategory((int) $id);

        $meta = new MetaData();
        $meta->setTitle($data['meta_title']);
        $meta->setDescription($data['meta_description']);
        $meta->setKeyword($data['meta_keyword']);

        $c = new Category();
        $c->setId($data['category_id']);
        $c->setImage($data['image']);
        $c->setParentId($data['parent_id']);
        $c->setTop($data['top']);
        $c->setColumn($data['column']);
        $c->setSortOrder($data['sort_order']);
        $c->setStatus($data['status']);
        $c->setDateAdded(date_create_from_format('Y-m-d H:i:s', $data['date_added']));
        $c->setDateModified(date_create_from_format('Y-m-d H:i:s', $data['date_modified']));
        $c->setLanguageId($data['language_id']);
        $c->setName($data['name']);
        $c->setDescription($data['description']);
        $c->setStoreId($data['store_id']);
        $c->setMeta($meta);

        return $c;
    }

    public function getCategories($id)
    {
        $c          = new \ModelCatalogCategory($this->c->offsetGet(Service::REGISTRY));
        $categories = $c->getCategories(0);

        $ret = [];

        foreach ($categories as $category) {
            if ($category['top']) {
                // Level 2
                $children_data = [];

                $children = $c->getCategories($category['category_id']);
                foreach ($children as $child) {
                    $children_data[] = [
                        'id'   => $child['category_id'],
                        'name' => $child['name'],
                    ];
                }

                // Level 1
                $ret[] = [
                    'name'     => $category['name'],
                    'id'       => $category['category_id'],
                    'children' => $children_data,
                    'column'   => $category['column'] ? $category['column'] : 1,
                ];
            }
        }

        return $ret;
    }

    /**
     * @param array $products
     *
     * @return string
     */
    public function renderProducts(array $products)
    {
        /**
         * @var \Twig_Environment $render
         */
        $render = $this->c->offsetGet(Service::RENDER);
        $raw    = '';

        foreach ($products as $product) {
            $raw .= $render->render('catalog/product/card.html.twig', ['product' => $product]);
        }

        return $raw;
    }

    public function renderProduct(Product $product)
    {
        /**
         * @var \Twig_Environment $render
         */
        $render = $this->c->offsetGet(Service::RENDER);

        return $render->render('catalog/product/detail.html.twig', ['product' => $product]);
    }
}
