<?php

namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User implements UserInterface, PasswordAuthenticatedUserInterface

{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"get_users_collection"})
     * @Groups({"get_profiles_collection"})
     * @Groups({"create_profiles_item"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=128)
     * @Assert\Email
     * @Groups({"get_users_collection"})
     * @Groups({"create_user_item"})
     * @Assert\NotBlank
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"get_users_collection"})
     * @Groups({"create_user_item"})
     * @Assert\Regex(
    *   pattern="/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/",
    *   message="Le mot de passe doit contenir au minimum 8 caractères, une majuscule, un chiffre et un caractère spécial")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=50)
     * @Groups({"get_users_collection"})
     * @Groups({"create_user_item"})
     * @Groups({"get_login_collection"})
     * @Assert\NotBlank
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=50)
     * @Groups({"get_users_collection"})
     * @Groups({"create_user_item"})
     * @Groups({"get_login_collection"})
     * @Assert\NotBlank
     */
    private $lastname;

    /**
     * @ORM\Column(type="json")
     * @Groups({"get_users_collection"})
     * @Groups({"create_user_item"})
     * @Groups({"get_login_collection"})
     * @Assert\NotBlank
     */
    private $roles = [];

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"get_users_collection"})
     * @Groups({"create_user_item"})
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @Groups({"get_users_collection"})
     */
    private $updatedAt;

    /**
     * @ORM\OneToMany(targetEntity=Profiles::class, mappedBy="User", orphanRemoval=true)
     * @Groups({"get_users_collection"})
     */
    private $profiles;

    public function __construct()
    {
        $this->profiles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * 
     */
    

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        

        return array_unique($roles);    
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

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
     * @param Profiles $profile
     * @return $this
     */
    public function addProfile(Profiles $profile): self
    {
        if (!$this->profiles->contains($profile)) {
            $this->profiles[] = $profile;
            $profile->setUser($this);
        }

        return $this;
    }

    /**
     * @param Profiles $profile
     * @return $this
     */
    public function removeProfile(Profiles $profile): self
    {
        if ($this->profiles->removeElement($profile)) {
            // set the owning side to null (unless already changed)
            if ($profile->getUser() === $this) {
                $profile->setUser(null);
            }
        }

        return $this;
    }

    public function getRolesNames(){
        return array(
            "ROLE_ADMIN" => "Administrateur",
            "ROLE_MANAGER" => "Gestionnaire",
            "ROLE_USER" => "Utilisateur",        
        );
    }

   



     /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->firstname;
    }
    
     /**
     * @deprecated since Symfony 5.3, use getUserIdentifier instead
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }



    /**
     * Mise à jour de la date automatique
     * 
     */
    public function setCreatedAtValue()
    {
        // Date Courante
        $now =  new \DateTime('now', new \DateTimeZone('Europe/Berlin'));
        $this->setCreatedAt($now);
    }
}
