<?php

namespace App\Entity;

use App\Repository\ConfigRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ConfigRepository::class)
 */
class Config
{
	 /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
	private $id;

    /**
     * @ORM\Column(type="string", length=255, unique=true, nullable=false)
     */
	private $key;

	/**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
	private $value;
	
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

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getKey(): ?string
    {
        return $this->key;
    }

    public function setKey(string $key): self
    {
        $this->key = $key;

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

    public function setEditedBy(int $edited_by): self
    {
        $this->edited_by = $edited_by;

        return $this;
    }

    public function getDeletedBy(): ?int
    {
        return $this->deleted_by;
    }

    public function setDeletedBy(int $deleted_by): self
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
}
