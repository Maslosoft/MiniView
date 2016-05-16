<?php

/**
 * This software package is licensed under `AGPL, Commercial` license[s].
 *
 * @package maslosoft/miniview
 * @license AGPL, Commercial
 *
 * @copyright Copyright (c) Peter Maselkowski <pmaselkowski@gmail.com>
 *
 * @link http://maslosoft.com/miniview/
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
