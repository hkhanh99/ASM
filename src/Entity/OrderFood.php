<?php

namespace App\Entity;

use App\Repository\OrderFoodRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OrderFoodRepository::class)
 */
class OrderFood
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Bill::class, inversedBy="orderFood")
     */
    private $Bill;

    /**
     * @ORM\ManyToOne(targetEntity=Food::class, inversedBy="orderFood")
     */
    private $Food;

    /**
     * @ORM\Column(type="datetime")
     */
    private $OrderDate;

    /**
     * @ORM\Column(type="integer")
     */
    private $Quantity;

    /**
     * @ORM\Column(type="integer")
     */
    private $OrderPrice;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBill(): ?Bill
    {
        return $this->Bill;
    }

    public function setBill(?Bill $Bill): self
    {
        $this->Bill = $Bill;

        return $this;
    }

    public function getFood(): ?Food
    {
        return $this->Food;
    }

    public function setFood(?Food $Food): self
    {
        $this->Food = $Food;

        return $this;
    }

    public function getOrderDate(): ?\DateTimeInterface
    {
        return $this->OrderDate;
    }

    public function setOrderDate(\DateTimeInterface $OrderDate): self
    {
        $this->OrderDate = $OrderDate;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->Quantity;
    }

    public function setQuantity(int $Quantity): self
    {
        $this->Quantity = $Quantity;

        return $this;
    }

    public function getOrderPrice(): ?int
    {
        return $this->OrderPrice;
    }

    public function setOrderPrice(int $OrderPrice): self
    {
        $this->OrderPrice = $OrderPrice;

        return $this;
    }
}
