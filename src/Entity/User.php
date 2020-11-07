<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;


/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @UniqueEntity("email",
 *     message = "The email has already been taken."
 * )
 */
class User implements UserInterface
{
	 /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
	private $id;

    /**
     * @ORM\Column(type="string", length=120, nullable=false)
	 * @Assert\NotBlank
	 * @Assert\Length(min=3)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=120, unique=true, nullable=false)
	 * @Assert\NotBlank
	 * @Assert\Email(
     *     message = "The email '{{ value }}' is not a valid email."
     * )
     */
	private $email;

	/**
     * @ORM\Column(type="string", length=255, nullable=false)
	 * @Assert\NotBlank
	 * @Assert\Length(min=6)
     */
	private $password;

	/**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
	private $profile_photo;
	
    /**
     * @ORM\Column(columnDefinition="TINYINT UNSIGNED DEFAULT 0 NOT NULL", options={"comment":"0 = Admin, 1 = User, 2 = Poster"})
     */
	private $type;
	
	/**
     * @ORM\Column(columnDefinition="TINYINT UNSIGNED DEFAULT 1 NOT NULL")
     */
    private $status;

    /**
     * @ORM\Column(type="integer", nullable=false, options={"unsigned":true, "default": 0})
     */
    private $created_by;

    /**
     * @ORM\Column(type="integer", nullable=false, options={"unsigned":true, "default": 0})
     */
    private $edited_by;

    /**
     * @ORM\Column(type="integer", nullable=false, options={"unsigned":true, "default": 0})
     */
    private $deleted_by;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $created_at;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $edited_at;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
	private $deleted_at;

    /**
     * @ORM\OneToMany(targetEntity=JobApply::class, mappedBy="user")
     */
    private $jobApplies;

    public function __construct()
    {
        $this->jobApplies = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

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

    public function getProfilePhoto(): ?string
    {
        return $this->profile_photo;
    }

    public function setProfilePhoto(?string $profile_photo): self
    {
        $this->profile_photo = $profile_photo;

        return $this;
    }

    public function getType(): ?int
    {
        return $this->type;
    }

    public function setType(int $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setStatus(int $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getCreatedBy(): ?int
    {
        return $this->created_by;
    }

    public function setCreatedBy(int $created_by): self
    {
        $this->created_by = $created_by;

        return $this;
    }

    public function getEditedBy(): ?int
    {
        return $this->edited_by;
    }

    public function setEditedBy(?int $edited_by): ?self
    {
        $this->edited_by = $edited_by;

        return $this;
    }

    public function getDeletedBy(): ?int
    {
        return $this->deleted_by;
    }

    public function setDeletedBy(?int $deleted_by): ?self
    {
        $this->deleted_by = $deleted_by;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(?\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getEditedAt(): ?\DateTimeInterface
    {
        return $this->edited_at;
    }

    public function setEditedAt(?\DateTimeInterface $edited_at): self
    {
        $this->edited_at = $edited_at;

        return $this;
    }

    public function getDeletedAt(): ?\DateTimeInterface
    {
        return $this->deleted_at;
    }

    public function setDeletedAt(?\DateTimeInterface $deleted_at): self
    {
        $this->deleted_at = $deleted_at;

        return $this;
    }

    /**
     * @return Collection|JobApply[]
     */
    public function getJobApplies(): Collection
    {
        return $this->jobApplies;
    }

    public function addJobApply(JobApply $jobApply): self
    {
        if (!$this->jobApplies->contains($jobApply)) {
            $this->jobApplies[] = $jobApply;
            $jobApply->setUser($this);
        }

        return $this;
    }

    public function removeJobApply(JobApply $jobApply): self
    {
        if ($this->jobApplies->removeElement($jobApply)) {
            // set the owning side to null (unless already changed)
            if ($jobApply->getUser() === $this) {
                $jobApply->setUser(null);
            }
        }

        return $this;
	}
	
	 /**
     * Returns the roles granted to the user.
     *
     *     public function getRoles()
     *     {
     *         return ['ROLE_USER'];
     *     }
     *
     * Alternatively, the roles might be stored on a ``roles`` property,
     * and populated in any number of different ways when the user object
     * is created.
     *
     * @return (Role|string)[] The user roles
     */
    public function getRoles() {
		
		return ['ROLE_ADMIN'];
	}


    /**
     * Returns the salt that was originally used to encode the password.
     *
     * This can return null if the password was not encoded using a salt.
     *
     * @return string|null The salt
     */
    public function getSalt() {

	}

    /**
     * Returns the username used to authenticate the user.
     *
     * @return string The username
     */
    public function getUsername() {
		return $this->email;
	}

    /**
     * Removes sensitive data from the user.
     *
     * This is important if, at any given point, sensitive information like
     * the plain-text password is stored on this object.
     */
    public function eraseCredentials() {

	}
}
