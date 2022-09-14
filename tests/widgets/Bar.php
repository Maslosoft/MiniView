<?php

namespace Tests\Widgets;

use Maslosoft\MiniView\Widget;

class Bar extends Widget
{
	public function init(): void
	{

	}

	public function run(): string
	{
		return 'BAR';
	}

}