<?php

namespace Renderers;

use Codeception\Test\Unit;
use Latte\Engine;
use Maslosoft\MiniView\MiniView;
use Maslosoft\MiniView\Renderers\LatteRenderer;
use Maslosoft\MiniView\Renderers\PhpRenderer;
use UnitTester;

class LatteTest extends Unit
{

	/**
	 * @var UnitTester
	 */
	protected $tester;

	protected function _before()
	{
		if (!class_exists(Engine::class))
		{
			$this->markTestSkipped('Latte engine not installed');
		}
	}

	// tests
	public function testIfWillPassVariableToView()
	{

		$var = 'New Variable';

		$view = new MiniView($this);
		$view->setRenderer(new LatteRenderer());

		$result = $view->render('passVariable2', ['var' => $var], true);

		$this->assertSame($var, $result);
	}

	public function testIfWillPassVariableToViewWithRendererDetection()
	{
		$var = 'New Variable';

		$view = new MiniView($this);

		$result = $view->render('passVariable2.latte', ['var' => $var], true);

		$this->assertInstanceOf(PhpRenderer::class, $view->getRenderer(), 'That renderer was reverted back to default renderer');

		$this->assertSame($var, $result);
	}

}
