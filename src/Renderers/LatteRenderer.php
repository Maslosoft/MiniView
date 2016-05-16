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
