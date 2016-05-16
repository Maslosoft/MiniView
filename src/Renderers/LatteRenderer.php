<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Maslosoft\MiniView\Renderers;

use Latte\Engine;
use Maslosoft\MiniView\Interfaces\ViewRendererInterface;

/**
 * LatteRenderer
 *
 * @author Piotr Maselkowski <pmaselkowski at gmail.com>
 */
class LatteRenderer implements ViewRendererInterface
{

	public function render($viewFile, $data, $return = false)
	{
		$viewFile = sprintf('%s.latte', $viewFile);
		$latte = new Engine();
		$latte->setTempDirectory('runtime');
		if ($return)
		{
			return $latte->renderToString($viewFile, $data);
		}
		else
		{
			return $latte->render($viewFile, $data);
		}
	}

}
