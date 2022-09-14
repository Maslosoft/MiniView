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

	public function render(string $viewFile, array $data = null, bool $return = false): ?string
	{
		$latte = new Engine();
		$latte->setTempDirectory('runtime');
		if ($return)
		{
			return $latte->renderToString($viewFile, $data);
		}

		$latte->render($viewFile, $data);
		return null;
	}

}
