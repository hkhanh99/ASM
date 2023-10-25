<?php

namespace App\Entity;

use App\Repository\FoodRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FoodRepository::class)
 */
class Food
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Name;

    /**
     * @ORM\ManyToMany(targetEntity=Chef::class, inversedBy="food")
     */
    private $Chef;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Category;

    /**
     * @ORM\Column(type="integer")
     */
    private $UnitPrice;

    /**
     * @ORM\OneToMany(targetEntity=OrderFood::class, mappedBy="Food")
     */
    private $orderFood;

    public function __construct()
    {
        $this->Chef = new ArrayCollection();
        $this->orderFood = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): self
    {
        $this->Name = $Name;

        return $this;
    }

    /**
     * @return Collection<int, Chef>
     */
    public function getChef(): Collection
    {
        return $this->Chef;
    }

    public function addChef(Chef $chef): self
    {
        if (!$this->Chef->contains($chef)) {
            $this->Chef[] = $chef;
        }

        return $this;
    }

    public function removeChef(Chef $chef): self
    {
        $this->Chef->removeElement($chef);

        return $this;
    }

    public function getCategory(): ?string
    {
        return $this->Category;
    }

    public function setCategory(string $Category): self
    {
        $this->Category = $Category;

        return $this;
    }

    public function getUnitPrice(): ?int
    {
        return $this->UnitPrice;
    }

    public function setUnitPrice(int $UnitPrice): self
    {
        $this->UnitPrice = $UnitPrice;

        return $this;
    }
    public function __toString()
    {
        return $this->Name;
    }

    /**
     * @return Collection<int, OrderFood>
     */
    public function getOrderFood(): Collection
    {
        return $this->orderFood;
    }

    public function addOrderFood(OrderFood $orderFood): self
    {
        if (!$this->orderFood->contains($orderFood)) {
            $this->orderFood[] = $orderFood;
            $orderFood->setFood($this);
        }

        return $this;
    }

    public function removeOrderFood(OrderFood $orderFood): self
    {
        if ($this->orderFood->removeElement($orderFood)) {
            // set the owning side to null (unless already changed)
            if ($orderFood->getFood() === $this) {
                $orderFood->setFood(null);
            }
        }

        return $this;
    }
}
