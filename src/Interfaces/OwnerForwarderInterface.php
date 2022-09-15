<?php

/**
 * Mini view is minimal template rendering library with pluggable template engines. Out of the box it support plain PHP templates, Latte and Twig.
 *
 * This software package is licensed under `AGPL, Commercial` license[s].
 *
 * @package maslosoft/miniview
 * @license AGPL, Commercial
 *
 * @copyright Copyright (c) Peter Maselkowski <pmaselkowski@gmail.com>
 * @link https://maslosoft.com/miniview/
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
	public function __get(string $name);

	/**
	 * Forward to owner
	 * @param string $name
	 * @param mixed  $value
	 */
	public function __set(string $name, mixed $value): void;

	/**
	 * Forward to owner
	 * @param string $name
	 * @param array  $arguments
	 */
	public function __call(string $name, array $arguments);

	/**
	 * Forward to owner
	 * @param string $name
	 * @return bool
	 */
	public function __isset(string $name);

	/**
	 * Forward to owner
	 * @param string $name
	 */
	public function __unset(string $name);

	/**
	 * Forward __toString to owner
	 * @return string
	 */
	public function __toString();
}
