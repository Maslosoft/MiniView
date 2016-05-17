<?php

namespace Renderers;

use Maslosoft\MiniView\MiniView;
use Maslosoft\MiniView\Renderers\PhpRenderer;
use UnitTester;

class PhpTest extends \Codeception\TestCase\Test
{

	/**
	 * @var UnitTester
	 */
	protected $tester;

	/**
	 * NOTE: Do not remove, part of test
	 * @var string
	 */
	public $value = 'property value';

	// tests
	public function testIfWillPassVariableToView()
	{
		$var = 'New Variable';

		$view = new MiniView($this);

		$result = $view->render('passVariable', ['var' => $var], true);

		$this->assertSame($var, $result);
	}

	// tests
	public function testIfWillPassVariableToViewWithRendererDetection()
	{
		$var = 'New Variable';

		$view = new MiniView($this);
		$view->setRenderer(new PhpRenderer());
		$result = $view->render('passVariable.php', ['var' => $var], true);

		$this->assertSame($var, $result);
	}

	public function testIfWillForwardMethodToOwner()
	{
		$view = new MiniView($this);

		$result = $view->render('forwardMethod', [], true);

		$this->assertSame($this->getValue(), $result);
	}

	public function testIfWillForwardPropertyToOwner()
	{
		$view = new MiniView($this);

		$result = $view->render('forwardProperty', [], true);

		$this->assertSame($this->value, $result);
	}

	public function getValue()
	{
		return 'my value from method';
	}

}
