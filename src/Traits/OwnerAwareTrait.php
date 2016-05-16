<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Maslosoft\MiniView\Traits;

/**
 * OwnerTrait
 *
 * @author Piotr Maselkowski <pmaselkowski at gmail.com>
 */
trait OwnerAwareTrait
{

	/**
	 * Owner class
	 * @var object
	 */
	private $owner = null;

	public function getOwner()
	{
		return $this->owner;
	}

	public function setOwner($owner)
	{
		$this->owner = $owner;
	}

}
