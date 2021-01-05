<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=App\Repository\JobPostRepository::class)
 */
class JobPost
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="jobPosts")
     * @ORM\JoinColumn(nullable=false)
     */
    private $category;

    /**
     * @ORM\Column(type="string", length=255)
     * 
     * @Assert\NotBlank
     * 
     */
    private $company_name;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $type;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $position;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $location;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $logo;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $total_applied;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $total_view;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $poster_email;

    /**
     * @ORM\Column(type="string", length=15)
     */
    private $status;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $token;

    /**
     * @ORM\Column(type="integer")
     */
    private $job_posting_time;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCategory(): ?category
    {
        return $this->category;
    }

    public function setCategory(?category $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getCompanyName(): ?string
    {
        return $this->company_name;
    }

    public function setCompanyName(string $company_name): self
    {
        $this->company_name = $company_name;

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

    public function getPosition(): ?string
    {
        return $this->position;
    }

    public function setPosition(string $position): self
    {
        $this->position = $position;

        return $this;
    }

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function setLocation(string $location): self
    {
        $this->location = $location;

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

    public function getLogo(): ?string
    {
        return $this->logo;
    }

    public function setLogo(?string $logo): self
    {
        $this->logo = $logo;

        return $this;
    }

    public function getTotalApplied(): ?int
    {
        return $this->total_applied;
    }

    public function setTotalApplied(?int $total_applied): self
    {
        $this->total_applied = $total_applied;

        return $this;
    }

    public function getTotalView(): ?int
    {
        return $this->total_view;
    }

    public function setTotalView(?int $total_view): self
    {
        $this->total_view = $total_view;

        return $this;
    }

    public function getPosterEmail(): ?string
    {
        return $this->poster_email;
    }

    public function setPosterEmail(string $poster_email): self
    {
        $this->poster_email = $poster_email;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getToken(): ?string
    {
        return $this->token;
    }

    public function setToken(string $token): self
    {
        $this->token = $token;

        return $this;
    }

    public function getJobPostingTime(): ?int
    {
        return $this->job_posting_time;
    }

    public function setJobPostingTime(int $job_posting_time): self
    {
        $this->job_posting_time = $job_posting_time;

        return $this;
    }
}
