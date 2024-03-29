<?php

/**
 * Fuel
 *
 * Fuel is a fast, lightweight, community driven PHP5 framework.
 *
 * @package    Fuel
 * @version    1.0
 * @author     Fuel Development Team
 * @license    MIT License
 * @copyright  2010 - 2011 Fuel Development Team
 * @link       http://fuelphp.com
 */

namespace Hybrid;

/**
 * Factory class tests
 * 
 * @group Hybrid
 * @group Chart_Utility
 */

 class Test_Chart_Utility extends \Fuel\Core\TestCase {
 	
 	public function setup()
 	{
 		\Fuel::add_package('hybrid');
 	}

 	public function test_js()
 	{
 		$expected 	= '<script type="text/javascript" src="https://www.google.com/jsapi"></script>';
 		$output 	= \Hybrid\Chart_Utility::js();

 		$this->assertEquals($expected, $output);
 	}
 }