<?php

namespace Renderers;

use Codeception\Test\Unit;
use Maslosoft\MiniView\MiniView;
use Maslosoft\MiniView\Renderers\PhpRenderer;
use UnitTester;
use function codecept_debug;
use function trim;

class PhpTest extends Unit
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
	public function testRenderingWithoutVariable(): void
	{
		$view = new MiniView($this);

		$result = $view->render('noVariable', null, true);

		codecept_debug(trim($result));

		$this->assertStringContainsString('Hello', $result);
	}

	public function testIfWillPassVariableToView(): void
	{
		$var = 'New Variable';

		$view = new MiniView($this);

		$result = $view->render('passVariable', ['var' => $var], true);

		$this->assertSame($var, $result);
	}

	public function testIfWillPassVariableToViewWithRendererDetection(): void
	{
		$var = 'New Variable';

		$view = new MiniView($this);
		$view->setRenderer(new PhpRenderer());
		$result = $view->render('passVariable.php', ['var' => $var], true);

		$this->assertSame($var, $result);
	}

	public function testIfWillForwardMethodToOwner(): void
	{
		$view = new MiniView($this);

		$result = $view->render('forwardMethod', [], true);

		$this->assertSame($this->getValue(), $result);
	}

	public function testIfWillForwardPropertyToOwner(): void
	{
		$view = new MiniView($this);

		$result = $view->render('forwardProperty', [], true);

		$this->assertSame($this->value, $result);
	}

	public function getValue(): string
	{
		return 'my value from method';
	}

}
