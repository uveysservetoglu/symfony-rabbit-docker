<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProductRepository")
 */
class Product
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantity;

    /**
     * @ORM\Column(type="decimal", length=6, nullable=false)
     */
    private $price;

    /**
     * @ORM\Column(type="decimal", length=6, nullable=true)
     */
    private $discount_price;

    /**
     * @ORM\Column(type="string", length=155)
     */
    private $sku;

    /**
     * @ORM\Column(type="decimal", length=6, nullable=false)
     */
    private $localizations;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice($price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getDiscountPrice()
    {
        return $this->discount_price;
    }

    public function setDiscountPrice($discount_price): self
    {
        $this->discount_price = $discount_price;

        return $this;
    }

    public function getSku(): ?string
    {
        return $this->sku;
    }

    public function setSku(string $sku): self
    {
        $this->sku = $sku;

        return $this;
    }

    public function getLocalizations(): ?string
    {
        return $this->localizations;
    }

    public function setLocalizations(string $localizations): self
    {
        $this->localizations = $localizations;

        return $this;
    }
}
