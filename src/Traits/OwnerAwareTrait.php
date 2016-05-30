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

	/**
	 * Get view owner
	 * @return object
	 */
	public function getOwner()
	{
		return $this->owner;
	}

	/**
	 * Set view owner
	 * @param object $owner
	 * @return static
	 */
	public function setOwner($owner)
	{
		$this->owner = $owner;
		return $this;
	}

}
