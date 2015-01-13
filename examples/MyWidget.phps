<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Company\SomeNamespace;

use Maslosoft\MiniView\MiniView;

class MyWidget
{

	/**
	 * View renderer
	 * @var MiniView
	 */
	public $view = null;

	public function __construct()
	{
		$this->view = new MiniView($this);
	}

	public function show()
	{
		return $this->view->render('myView', ['user' => 'Joe'], true);
	}

}
