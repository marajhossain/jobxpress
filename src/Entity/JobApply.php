<?php

namespace App\Entity;

use App\Repository\JobApplyRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=JobApplyRepository::class)
 */
class JobApply
{
	/**
	 * @ORM\Id
	 * @ORM\GeneratedValue
	 * @ORM\Column(type="integer")
	 */
	private $id;

	/**
	 * @ORM\Column(type="datetime")
	 */
	private $apply_at;

	/**
	 * @ORM\Column(type="string", length=255, nullable=true)
	 */
	private $resume;

	/**
	 * @ORM\Column(columnDefinition="TINYINT UNSIGNED DEFAULT 0 NOT NULL")
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
}
