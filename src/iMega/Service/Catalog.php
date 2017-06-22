<?php

namespace iMega\Service;

use iMega\Catalog\Manufacturer;
use iMega\Catalog\MetaProduct;
use iMega\Catalog\Product;
use \Registry;
use iMega\Catalog\Filter;
use iMega\LoaderInterface;

class Catalog
{
    /**
     * @var LoaderInterface
     */
    private $loader;
    /**
     * @var Registry
     */
    private $registry;
    /**
     * @var int
     */
    private $descriptionLength = 0;

    /**
     * Catalog constructor.
     *
     * @param Registry $registry
     * @param          $loader
     */
    public function __construct(Registry $registry, $loader)
    {
        $this->loader   = $loader;
        $this->registry = $registry;
    }

    /**
     * @param Filter $f
     *
     * @return array []Product
     */
    public function getProducts(Filter $f)
    {
        $catalogProduct = new \ModelCatalogProduct($this->registry);
        $items          = $catalogProduct->getProducts(
            [
                'filter_category_id' => $f->getCategoryId(),
                'filter_filter'      => $f->getFilter(),
                'sort'               => $f->getSort(),
                'order'              => $f->getOrder(),
                'start'              => $f->getStart(),
                'limit'              => $f->getLimit(),
            ]
        );

        $toolImage = new \ModelToolImage($this->registry);

        $ret = [];
        foreach ($items as $item) {
            $m = new Manufacturer();
            $m->setId($item['manufacturer_id']);
            $m->setName($item['manufacturer']);

            $meta = new MetaProduct();
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
            //$p->setDateAvailable($item['date_available']);
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
            //$p->setDateAdded($item['date_added']);
            //$p->setDateModified($item['date_modified']);
            $p->setViewed($item['viewed']);

            $ret[] = $p;
        }

        return $ret;
    }

    /**
     * @param array $products
     *
     * @return string
     */
    public function render(array $products)
    {
        $raw = '';
        $toolImage = new \ModelToolImage($this->registry);
        foreach ($products as $product) {
            $raw .= $this->loader->view(
                'catalog/cart',
                [
                    'product'           => $product,
                    'descriptionLength' => $this->getDescriptionLength(),
                    'config'            => $this->registry->get('config'),
                    'resizer'           => $toolImage,
                ]
            );
        }

        return $this->loader->view(
            'catalog/catalog',
            [
                'heading_title' => '',
                'products'      => $raw
            ]
        );
    }

    /**
     * @return int
     */
    public function getDescriptionLength()
    {
        return $this->descriptionLength;
    }

    /**
     * @param int $descriptionLength
     */
    public function setDescriptionLength($descriptionLength)
    {
        $this->descriptionLength = $descriptionLength;
    }
}
