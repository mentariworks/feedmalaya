<?php

/**
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
 * Hybrid 
 * 
 * A set of class that extends the functionality of FuelPHP without 
 * affecting the standard workflow when the application doesn't actually 
 * utilize Hybrid feature.
 * 
 * @package     Fuel
 * @subpackage  Hybrid
 * @category    Controller
 * @abstract
 * @author      Mior Muhammad Zaki <crynobone@gmail.com>
 */
 
abstract class Controller extends \Fuel\Core\Controller {

    /**
     * Run ACL check and redirect user automatically if user doesn't have the privilege
     * 
     * @final
     * @access  public
     * @param   mixed   $resource
     * @param   string  $type 
     * @param   string  $name
     */
    final protected function acl($resource, $type = null, $name = null) 
    {
        $status = \Hybrid\Acl::instance($name)->access_status($resource, $type);

        switch ($status) 
        {
            case 401 :
                throw new \Request404Exception();
            break;
        }
    }

    /**
     * This method will be called after we route to the destinated method
     * 
     * @access  public
     */
    public function before() 
    {
        $this->language = \Hybrid\Factory::get_language();
        $this->user     = \Hybrid\Auth::instance('user')->get();

        \Event::trigger('controller_before');

        return parent::before();
    }

    /**
     * This method will be called after we route to the destinated method
     * 
     * @access  public
     */
    public function after() 
    {
        \Event::trigger('controller_after');

        return parent::after();
    }

}