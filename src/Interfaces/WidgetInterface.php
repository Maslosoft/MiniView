<?php

namespace Maslosoft\MiniView\Interfaces;

interface WidgetInterface
{
	public function init(): void;
	public function run(): string;
}