<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
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

	public function render(string $viewFile, array $data = null, bool $return = false): ?string
	{
		$loader = new FilesystemLoader(dirname($viewFile));
		$twig = new Environment($loader, array(
			'cache' => 'runtime',
		));

		if ($return)
		{
			return $twig->render(basename($viewFile), $data);
		}

		$twig->display(basename($viewFile), $data);
		return null;
	}

}
