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
	public function getRenderer()
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
	 * @return static
	 */
	public function setRenderer(ViewRendererInterface $renderer)
	{
		if ($renderer instanceof OwnerAwareInterface)
		{
			$renderer->setOwner($this->getOwner());
		}
		$this->renderer = $renderer;
		return $this;
	}

	abstract public function getOwner();
}
