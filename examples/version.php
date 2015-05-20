<?php

use Company\SomeNamespace\MyWidget;
use Maslosoft\MiniView\MiniView;

require __DIR__ . '/../src/Miniview.php';
require __DIR__ . '/MyWidget.phps';

$widget = new MiniView(new MyWidget);

echo $widget->version;