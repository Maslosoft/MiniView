<?php

namespace Tests\Widgets;

use Maslosoft\MiniView\Widget;

class FooParam extends Widget
{
	public string $message = 'FOO';
	public function init(): void
	{

	}

	public function run(): string
	{
		return $this->message;
	}

}