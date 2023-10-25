<?php

namespace App\Entity;

use App\Repository\BillRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BillRepository::class)
 */
class Bill
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Customer::class, inversedBy="bills")
     */
    private $Customer;

    /**
     * @ORM\Column(type="datetime")
     */
    private $Date;

    /**
     * @ORM\Column(type="integer")
     */
    private $TableNumber;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $Total;

    /**
     * @ORM\OneToMany(targetEntity=OrderFood::class, mappedBy="Bill")
     */
    private $orderFood;

    public function __construct()
    {
        $this->orderFood = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCustomer()
    {
        return $this->Customer;
    }

    public function setCustomer(?Customer $Customer): self
    {
        $this->Customer = $Customer;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->Date;
    }

    public function setDate(\DateTimeInterface $Date): self
    {
        $this->Date = $Date;

        return $this;
    }

    public function getTableNumber(): ?int
    {
        return $this->TableNumber;
    }

    public function setTableNumber(int $TableNumber): self
    {
        $this->TableNumber = $TableNumber;

        return $this;
    }

    public function getTotal(): ?int
    {
        return $this->Total;
    }

    public function setTotal(?int $Total): self
    {
        $this->Total = $Total;

        return $this;
    }

    public function __toString()
    {
        return (string) $this->id;
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
            $orderFood->setBill($this);
        }

        return $this;
    }

    public function removeOrderFood(OrderFood $orderFood): self
    {
        if ($this->orderFood->removeElement($orderFood)) {
            // set the owning side to null (unless already changed)
            if ($orderFood->getBill() === $this) {
                $orderFood->setBill(null);
            }
        }

        return $this;
    }
}
