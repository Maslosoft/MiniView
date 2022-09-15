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

namespace Maslosoft\MiniView;

use Exception;
use Maslosoft\EmbeDi\EmbeDi;
use Maslosoft\MiniView\Interfaces\WidgetInterface;
use ReflectionObject;
use UnexpectedValueException;
use function is_array;

/**
 * Widget
 *
 * @author Piotr Maselkowski <pmaselkowski at gmail.com>
 */
abstract class Widget implements WidgetInterface
{
	/**
	 * ID Prefix used when auto generating ID's
	 * msmvw stands for "Maslosoft Mini View Widget"
	 */
	public const IdPrefix = 'msmvw';
	public const DefaultViewsPath = 'views';

	/**
	 * @var string|null id of the widget.
	 */
	private ?string $_id = null;

	/**
	 * View path
	 * @var string
	 */
	private string $_path;

	/**
	 * @var string
	 */
	private string $_viewsPath = self::DefaultViewsPath;

	/**
	 * Configuration
	 * @var string|array
	 */
	private string|array $config;

	/**
	 * ID counter for automatically generated id's
	 * @var int
	 */
	private static int $idCounter = 0;

	/**
	 * Owner, default to current class
	 * @var Widget
	 */
	private Widget $owner;

	/**
	 * Create widget with optional config
	 * @param string|array $config
	 * @param Widget|null  $owner
	 */
	public function __construct(string|array $config = [], Widget $owner = null)
	{
		$class = new ReflectionObject($this);
		$this->_path = dirname($class->getFileName());
		if ($owner !== null)
		{
			$this->owner = $owner;
		}
		else
		{
			$this->owner = $this;
		}
		$this->config = $config;
		EmbeDi::fly()->apply($this->config, $this);
	}

	/**
	 * Initializes the widget
	 */
	abstract public function init(): void;

	/**
	 * Executes the widget.
	 */
	abstract public function run(): string;

	/**
	 * Forward to owner
	 * @param string $name
	 * @return mixed
	 */
	public function __get(string $name)
	{
		return $this->owner->$name;
	}

	/**
	 * Forward to owner
	 * @param string $name
	 * @param mixed  $value
	 * @return mixed
	 */
	public function __set(string $name, mixed $value)
	{
		return $this->owner->$name = $value;
	}

	/**
	 * Forward to owner
	 * @param string $name
	 * @param array  $arguments
	 * @return mixed
	 */
	public function __call(string $name, array $arguments)
	{
		return call_user_func_array([$this->owner, $name], $arguments);
	}

	/**
	 * Forward to owner
	 * @param string $name
	 * @return bool
	 */
	public function __isset(string $name)
	{
		return isset($this->owner->$name);
	}

	/**
	 * Forward to owner
	 * @param string $name
	 */
	public function __unset(string $name)
	{
		unset($this->owner->$name);
	}

	/**
	 * Returns the ID of the widget or generates a new one if not set.
	 * @return string id of the widget.
	 */
	public function getId(): string
	{
		if ($this->_id === null)
		{
			$this->_id = sprintf('%s-%s', self::IdPrefix, self::$idCounter++);
		}
		return $this->_id;
	}

	/**
	 * Sets the ID of the widget.
	 * @param string $value id of the widget.
	 */
	public function setId(string $value): void
	{
		$this->_id = $value;
	}

	/**
	 * Returns the owner/creator of this widget.
	 * @return Widget owner/creator of this widget.
	 */
	public function getOwner(): Widget
	{
		return $this->owner;
	}

	/**
	 * Set views path. This is relative path for view resolving.
	 * By default, it's `views` folder.
	 * @param string $path
	 */
	public function setViewsPath(string $path): void
	{
		$this->_viewsPath = $path;
	}

	/**
	 * Render view with data provided.
	 * View name must not contain `php` extension.
	 * @param string     $view
	 * @param array|null $data
	 * @param bool       $return
	 * @return string|null
	 */
	public function render(string $view, array $data = null, bool $return = false): ?string
	{
		$viewFile = sprintf('%s/%s/%s.php', $this->_path, $this->_viewsPath, $view);
		return $this->_renderInternal($viewFile, $data, $return);
	}

	/**
	 * Render file with data provided.
	 * @param string     $file
	 * @param array|null $data
	 * @param bool       $return
	 * @return string|null
	 */
	public function renderFile(string $file, array $data = null, bool $return = false): ?string
	{
		return $this->_renderInternal($file, $data, $return);
	}

	/**
	 * Renders a view file.
	 * This method includes the view file as a PHP script
	 * and captures the display result if required.
	 * @param string     $_viewFile_ view file
	 * @param array|null $_data_     data to be extracted and made available to the view file
	 * @param boolean    $_return_   whether the rendering result should be returned as a string
	 * @return string|null the rendering result. Null if the rendering result is not required.
	 */
	private function _renderInternal(string $_viewFile_, array $_data_ = null, bool $_return_ = false): ?string
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

	/**
	 * Create and run widget. Use this in templates to properly initialize widgets.
	 * This must be called from extending class.
	 * Example:
	 * ```php
	 * echo ProgressBar::widget([
	 *        'percent' => 40
	 * ]);
	 * ```
	 * @param array|string|null $config
	 * @param Widget|null       $owner
	 * @return Widget HTML widget
	 */
	public static function widget(array|string|null $config = [], Widget $owner = null): Widget
	{
		/* @var $widget Widget */
		if (static::class === __CLASS__)
		{
			throw new UnexpectedValueException(sprintf('Method widget must be called from extending class, not from `%s`', __CLASS__));
		}
		if (is_string($config))
		{
			$class = $config;
			$config = [];
			$config['class'] = $class;
		}
		elseif (is_array($config))
		{
			$config['class'] = static::class;
		}
		else
		{
			$config = [
				'class' => static::class
			];
		}
		$widget = new $config['class']($config, $owner);
		assert($widget instanceof WidgetInterface);
		$widget->init();

		return $widget;
	}

	/**
	 * @return string HTML output of widget.
	 */
	public function __toString()
	{
		try
		{
			return $this->run();
		} catch (Exception $e)
		{
			return nl2br($e->getTraceAsString());
		}
	}

}
