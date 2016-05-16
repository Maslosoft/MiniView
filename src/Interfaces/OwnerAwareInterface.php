<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Maslosoft\MiniView\Interfaces;

/**
 * OwnerAwareInterface
 *
 * @author Piotr Maselkowski <pmaselkowski at gmail.com>
 */
interface OwnerAwareInterface
{

	public function getOwner();

	public function setOwner($owner);
}
