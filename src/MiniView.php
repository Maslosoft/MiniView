<?php

/**
* This software package is licensed under New BSD license.
* 
* @package maslosoft/miniview
* @licence New BSD
* 
* @copyright Copyright (c) Peter Maselkowski <pmaselkowski@gmail.com>
* 
* @link http://maslosoft.com/miniview/
*/

namespace Maslosoft\MiniView;

use ReflectionObject;

/**
 * MiniRender
 * Based on Yii CWidget
 * @author Piotr Maselkowski <pmaselkowski at gmail.com>
 * @author Qiang Xue <qiang.xue@gmail.com>
 */
class MiniView
{

	/**
	 * View path
	 * @var string
	 */
	private $_path = '';

	/**
	 * Owner class
	 * @var object
	 */
	private $_owner = null;

	/**
	 * Create MiniView instance. If path is not set, it will be based on location of owner class.
	 * @param object $owner
	 * @param string $path
	 */
	public function __construct($owner, $path = null)
	{
		$this->_owner = $owner;
		$class = new ReflectionObject($this->_owner);
		$this->_path = $path? : dirname($class->getFileName());
	}

	/**
	 * Forward to owner
	 * @param string $name
	 * @return mixed
	 */
	public function __get($name)
	{
		return $this->_owner->$name;
	}

	/**
	 * Forward to owner
	 * @param string $name
	 * @param mixed $value
	 */
	public function __set($name, $value)
	{
		$this->_owner->$name = $value;
	}

	/**
	 * Forward to owner
	 * @param string $name
	 * @param mixed[] $arguments
	 */
	public function __call($name, $arguments)
	{
		call_user_func_array([$this->_owner, $name], $arguments);
	}

	/**
	 * Forward to owner
	 * @param string $name
	 * @return bool
	 */
	public function __isset($name)
	{
		return isset($this->_owner->$name);
	}

	/**
	 * Forward to owner
	 * @param string $name
	 */
	public function __unset($name)
	{
		unset($this->_owner->$name);
	}

	/**
	 * Render view with data provided.
	 * View name must be
	 * @param string $view
	 * @param mixed[] $data
	 * @param bool $return
	 * @return string
	 */
	public function render($view, $data = null, $return = false)
	{
		$viewFile = sprintf('%s/views/%s.php', $this->_path, $view);
		return $this->_renderInternal($viewFile, $data, $return);
	}

	/**
	 * Renders a view file.
	 * This method includes the view file as a PHP script
	 * and captures the display result if required.
	 * @param string $_viewFile_ view file
	 * @param array $_data_ data to be extracted and made available to the view file
	 * @param boolean $_return_ whether the rendering result should be returned as a string
	 * @return string the rendering result. Null if the rendering result is not required.
	 */
	private function _renderInternal($_viewFile_, $_data_ = null, $_return_ = false)
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
