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

namespace Maslosoft\MiniView\Traits;

use Maslosoft\MiniView\Interfaces\OwnerAwareInterface;
use Maslosoft\MiniView\Interfaces\ViewRendererInterface;
use Maslosoft\MiniView\Renderers\PhpRenderer;

/**
 * RendererAwareTrait
 *
 * @author Piotr Maselkowski <pmaselkowski at gmail.com>
 */
trait RendererAwareTrait
{

	/**
	 *
	 * @var ViewRendererInterface
	 */
	private $renderer = null;

	/**
	 * Get renderer
	 * @return ViewRendererInterface
	 */
	public function getRenderer(): ViewRendererInterface
	{
		if (null === $this->renderer)
		{
			$this->setRenderer(new PhpRenderer());
		}
		return $this->renderer;
	}

	/**
	 * Set renderer
	 * @param ViewRendererInterface $renderer
	 */
	public function setRenderer(ViewRendererInterface $renderer): void
	{
		if ($renderer instanceof OwnerAwareInterface)
		{
			$renderer->setOwner($this->getOwner());
		}
		$this->renderer = $renderer;
	}
}
