<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Maslosoft\MiniView\Renderers;

use Maslosoft\MiniView\Interfaces\ViewRendererInterface;
use Twig_Environment;
use Twig_Loader_Filesystem;

/**
 * TwigRenderer
 *
 * @author Piotr Maselkowski <pmaselkowski at gmail.com>
 */
class TwigRenderer implements ViewRendererInterface
{

	public function render($viewFile, $data, $return = false)
	{
		$loader = new Twig_Loader_Filesystem(dirname($viewFile));
		$twig = new Twig_Environment($loader, array(
			'cache' => 'runtime',
		));

		if ($return)
		{
			return $twig->render(basename($viewFile), $data);
		}
		else
		{
			return $twig->display(basename($viewFile), $data);
		}
	}

}
