<?php

namespace iMega\Catalog;

class Product
{
    /**
     * @var int
     */
    protected $id = 0;
    /**
     * @var string
     */
    protected $thumb = '';
    /**
     * @var string
     */
    protected $name = '';
    /**
     * @var string
     */
    protected $description = '';
    /**
     * @var string
     */
    protected $tax = '';
    /**
     * @var string
     */
    protected $href = '';
    /**
     * @var MetaProduct
     */
    protected $meta = null;
    /**
     * @var string
     */
    protected $tag = '';
    /**
     * @var string
     */
    protected $model = '';
    /**
     * @var string
     */
    protected $sku = '';
    /**
     * @var string
     */
    protected $upc = '';
    /**
     * @var string
     */
    protected $ean = '';
    /**
     * @var string
     */
    protected $jan = '';
    /**
     * @var string
     */
    protected $isbn = '';
    /**
     * @var string
     */
    protected $mpn = '';
    /**
     * @var string
     */
    protected $location = '';
    /**
     * @var int
     */
    protected $quantity = 0;
    /**
     * @var string
     */
    protected $stockStatus = '';
    /**
     * @var string
     */
    protected $image = '';
    /**
     * @var Manufacturer
     */
    protected $manufacturer = null;
    /**
     * @var float
     */
    protected $price = 0.00;
    /**
     * @var float
     */
    protected $special = 0.00;
    /**
     * @var int
     */
    protected $reward = 0;
    /**
     * @var int
     */
    protected $points = 0;
    /**
     * @var int
     */
    protected $taxClassId = 0;
    /**
     * @var float
     */
    protected $weight = 0.00;
    /**
     * @var int
     */
    protected $weightClassId = 0;
    /**
     * @var float
     */
    protected $length = 0.00;
    /**
     * @var float
     */
    protected $width = 0.00;
    /**
     * @var float
     */
    protected $height = 0.00;
    /**
     * @var int
     */
    protected $lengthClassId = 0;
    /**
     * @var int
     */
    protected $subtract = 0;
    /**
     * @var float
     */
    protected $rating = 0.00;
    /**
     * @var int
     */
    protected $reviews = 0;
    /**
     * @var float
     */
    protected $minimum = 0.00;
    /**
     * @var int
     */
    protected $sortOrder = 0;
    /**
     * @var int
     */
    protected $status = 0;
    /**
     * @var \DateTime
     */
    protected $dateAvailable = null;
    /**
     * @var \DateTime
     */
    protected $dateAdded = null;
    /**
     * @var \DateTime
     */
    protected $dateModified = null;
    /**
     * @var int
     */
    protected $viewed = 0;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getThumb()
    {
        return $this->thumb;
    }

