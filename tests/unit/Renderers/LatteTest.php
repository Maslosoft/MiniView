<?php

namespace Renderers;

use Maslosoft\MiniView\MiniView;
use Maslosoft\MiniView\Renderers\LatteRenderer;
use UnitTester;

class LatteTest extends \Codeception\TestCase\Test
{

	/**
	 * @var UnitTester
	 */
	protected $tester;

	// tests
	public function testIfWillPassVariableToView()
	{
		$var = 'New Variable';

		$view = new MiniView($this);
		$view->setRenderer(new LatteRenderer());

		$result = $view->render('passVariable', ['var' => $var], true);

		$this->assertSame($var, $result);
	}

}
