<?php
namespace App\Model;

use App\Entity\User;
use App\Repository\UserRepository;

class UserManager {

	/** @var UserRepository */
	protected $repository;	

	public function __construct(UserRepository $userRepository)
	{
		$this->repository = $userRepository;
	}

	public function getList()
	{		
		return $this->repository->findAll();
	}

	public function getById(int $id)
	{		
		return $this->repository->find($id);
	}
}