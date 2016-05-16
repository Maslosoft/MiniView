<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
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
