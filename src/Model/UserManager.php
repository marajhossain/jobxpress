<?php
namespace App\Model;

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
}