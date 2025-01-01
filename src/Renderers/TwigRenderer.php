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

namespace Maslosoft\MiniView\Renderers;

use Maslosoft\MiniView\Interfaces\ViewRendererInterface;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

/**
 * TwigRenderer
 *
 * @author Piotr Maselkowski <pmaselkowski at gmail.com>
 */
class TwigRenderer implements ViewRendererInterface
{

	public function render(string $viewFile, ?array $data = null, bool $return = false): ?string
	{
		$loader = new FilesystemLoader(dirname($viewFile));
		$twig = new Environment($loader, [
			'cache' => 'runtime',
		]);

		if ($return)
		{
			return $twig->render(basename($viewFile), $data);
		}

		$twig->display(basename($viewFile), $data);
		return null;
	}

}
