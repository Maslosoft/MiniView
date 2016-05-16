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

use Maslosoft\MiniView\Interfaces\OwnerAwareInterface;
use Maslosoft\MiniView\Interfaces\RendererAwareInterface;
use Maslosoft\MiniView\Interfaces\ViewRendererInterface;
use ReflectionObject;

/**
 * MiniRender
 * Based on Yii CWidget
 * @author Piotr Maselkowski <pmaselkowski at gmail.com>
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @property string @version Current MiniView version
 */
class MiniView implements ViewRendererInterface, OwnerAwareInterface, RendererAwareInterface
{

	use Traits\OwnerAwareTrait,
	  Traits\RendererAwareTrait;

	/**
	 * Current version
	 * @var string
	 */
	private static $version = null;

	/**
	 * View path
	 * @var string
	 */
	private $path = '';

	/**
	 * View path. This is relative to base path.
	 * @var string
	 */
	private $viewsPath = 'views';

	/**
	 * Create MiniView instance. If path is not set, it will be based on location of owner class.
	 * @param object $owner
	 * @param string $path
	 */
	public function __construct($owner, $path = null)
	{
		$this->path = $path;
		$this->setOwner($owner);
	}

	/**
	 * Get current MiniView version
	 * @return string Version string
	 */
	public function getVersion()
	{
		if (null === self::$version)
		{
			self::$version = require __DIR__ . '/version.php';
		}
		return self::$version;
	}

	/**
	 * Set views path. This is relative path for view resolving.
	 * By default it's `views` folder.
	 * @param string $path
	 */
	public function setViewsPath($path)
	{
		$this->viewsPath = $path;
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
		$viewFile = sprintf('%s/%s/%s', $this->getPath(), $this->viewsPath, $view);
		return $this->getRenderer()->render($viewFile, $data, $return);
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
		return $this->getRenderer()->render($file, $data, $return);
	}

	function getPath()
	{
		if (empty($this->path))
		{
			$class = new ReflectionObject($this->getOwner());
			$this->path = dirname($class->getFileName());
		}
		return $this->path;
	}

}
