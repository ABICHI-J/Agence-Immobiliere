<?php

namespace App\Entity;

use App\Repository\AnnoncesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AnnoncesRepository::class)]
class Annonces
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;


    #[ORM\Column(length:255)]
    private ?string $agency = null;

    
    #[ORM\Column(length: 255)]
    private ?string $type = null;

    
    #[ORM\Column(length: 255)]
    private ?string $surface = null;

    
    #[ORM\Column(length: 255)]
    private ?string $rooms = null;


    #[ORM\Column(length: 255)]
    private ?string $bedrooms = null;


    #[ORM\Column(length: 255)]
    private ?string $furnished = null;


    #[ORM\Column(length: 255)]
    private ?string $floor = null;


    #[ORM\Column(length: 255, nullable: true)]
    private ?string $balcony = null;


    #[ORM\Column(length:255, nullable: true)]
    private ?string $patio = null;


    #[ORM\Column(length: 255, nullable: true)]
    private ?string $lift = null;


    #[ORM\Column(length: 255)]
    private ?int $price = null;


    #[ORM\Column(length: 255)]
    private ?string $guarantee = null;


    #[ORM\Column(length: 255)]
    private ?string $description = null;


    #[ORM\Column(length: 255)]
    private ?string $image = null;


     #[ORM\Column(length: 255)]
    private ?string $address = null;


    #[ORM\Column(length: 255)]
    private ?string $nickname = null;


    #[ORM\Column(length: 255)]
    private ?string $phone = null;
    

    #[ORM\Column(length:255, nullable: true)]
    private ?string $slug = null;


    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;


    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\OneToMany(mappedBy: 'Annonces', targetEntity: Favorites::class)]
    private Collection $favorites;

   
    public function __construct() {
        $this->updatedAt = new \DateTimeImmutable('Europe/Paris');
        $this->createdAt = new \DateTimeImmutable('Europe/Paris');
        $this->favorites = new ArrayCollection();

    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getAgency(): ?string
    {
        return $this->agency;
    }
    public function setAgency(string $agency): self
    {
        $this->agency = $agency;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }
    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getSurface(): ?string
    {
        return $this->surface;
    }
    public function setSurface(string $surface): self
    {
        $this->surface = $surface;

        return $this;
    }

    public function getRooms(): ?string
    {
        return $this->rooms;
    }
    public function setRooms(string $rooms): self
    {
        $this->rooms = $rooms;

        return $this;
    }

    public function getBedrooms(): ?string
    {
        return $this->bedrooms;
    }
    public function setBedrooms(string $bedrooms): self
    {
        $this->bedrooms = $bedrooms;

        return $this;
    }

    public function getFurnished(): ?string
    {
        return $this->furnished;
    }
    public function setFurnished(string $furnished): self
    {
        $this->furnished = $furnished;

        return $this;
    }

    public function getFloor(): ?string
    {
        return $this->floor;
    }
    public function setFloor(string $floor): self
    {
        $this->floor = $floor;

        return $this;
    }

    public function getBalcony(): ?string
    {
        return $this->balcony;
    }
    public function setBalcony(string $balcony): self
    {
        $this->balcony = $balcony;

        return $this;
    }
    public function getPatio(): ?string
    {
        return $this->patio;
    }

    public function setPatio(string $patio): self
    {
        $this->patio = $patio;

        return $this;
    }
    public function getLift(): ?string
    {
        return $this->lift;
    }
    public function setLift(string $lift): self
    {
        $this->lift = $lift;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }
    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getGuarantee(): ?string
    {
        return $this->guarantee;
    }
    public function setGuarantee(string $guarantee): self
    {
        $this->guarantee = $guarantee;

        return $this;
    }

    

    public function getDescription(): ?string
    {
        return $this->description;
    }
    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }
    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }
    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getNickname(): ?string
    {
        return $this->nickname;
    }
    public function setNickname(string $nickname): self
    {
        $this->nickname = $nickname;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }
    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }
    
    public function getSlug(): ?string
    {
        return $this->slug;
    }
    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }
    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }
    public function setUpdatedAt(?\DateTimeImmutable $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * @return Collection<int, Favorites>
     */
    public function getFavorites(): Collection
    {
        return $this->favorites;
    }

    public function addFavorite(Favorites $favorite): self
    {
        if (!$this->favorites->contains($favorite)) {
            $this->favorites->add($favorite);
            $favorite->setAnnonces($this);
        }

        return $this;
    }

    public function removeFavorite(Favorites $favorite): self
    {
        if ($this->favorites->removeElement($favorite)) {
            // set the owning side to null (unless already changed)
            if ($favorite->getAnnonces() === $this) {
                $favorite->setAnnonces(null);
            }
        }

        return $this;
    }

    
}