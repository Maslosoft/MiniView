<?php
namespace Widgets;

use Codeception\Test\Unit;
use Maslosoft\MiniView\Widget;
use Tests\Widgets\Bar;
use Tests\Widgets\FooParam;
use UnitTester;
use function codecept_debug;

class WidgetTest extends Unit
{
    /**
     * @var UnitTester
     */
    protected $tester;
    
    protected function _before()
    {
    }

    protected function _after()
    {
    }

    // tests
    public function testTheMostSimpleWidget(): void
    {
		$widget = FooParam::widget();
		$result = (string)$widget;
		$this->assertSame('FOO', $result);
    }

	public function testWidgetOwner(): void
	{
		$widget = Bar::widget(null, FooParam::widget());
		$result = (string)$widget->getOwner();
		$this->assertSame('FOO', $result);
	}

	public function testParametrizedWidget(): void
	{
		$widget = FooParam::widget(['message' => 'Hello']);
		$result = (string)$widget->getOwner();
		$this->assertSame('Hello', $result);
	}

	public function testGeneratingIds(): void
	{
		$widget = FooParam::widget();
		codecept_debug($widget->getId());
		$ids = [
			$widget->getId(),
			$widget->getId(),
			$widget->getId(),
		];
		$this->assertNotEmpty($widget->getId());
		$this->assertStringContainsString(Widget::IdPrefix, $widget->getId());
		foreach ($ids as $id)
		{
			$this->assertSame($widget->getId(), $id, 'ID is not changing on subsequent calls');
		}
	}
}