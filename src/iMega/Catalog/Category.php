<?php

namespace iMega\Catalog;

class Category
{
    /**
     * @var int
     */
    private $id;
    /**
     * @var string
     */
    private $image;
    /**
     * @var int
     */
    private $parentId;
    /**
     * @var int
     */
    private $top;
    /**
     * @var int
     */
    private $column;
    /**
     * @var int
     */
    private $sortOrder;
    /**
     * @var int
     */
    private $status;
    /**
     * @var \DateTime
     */
    private $dateAdded;
    /**
     * @var \DateTime
     */
    private $dateModified;
    /**
     * @var int
     */
    private $languageId;
    /**
     * @var string
     */
    private $name;
    /**
     * @var string
     */
    private $description;
    /**
     * @var MetaData
     */
    private $meta;
    /**
     * @var int
     */
    private $storeId;

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
     * @return int
     */
    public function getParentId()
    {
        return $this->parentId;
    }

    /**
     * @param int $parentId
     */
    public function setParentId($parentId)
    {
        $this->parentId = $parentId;
    }

    /**
     * @return int
     */
    public function getTop()
    {
        return $this->top;
    }

    /**
     * @param int $top
     */
    public function setTop($top)
    {
        $this->top = $top;
    }

    /**
     * @return int
     */
    public function getColumn()
    {
        return $this->column;
    }

    /**
     * @param int $column
     */
    public function setColumn($column)
    {
        $this->column = $column;
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
    public function getDateAdded()
    {
        return $this->dateAdded;
    }

    /**
     * @param \DateTime $dateAdded
     */
    public function setDateAdded($dateAdded)
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
    public function setDateModified($dateModified)
    {
        $this->dateModified = $dateModified;
    }

    /**
     * @return int
     */
    public function getLanguageId()
    {
        return $this->languageId;
    }

    /**
     * @param int $languageId
     */
    public function setLanguageId($languageId)
    {
        $this->languageId = $languageId;
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
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return MetaData
     */
    public function getMeta()
    {
        return $this->meta;
    }

    /**
     * @param MetaData $meta
     */
    public function setMeta($meta)
    {
        $this->meta = $meta;
    }

    /**
     * @return int
     */
    public function getStoreId()
    {
        return $this->storeId;
    }

    /**
     * @param int $storeId
     */
    public function setStoreId($storeId)
    {
        $this->storeId = $storeId;
    }
}
