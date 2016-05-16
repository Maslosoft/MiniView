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

namespace Maslosoft\MiniView\Interfaces;

/**
 *
 * @author Piotr Maselkowski <pmaselkowski at gmail.com>
 */
interface OwnerForwarderInterface
{

	/**
	 * Forward to owner
	 * @param string $name
	 * @return mixed
	 */
	public function __get($name);

	/**
	 * Forward to owner
	 * @param string $name
	 * @param mixed $value
	 */
	public function __set($name, $value);

	/**
	 * Forward to owner
	 * @param string $name
	 * @param mixed[] $arguments
	 */
	public function __call($name, $arguments);

	/**
	 * Forward to owner
	 * @param string $name
	 * @return bool
	 */
	public function __isset($name);

	/**
	 * Forward to owner
	 * @param string $name
	 */
	public function __unset($name);

	/**
	 * Forward __toString to owner
	 * @return string
	 */
	public function __toString();
}
