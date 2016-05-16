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
 * OwnerAwareInterface
 *
 * @author Piotr Maselkowski <pmaselkowski at gmail.com>
 */
interface OwnerAwareInterface
{

	public function getOwner();

	public function setOwner($owner);
}
