<?php

namespace Tests\Widgets;

use Maslosoft\MiniView\Widget;

class Foo extends Widget
{
	public function init(): void
	{

	}

	public function run(): string
	{
		return 'FOO';
	}

}