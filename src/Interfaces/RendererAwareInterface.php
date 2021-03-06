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
interface RendererAwareInterface
{

	public function getRenderer();

	public function setRenderer(ViewRendererInterface $renderer);
}
