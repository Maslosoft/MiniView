<?php

namespace Renderers;

use Maslosoft\MiniView\MiniView;
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
