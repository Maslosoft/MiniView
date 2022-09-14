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
use Maslosoft\MiniView\Traits\OwnerAwareTrait;
use Maslosoft\MiniView\Traits\OwnerForwarderTrait;

/**
 * PhpRenderer
 *
 * @author Piotr Maselkowski <pmaselkowski at gmail.com>
 */
class PhpRenderer implements ViewRendererInterface, OwnerAwareInterface, OwnerForwarderInterface
{

	use OwnerAwareTrait,
	  OwnerForwarderTrait;

	/**
	 * Render php file
	 * @param string $_viewFile_
	 * @param mixed  $_data_
	 * @param bool   $_return_
	 * @return string|null
	 */
	public function render(string $_viewFile_, array $_data_ = null, bool $_return_ = false): ?string
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

		require($_viewFile_);
		return null;
	}

}
