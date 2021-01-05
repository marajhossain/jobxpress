<?php

namespace App\Entity;

use App\Repository\SystemConfigRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SystemConfigRepository::class)
 */
class SystemConfig
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $config_name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $config_value;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

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

    public function getConfigName(): ?string
    {
        return $this->config_name;
    }

    public function setConfigName(string $config_name): self
    {
        $this->config_name = $config_name;

        return $this;
    }

    public function getConfigValue(): ?string
    {
        return $this->config_value;
    }

    public function setConfigValue(string $config_value): self
    {
        $this->config_value = $config_value;

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
}
