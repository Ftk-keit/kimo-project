<?php

namespace App\Entity;

use App\Enums\StatusProperty;
use App\Enums\TypeProperty;
use App\Enums\TypeTransaction;
use App\Repository\PropertyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PropertyRepository::class)]
class Property
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private string $Title;

    #[ORM\Column(enumType: TypeProperty::class)]
    private TypeProperty $type;

   #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    private string $price;


    #[ORM\Column(type: Types::INTEGER)]
    private int $views;

    #[ORM\Column(enumType: StatusProperty::class)]
    private StatusProperty $status;

    #[ORM\Column(length: 255)]
    private string $Description;

    #[ORM\Column(type: Types::INTEGER)]
    private int $bedroom;

    #[ORM\Column(type: Types::INTEGER)]
    private int $bathroom;

    #[ORM\Column(type: Types::STRING, length: 50)]
    private string $surface;

    #[ORM\Column]
    private array $characteristic = [];

    #[ORM\Column(length: 255)]
    private string $media;

    #[ORM\Column(enumType: TypeTransaction::class)]
    private TypeTransaction $typeTransaction;

    #[ORM\Column(length: 255)]
    private string $location;

    #[ORM\Column(length: 50)]
    private string $city;

    #[ORM\ManyToOne(inversedBy: 'property')]
    private ?Transaction $transaction = null;

    /**
     * @var Collection<int, Transaction>
     */
    #[ORM\OneToMany(targetEntity: Transaction::class, mappedBy: 'property')]
    private Collection $transactions;

    #[ORM\ManyToOne(inversedBy: 'property')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $owner = null;

    /**
     * @var Collection<int, Visit>
     */
    #[ORM\OneToMany(targetEntity: Visit::class, mappedBy: 'property')]
    private Collection $visits;

    public function __construct()
    {
        $this->transactions = new ArrayCollection();
        $this->visits = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->Title;
    }

    public function setTitle(string $Title): static
    {
        $this->Title = $Title;

        return $this;
    }

    public function getType(): TypeProperty
    {
        return $this->type;
    }

    public function setType(TypeProperty $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getPrice(): string
    {
        return $this->price;
    }

    public function setPrice(string $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getViews(): int
    {
        return $this->views;
    }

    public function setViews(int $views): static
    {
        $this->views = $views;

        return $this;
    }

    public function getStatus(): StatusProperty
    {
        return $this->status;
    }

    public function setStatus(StatusProperty $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getDescription(): string
    {
        return $this->Description;
    }

    public function setDescription(string $Description): static
    {
        $this->Description = $Description;

        return $this;
    }

    public function getBedroom(): int
    {
        return $this->bedroom;
    }

    public function setBedroom(int $bedroom): static
    {
        $this->bedroom = $bedroom;

        return $this;
    }

    public function getBathroom(): int
    {
        return $this->bathroom;
    }

    public function setBathroom(int $bathroom): static
    {
        $this->bathroom = $bathroom;

        return $this;
    }

    public function getSurface(): string
    {
        return $this->surface;
    }

    public function setSurface(string $surface): static
    {
        $this->surface = $surface;

        return $this;
    }

    public function getCharacteristic(): array
    {
        return $this->characteristic;
    }

    public function setCharacteristic(array $characteristic): static
    {
        $this->characteristic = $characteristic;

        return $this;
    }

    public function getMedia(): string
    {
        return $this->media;
    }

    public function setMedia(string $media): static
    {
        $this->media = $media;

        return $this;
    }

    public function getTypeTransaction(): TypeTransaction
    {
        return $this->typeTransaction;
    }

    public function setTypeTransaction(TypeTransaction $typeTransaction): static
    {
        $this->typeTransaction = $typeTransaction;

        return $this;
    }

    public function getLocation(): string
    {
        return $this->location;
    }

    public function setLocation(string $location): static
    {
        $this->location = $location;

        return $this;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function setCity(string $city): static
    {
        $this->city = $city;

        return $this;
    }

    public function getTransaction(): ?Transaction
    {
        return $this->transaction;
    }

    public function setTransaction(?Transaction $transaction): static
    {
        $this->transaction = $transaction;

        return $this;
    }

    /**
     * @return Collection<int, Transaction>
     */
    public function getTransactions(): Collection
    {
        return $this->transactions;
    }

    public function addTransaction(Transaction $transaction): static
    {
        if (!$this->transactions->contains($transaction)) {
            $this->transactions->add($transaction);
            $transaction->setProperty($this);
        }

        return $this;
    }

    public function removeTransaction(Transaction $transaction): static
    {
        if ($this->transactions->removeElement($transaction)) {
            // set the owning side to null (unless already changed)
            if ($transaction->getProperty() === $this) {
                $transaction->setProperty(null);
            }
        }

        return $this;
    }

    public function getOwner(): ?User
    {
        return $this->owner;
    }

    public function setOwner(?User $owner): static
    {
        $this->owner = $owner;

        return $this;
    }

    /**
     * @return Collection<int, Visit>
     */
    public function getVisits(): Collection
    {
        return $this->visits;
    }

    public function addVisit(Visit $visit): static
    {
        if (!$this->visits->contains($visit)) {
            $this->visits->add($visit);
            $visit->setProperty($this);
        }

        return $this;
    }

    public function removeVisit(Visit $visit): static
    {
        if ($this->visits->removeElement($visit)) {
            // set the owning side to null (unless already changed)
            if ($visit->getProperty() === $this) {
                $visit->setProperty(null);
            }
        }

        return $this;
    }
}
