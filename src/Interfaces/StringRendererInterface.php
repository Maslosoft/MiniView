<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Maslosoft\MiniView\Interfaces;

/**
 * Render template contained in string.
 * 
 * @author Piotr Maselkowski <pmaselkowski at gmail.com>
 */
interface StringRendererInterface
{

	public function renderString($template, $data, $return = false);
}
