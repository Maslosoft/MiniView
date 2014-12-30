<?php

use Company\SomeNamespace\MyWidget;

require __DIR__ . '/../src/Miniview.php';
require __DIR__ . '/MyWidget.phps';

$widget = new MyWidget;

echo $widget->show();