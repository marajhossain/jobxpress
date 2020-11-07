<?php
namespace App\Model;

use App\Entity\User;
use App\Repository\CategoryRepository;

class CategoryManager {

	/** @var CategoryRepository */
	protected $repository;	

	public function __construct(CategoryRepository $categoryRepository)
	{
		$this->repository = $categoryRepository;
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