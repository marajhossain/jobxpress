<?php

namespace App\Entity;

use App\Repository\JobApplyRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=JobApplyRepository::class)
 */
class JobApply
{

	/**
	 * @ORM\Column(type="datetime")
     * @Assert\DateTime
     * @var string A "Y-m-d H:i:s" formatted value
     */
	protected $apply_at;
	
	/**
	 * @ORM\Id
	 * @ORM\GeneratedValue
	 * @ORM\Column(type="integer")
	 */
	private $id;

	
	/**
	 * @ORM\Column(type="string", length=255, nullable=true)
	 * 

	 */
	private $resume;

	/**
	 * @ORM\Column(columnDefinition="TINYINT UNSIGNED DEFAULT 0 NOT NULL")
	 * 
	 */
	private $is_view;

	/**
	 * @ORM\ManyToOne(targetEntity=Job::class, inversedBy="jobApplies")
	 * @ORM\JoinColumn(nullable=false)
	 */
	private $job;

	/**
	 * @ORM\ManyToOne(targetEntity=User::class, inversedBy="jobApplies")
	 * @ORM\JoinColumn(nullable=false)
	 */
	private $user;
	
	/**
	 * @ORM\Column(columnDefinition="TINYINT UNSIGNED DEFAULT 1 NOT NULL")
	 */
	private $status;

    /**
     * @ORM\Column(type="string", length=100)
	 * 
	 * @Assert\NotBlank
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
	 * 
	 * @Assert\NotBlank
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
	 * 
     */
    private $application_token;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $phone;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
	 * 
	 * @Assert\NotBlank
     */
    private $employer;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
	 * 
	 * @Assert\NotBlank
     */
    private $source;

	public function getId(): ?int
                                                      	{
                                                      		return $this->id;
                                                      	}

	public function getApplyAt(): ?\DateTimeInterface
                                                      	{
                                                      		return $this->apply_at;
                                                      	}

	public function setApplyAt(\DateTimeInterface $apply_at): self
                                                      	{
                                                      		$this->apply_at = $apply_at;
                                                      
                                                      		return $this;
                                                      	}

	public function getResume(): ?string
                                                      	{
                                                      		return $this->resume;
                                                      	}

	public function setResume(string $resume): self
                                                      	{
                                                      		$this->resume = $resume;
                                                      
                                                      		return $this;
                                                      	}

	public function getIsView(): ?int
                                                      	{
                                                      		return $this->is_view;
                                                      	}

	public function setIsView(?int $is_view): self
                                                      	{
                                                      		$this->is_view = $is_view;
                                                      
                                                      		return $this;
                                                      	}

	public function getJob(): ?Job
                                                      	{
                                                      		return $this->job;
                                                      	}

	public function setJob(?Job $job): self
                                                      	{
                                                      		$this->job = $job;
                                                      
                                                      		return $this;
                                                      	}

	public function getUser(): ?User
                                                      	{
                                                      		return $this->user;
                                                      	}

	public function setUser(?User $user): self
                                                      	{
                                                      		$this->user = $user;
                                                      
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

    public function getApplicationToken(): ?string
    {
        return $this->application_token;
    }

    public function setApplicationToken(string $application_token): self
    {
        $this->application_token = $application_token;

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

    public function getEmployer(): ?string
    {
        return $this->employer;
    }

    public function setEmployer(?string $employer): self
    {
        $this->employer = $employer;

        return $this;
    }

    public function getSource(): ?string
    {
        return $this->source;
    }

    public function setSource(?string $source): self
    {
        $this->source = $source;

        return $this;
    }
}
