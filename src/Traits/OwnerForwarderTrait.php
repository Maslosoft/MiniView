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
 * OwnerForwarderTrait
 *
 * @author Piotr Maselkowski <pmaselkowski at gmail.com>
 */
trait OwnerForwarderTrait
{

	/**
	 * Forward to owner
	 * @param string $name
	 * @return mixed
	 */
	public function __get($name)
	{
		return $this->getOwner()->$name;
	}

	/**
	 * Forward to owner
	 * @param string $name
	 * @param mixed $value
	 */
	public function __set($name, $value)
	{
		return $this->getOwner()->$name = $value;
	}

	/**
	 * Forward to owner
	 * @param string $name
	 * @param mixed[] $arguments
	 */
	public function __call($name, $arguments)
	{
		return call_user_func_array([$this->getOwner(), $name], $arguments);
	}

	/**
	 * Forward to owner
	 * @param string $name
	 * @return bool
	 */
	public function __isset($name)
	{
		return isset($this->getOwner()->$name);
	}

	/**
	 * Forward to owner
	 * @param string $name
	 */
	public function __unset($name)
	{
		unset($this->getOwner()->$name);
	}

	/**
	 * Forward __toString to owner
	 * @return string
	 */
	public function __toString()
	{
		return (string) $this->getOwner();
	}

}
