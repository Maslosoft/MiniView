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

namespace Maslosoft\MiniView;

use Exception;
use ReflectionObject;

/**
 * Widget
 *
 * @author Piotr Maselkowski <pmaselkowski at gmail.com>
 */
abstract class Widget
{

	/**
	 * @var string id of the widget.
	 */
	private $_id;

	/**
	 * View path
	 * @var string
	 */
	private $_path = '';

	/**
	 * Configuration
	 * @var mixed[]
	 */
	private $config = [];

	/**
	 * Id counter for automatically generated id's
	 * @var intr
	 */
	private static $idCounter = 0;

	/**
	 * Owner, default to current class
	 * @var Widget
	 */
	private $owner;

	/**
	 * Create widget with optional config
	 * @param mixed[] $config
	 */
	public function __construct($config = [], $owner = null)
	{
		$class = new ReflectionObject($this);
		$this->_path = dirname($class->getFileName());
		if (!empty($owner))
		{
			$this->owner = $owner;
		}
		else
		{
			$this->owner = $this;
		}
		$this->config = $config;
	}

	/**
	 * Initializes the widget
	 */
	abstract public function init();

	/**
	 * Executes the widget.
	 */
	abstract public function run();

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
		return $this->_owner->$name = $value;
	}

	/**
	 * Forward to owner
	 * @param string $name
	 * @param mixed[] $arguments
	 */
	public function __call($name, $arguments)
	{
		return call_user_func_array([$this->_owner, $name], $arguments);
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
	 * Returns the ID of the widget or generates a new one if not set.
	 * @return string id of the widget.
	 */
	public function getId()
	{
		if ($this->_id === null)
		{
			$this->_id = sprtinf('msmv-%s', self::$idCounter++);
		}
		return $this->_id;
	}

	/**
	 * Sets the ID of the widget.
	 * @param string $value id of the widget.
	 */
	public function setId($value)
	{
		$this->_id = $value;
	}

	/**
	 * Returns the owner/creator of this widget.
	 * @return object owner/creator of this widget. It could be either a widget or a controller.
	 */
	public function getOwner()
	{
		return $this->_owner;
	}

	/**
	 * Set views path. This is relative path for view resolving.
	 * By default it's `views` folder.
	 * @param string $path
	 */
	public function setViewsPath($path)
	{
		$this->_viewsPath = $path;
	}

	/**
	 * Render view with data provided.
	 * View name must not contain `php` extension.
	 * @param string $view
	 * @param mixed[] $data
	 * @param bool $return
	 * @return string
	 */
	public function render($view, $data = null, $return = false)
	{
		$viewFile = sprintf('%s/%s/%s.php', $this->_path, $this->_viewsPath, $view);
		return $this->_renderInternal($viewFile, $data, $return);
	}

	/**
	 * Render file with data provided.
	 * @param string $file
	 * @param mixed[] $data
	 * @param bool $return
	 * @return string
	 */
	public function renderFile($file, $data = null, $return = false)
	{
		return $this->_renderInternal($file, $data, $return);
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

	/**
	 * Create and run widget. Use this in templates to properly initialize widgets.
	 * This must be called from extending class.
	 * Example:
	 * ```php
	 * echo ProgressBar::widget([
	 * 		'percent' => 40
	 * ]);
	 * ```
	 * @param mixed[] $config
	 * @return string HTML widget
	 */
	public static function widget($config = [])
	{
		ob_start();
		ob_implicit_flush(false);
		/* @var $widget MsWidget */
		if (static::class === __CLASS__)
		{
			throw new WidgetException(sprintf('Method widget must be called from extending class, not from `%s`', __CLASS__));
		}
		if (is_string($config))
		{
			$class = $config;
			$config = [];
			$config['class'] = $class;
		}
		else
		{
			$config['class'] = static::class;
		}
		$widget = EmbeDi::fly()->apply($config);
		$widget->init();
		$out = $widget->run();

		return ob_get_clean() . $out;
	}

	/**
	 * This is equivalent of calling ::widget() with config from constructor.
	 * Could be used for convenient outputting of simple widgets.
	 * Example:
	 * ```php
	 * echo new Flags([], $this);
	 * echo new Head(['title' => 'foot'], $this);
	 * ```
	 * @return string HTML output of widget.
	 */
	public function __toString()
	{
		try
		{
			$class = static::class;
			return $class::widget($this->config);
		}
		catch (Exception $e)
		{
			return nl2br($e->getTraceAsString());
		}
	}

}