    /**
     * @param string $thumb
     */
    public function setThumb($thumb)
    {
        $this->thumb = $thumb;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param int $l
     *
     * @return string
     */
    public function getDescriptionShort($l)
    {
        return utf8_substr(
                strip_tags(html_entity_decode($this->description, ENT_QUOTES, 'UTF-8')),
                0,
                $l
            ) . '..';
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getTax()
    {
        return $this->tax;
    }

    /**
     * @param string $tax
     */
    public function setTax($tax)
    {
        $this->tax = $tax;
    }

    /**
     * @return string
     */
    public function getHref()
    {
        return $this->href;
    }

    /**
     * @param string $href
     */
    public function setHref($href)
    {
        $this->href = $href;
    }

    /**
     * @return MetaProduct
     */
    public function getMeta()
    {
        return $this->meta;
    }

    /**
     * @param MetaProduct $meta
     */
    public function setMeta(MetaProduct $meta)
    {
        $this->meta = $meta;
    }

    /**
     * @return string
     */
    public function getTag()
    {
        return $this->tag;
    }

    /**
     * @param string $tag
     */
    public function setTag($tag)
    {
        $this->tag = $tag;
    }

    /**
     * @return string
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * @param string $model
     */
    public function setModel($model)
    {
        $this->model = $model;
    }

    /**
     * @return string
     */
    public function getSku()
    {
        return $this->sku;
    }

    /**
     * @param string $sku
     */
    public function setSku($sku)
    {
        $this->sku = $sku;
    }

    /**
     * @return string
     */
    public function getUpc()
    {
        return $this->upc;
    }

    /**
     * @param string $upc
     */
    public function setUpc($upc)
    {
        $this->upc = $upc;
    }

    /**
     * @return string
     */
    public function getEan()
    {
        return $this->ean;
    }

    /**
     * @param string $ean
     */
    public function setEan($ean)
    {
        $this->ean = $ean;
    }

    /**
     * @return string
     */
    public function getJan()
    {
        return $this->jan;
    }

    /**
     * @param string $jan
     */
    public function setJan($jan)
    {
        $this->jan = $jan;
    }

    /**
     * @return string
     */
    public function getIsbn()
    {
        return $this->isbn;
    }

    /**
     * @param string $isbn
     */
    public function setIsbn($isbn)
    {
        $this->isbn = $isbn;
    }

    /**
     * @return string
     */
    public function getMpn()
    {
        return $this->mpn;
    }

    /**
     * @param string $mpn
     */
    public function setMpn($mpn)
    {
        $this->mpn = $mpn;
    }

    /**
     * @return string
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @param string $location
     */
    public function setLocation($location)
    {
        $this->location = $location;
    }

    /**
     * @return int
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param int $quantity
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    /**
     * @return string
     */
    public function getStockStatus()
    {
        return $this->stockStatus;
    }

    /**
     * @param string $stockStatus
     */
    public function setStockStatus($stockStatus)
    {
        $this->stockStatus = $stockStatus;
    }

    /**
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param string $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

    /**
     * @return Manufacturer
     */
    public function getManufacturer()
    {
        return $this->manufacturer;
    }

    /**
     * @param Manufacturer $manufacturer
     */
    public function setManufacturer(Manufacturer $manufacturer)
    {
        $this->manufacturer = $manufacturer;
    }

    /**
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param float $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @return float
     */
    public function getSpecial()
    {
        return $this->special;
    }

    /**
     * @param float $special
     */
    public function setSpecial($special)
    {
        $this->special = $special;
    }

    /**
     * @return int
     */
    public function getReward()
    {
        return $this->reward;
    }

    /**
     * @param int $reward
     */
    public function setReward($reward)
    {
        $this->reward = $reward;
    }

    /**
     * @return int
     */
    public function getPoints()
    {
        return $this->points;
    }

    /**
     * @param int $points
     */
    public function setPoints($points)
    {
        $this->points = $points;
    }

    /**
     * @return int
     */
    public function getTaxClassId()
    {
        return $this->taxClassId;
    }

    /**
     * @param int $taxClassId
     */
    public function setTaxClassId($taxClassId)
    {
        $this->taxClassId = $taxClassId;
    }

    /**
     * @return float
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * @param float $weight
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;
    }

    /**
     * @return int
     */
    public function getWeightClassId()
    {
        return $this->weightClassId;
    }

    /**
     * @param int $weightClassId
     */
    public function setWeightClassId($weightClassId)
    {
        $this->weightClassId = $weightClassId;
    }

    /**
     * @return float
     */
    public function getLength()
    {
        return $this->length;
    }

    /**
     * @param float $length
     */
    public function setLength($length)
    {
        $this->length = $length;
    }

    /**
     * @return float
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * @param float $width
     */
    public function setWidth($width)
    {
        $this->width = $width;
    }

    /**
     * @return float
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * @param float $height
     */
    public function setHeight($height)
    {
        $this->height = $height;
    }

    /**
     * @return int
     */
    public function getLengthClassId()
    {
        return $this->lengthClassId;
    }

    /**
     * @param int $lengthClassId
     */
    public function setLengthClassId($lengthClassId)
    {
        $this->lengthClassId = $lengthClassId;
    }

    /**
     * @return int
     */
    public function getSubtract()
    {
        return $this->subtract;
    }

    /**
     * @param int $subtract
     */
    public function setSubtract($subtract)
    {
        $this->subtract = $subtract;
    }

    /**
     * @return float
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * @param float $rating
     */
    public function setRating($rating)
    {
        $this->rating = $rating;
    }

    /**
     * @return int
     */
    public function getReviews()
    {
        return $this->reviews;
    }

    /**
     * @param int $reviews
     */
    public function setReviews($reviews)
    {
        $this->reviews = $reviews;
    }

    /**
     * @return float
     */
    public function getMinimum()
    {
        return $this->minimum;
    }

    /**
     * @param float $minimum
     */
    public function setMinimum($minimum)
    {
        $this->minimum = $minimum;
    }

    /**
     * @return int
     */
    public function getSortOrder()
    {
        return $this->sortOrder;
    }

    /**
     * @param int $sortOrder
     */
    public function setSortOrder($sortOrder)
    {
        $this->sortOrder = $sortOrder;
    }

    /**
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param int $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return \DateTime
     */
    public function getDateAvailable()
    {
        return $this->dateAvailable;
    }

    /**
     * @param \DateTime $dateAvailable
     */
    public function setDateAvailable(\DateTime $dateAvailable)
    {
        $this->dateAvailable = $dateAvailable;
    }

    /**
     * @return \DateTime
     */
    public function getDateAdded()
    {
        return $this->dateAdded;
    }

    /**
     * @param \DateTime $dateAdded
     */
    public function setDateAdded(\DateTime $dateAdded)
    {
        $this->dateAdded = $dateAdded;
    }

    /**
     * @return \DateTime
     */
    public function getDateModified()
    {
        return $this->dateModified;
    }

    /**
     * @param \DateTime $dateModified
     */
    public function setDateModified(\DateTime $dateModified)
    {
        $this->dateModified = $dateModified;
    }

    /**
     * @return int
     */
    public function getViewed()
    {
        return $this->viewed;
    }

    /**
     * @param int $viewed
     */
    public function setViewed($viewed)
    {
        $this->viewed = $viewed;
    }
}
