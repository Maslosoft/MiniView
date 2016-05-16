<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Maslosoft\MiniView\Renderers;

use Maslosoft\MiniView\Interfaces\OwnerAwareInterface;
use Maslosoft\MiniView\Interfaces\OwnerForwarderInterface;
use Maslosoft\MiniView\Interfaces\ViewRendererInterface;

/**
 * PhpRenderer
 *
 * @author Piotr Maselkowski <pmaselkowski at gmail.com>
 */
class PhpRenderer implements ViewRendererInterface, OwnerAwareInterface, OwnerForwarderInterface
{

	use \Maslosoft\MiniView\Traits\OwnerAwareTrait,
	  \Maslosoft\MiniView\Traits\OwnerForwarderTrait;

	/**
	 * Render php file
	 * @param string $_viewFile_
	 * @param mixed $_data_
	 * @param bool $_return_
	 * @return string
	 */
	public function render($_viewFile_, $_data_, $_return_ = false)
	{
		$_viewFile_ = sprintf('%s.php', $_viewFile_);
		// we use special variable names here to avoid conflict when extracting data
		if (is_array($_data_))
		{
			extract($_data_, EXTR_PREFIX_SAME, 'data');
		}
		else
		{
			$data = $_data_;
		}
		if ($_return_)
		{
			ob_start();
			ob_implicit_flush(false);
			require($_viewFile_);
			return ob_get_clean();
		}
		else
		{
			require($_viewFile_);
		}
	}

}
