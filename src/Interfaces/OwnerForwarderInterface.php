<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
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
