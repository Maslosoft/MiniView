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
	 * @var object|null
	 */
	private ?object $owner = null;

	/**
	 * Get view owner
	 * @return object|null
	 */
	public function getOwner(): ?object
	{
		return $this->owner;
	}

	/**
	 * Set view owner
	 * @param object $owner
	 */
	public function setOwner($owner): void
	{
		$this->owner = $owner;
	}

}
