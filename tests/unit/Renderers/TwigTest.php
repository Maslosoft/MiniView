<?php

namespace Renderers;

use Codeception\TestCase\Test;
use Maslosoft\MiniView\MiniView;
use Maslosoft\MiniView\Renderers\PhpRenderer;
use Maslosoft\MiniView\Renderers\TwigRenderer;
use PHPUnit\Framework\SkippedTestError;
use Twig\Environment;
use UnitTester;

class TwigTest extends Test
{

	/**
	 * @var UnitTester
	 */
	protected $tester;

	protected function _before()
	{
		if (!class_exists(Environment::class))
		{
			throw new SkippedTestError('Twig engine not installed');
		}
	}

	// tests
	public function testIfWillPassVariableToView()
	{
		$var = 'New Variable';

		$view = new MiniView($this);
		$view->setRenderer(new TwigRenderer());

		$result = $view->render('passVariable3', ['var' => $var], true);

		$this->assertSame($var, $result);
	}

	public function testIfWillPassVariableToViewWithRendererDetection()
	{
		$var = 'New Variable';

		$view = new MiniView($this);

		$result = $view->render('passVariable3.twig', ['var' => $var], true);

		$this->assertInstanceOf(PhpRenderer::class, $view->getRenderer(), 'That renderer was reverted back to default renderer');

		$this->assertSame($var, $result);
	}

}
