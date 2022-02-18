<?php

namespace App\Entity;

use App\Repository\GenreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GenreRepository::class)
 */
class Genre
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"get_profiles_collection"})
     * @Groups({"get_genres_collection"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     * @Groups({"create_profiles_item"})
     * @Groups({"get_profiles_collection"})
     * @Groups({"get_genres_collection"})
     * @Groups({"get_products_collection"})
     */
    private $label;

    /**
     * @ORM\OneToMany(targetEntity=Profiles::class, mappedBy="genre", orphanRemoval=true)
     */
    private $profiles;

    /**
     * @ORM\OneToMany(targetEntity=Product::class, mappedBy="genre", orphanRemoval=true)
     */
    private $products;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     * @Groups({"get_genres_collection"})
     */
    private $value;

    public function __construct()
    {
        $this->profiles = new ArrayCollection();
        $this->products = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): self
    {
        $this->label = $label;

        return $this;
    }

    /**
     * @return Collection|Profiles[]
     */
    public function getProfiles(): Collection
    {
        return $this->profiles;
    }

    /**
     * @param Profiles $Profile
     * @return $this
     */
    public function addProfile(Profiles $profile): self
    {
        if (!$this->profiles->contains($profile)) {
            $this->profiles[] = $profile;
            $profile->setGenre($this);
        }

        return $this;
    }

    /**
     * @param Profiles $Profile
     * @return $this
     */
    public function removeProfile(Profiles $profile): self
    {
        if ($this->profiles->removeElement($profile)) {
            // set the owning side to null (unless already changed)
            if ($profile->getGenre() === $this) {
                $profile->setGenre(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Product[]
     */
    public function getProducts(): Collection
    {
        
        return $this->products;
    }

    /**
     * @param Product $Product
     * @return $this
     */
    public function addProduct(Product $product): self
    {
        if (!$this->products->contains($product)) {
            $this->products[] = $product;
            $product->setGenre($this);
        }

        return $this;
    }

    /**
     * @param Product $Product
     * @return $this
     */
    public function removeProduct(Product $product): self
    {
        if ($this->products->removeElement($product)) {
            // set the owning side to null (unless already changed)
            if ($product->getGenre() === $this) {
                $product->setGenre(null);
            }
        }

        return $this;
    }

    public function getValue(): ?string
    {
        return $this->value;
    }

    public function setValue(?string $value): self
    {
        $this->value = $value;

        return $this;
    }
}
