<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
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
	 */
	public function setRenderer(ViewRendererInterface $renderer)
	{
		if ($renderer instanceof OwnerAwareInterface)
		{
			$renderer->setOwner($this->getOwner());
		}
		$this->renderer = $renderer;
	}

	abstract public function getOwner();
}
