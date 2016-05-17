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
