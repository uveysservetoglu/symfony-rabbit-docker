<?php

namespace App\Object;


class Product
{

    private $id;

    private $quantity;

    private $price;

    private $discount_price;

    private $sku;

    private $name;

    private $url_key;

    private $canonical;

    private $description;

    private $meta_keywords;

    private $meta_description;


    public function __construct($data=[])
    {

        if(!is_array($data) && !is_object($data)) return;
        foreach ($data as $index => $value)
        {
            if(property_exists($this,$index))
                $this->{"set".ucfirst($index)}($value);
        }

        $this->getConvertObject();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param mixed $quantity
     */
    public function setQuantity($quantity): void
    {
        $this->quantity = $quantity;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price): void
    {
        $this->price = $price;
    }

    /**
     * @return mixed
     */
    public function getDiscountPrice()
    {
        return $this->discount_price;
    }

    /**
     * @param mixed $discount_price
     */
    public function setDiscountPrice($discount_price): void
    {
        $this->discount_price = $discount_price;
    }

    /**
     * @return mixed
     */
    public function getSku()
    {
        return $this->sku;
    }

    /**
     * @param mixed $sku
     */
    public function setSku($sku): void
    {
        $this->sku = $sku;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getUrlKey()
    {
        return $this->url_key;
    }

    /**
     * @param mixed $url_key
     */
    public function setUrlKey($url_key): void
    {
        $this->url_key = $url_key;
    }

    /**
     * @return mixed
     */
    public function getCanonical()
    {
        return $this->canonical;
    }

    /**
     * @param mixed $canonical
     */
    public function setCanonical($canonical): void
    {
        $this->canonical = $canonical;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description): void
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getMetaKeywords()
    {
        return $this->meta_keywords;
    }

    /**
     * @param mixed $meta_keywords
     */
    public function setMetaKeywords($meta_keywords): void
    {
        $this->meta_keywords = $meta_keywords;
    }

    /**
     * @return mixed
     */
    public function getMetaDescription()
    {
        return $this->meta_description;
    }

    /**
     * @param mixed $meta_description
     */
    public function setMetaDescription($meta_description): void
    {
        $this->meta_description = $meta_description;
    }


    public function getConvertObject(){

        $object = new \stdClass();

        $object->id             = $this->getId();
        $object->quantity       = $this->getQuantity();
        $object->price          = $this->getPrice();
        $object->discount_price = $this->getDiscountPrice();
        $object->sku            = $this->getSku();
        $object->url_key        = $this->getUrlKey();
        $object->canonical      = $this->getCanonical();
        $object->description    = $this->getDescription();
        $this->meta_keywords    = $this->getMetaKeywords();
        $this->meta_description = $this->getMetaDescription();

        return $object;
    }



}
