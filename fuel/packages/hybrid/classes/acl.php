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
 * Authentication Class
 * 
 * Why another class? FuelPHP does have it's own Auth package but what Hybrid does 
 * it not defining how you structure your database but instead try to be as generic 
 * as possible so that we can support the most basic structure available
 * 
 * @package     Fuel
 * @subpackage  Hybrid
 * @category    Acl
 * @author      Mior Muhammad Zaki <crynobone@gmail.com>
 */
 
class Acl {

    protected static $instances = array();

    /**
     * List of types
     * 
     * @access      protected
     * @staticvar   array
     */
    protected static $types = array('deny', 'view', 'create', 'edit', 'delete', 'all');

    /**
     * Only called once 
     * 
     * @static 
     * @access  public
     */
    public static function _init() 
    {
        \Event::trigger('init_acl');
    }
    
    /**
     * A shortcode to initiate this class as a new object
     * 
     * @static
     * @access  public
     * @param   string  $name
     * @return  static 
     */
    public static function factory($name = null)
    {
        if (\is_null($name))
        {
            $name = 'default';
        }

        if (!isset(static::$instances[$name]))
        {
            static::$instances[$name] = new static();
        }

        return static::$instances[$name];
    }

    public static function instance($name = null)
    {
        return static::factory($name);
    }

    /**
     * Construct and initiate static::_init method as an object
     * 
     * Usage:
     * 
     * <code>$role = new \Hybrid\Acl;
     * $role->add_resources('hello-world');</code>
     * 
     * @access  public
     */
    public function __construct() {}

    /**
     * List of roles
     * 
     * @access  protected
     * @var     array
     */
    protected $roles = array();
    
    /**
     * List of resources
     * 
     * @access  protected
     * @var     array
     */
    protected $resources = array();
    
    
    /**
     * List of ACL map between roles, resources and types
     * 
     * @access  protected
     * @var     array
     */
    protected $acl = array();

    /**
     * Verify whether current user has sufficient roles to access the resources based 
     * on available type of access.
     *
     * @access  public
     * @param   mixed   $resource
     * @param   string  $type need to be any one of deny, view, create, edit, delete or all
     * @return  bool
     */
    public function access($resource, $type = 'view') 
    {
        $types = static::$types;

        if (!in_array($resource, $this->resources)) 
        {
            return true;
        }

        $user    = \Hybrid\Auth::instance('user')->get();
        
        $type_id = array_search($type, $types);
        $length  = count($types);

        foreach ($user->roles as $role) 
        {
            if (!isset($this->acl[$role . '/' . $resource])) 
            {
                continue;
            }

            if ($this->acl[$role . '/' . $resource] == $type) 
            {
                return true;
            }

            for ($i = ($type_id + 1); $i < $length; $i++) 
            {
                if ($this->acl[$role . '/' . $resource] == $types[$i]) 
                {
                    return true;
                }
            }
        }

        return false;
    }

    /**
     * Verify whether current user has sufficient roles to access the resources based 
     * on available type of access.
     *
     * @access  public
     * @param   mixed   $resource
     * @param   string  $type need to be any one of static::$type
     * @return  bool
     * @see     \Hybrid\Acl::access()
     */
    public function access_status($resource, $type = 'view') 
    {

        switch ($this->access($resource, $type)) 
        {
            case true :
                return 200;
            break;
            case false :
                return 401;
            break;
        }
    }

    /**
     * Check if user has any of provided roles (however this should be in \Hybrid\User IMHO)
     * 
     * @static
     * @access  public
     * @param   mixed   $check_roles
     * @return  bool 
     */
    public static function has_roles($check_roles) 
    {
        $user = \Hybrid\Auth::instance('user')->get();

        if (!is_array($check_roles)) 
        {
            $check_roles = array($check_roles);
        }

        foreach ($user->roles as $role) 
        {
            $role = \Inflector::friendly_title($role, '-', TRUE);

            foreach ($check_roles as $check_against) 
            {
                if ($role == $check_against) 
                {
                    return true;
                }
            }
        }

        return false;
    }

    /**
     * Add new user roles to the this instance
     * 
     * @access  public
     * @param   mixed $roles
     * @return  bool
     */
    public function add_roles($roles = null) 
    {
        if (is_null($roles)) 
        {
            return false;
        }

        if (is_array($roles)) 
        {
            foreach ($roles as $role)
            {
                array_push($this->roles, trim(\Inflector::friendly_title($role, '-', true)));
            }

            return true;
        }

        if (is_string($roles)) 
        {
            array_push($this->roles, trim(\Inflector::friendly_title($roles, '-', true)));

            return true;
        }

        return false;
    }

    /**
     * Add new resource to this instance
     * 
     * @access  public
     * @param   mixed   $resources
     * @return  bool
     */
    public function add_resources($resources = null) 
    {
        if (is_null($resources)) 
        {
            return false;
        }

        if (is_array($resources)) 
        {
            foreach ($resources as $resource)
            {
                array_push($this->resources, trim(\Inflector::friendly_title($resource, '-', true)));
            }

            return true;
        }

        if (is_string($resources)) 
        {
            array_push($this->resources, trim(\Inflector::friendly_title($resources, '-', true)));

            return true;
        }

        return false;
    }

    /**
     * Assign single or multiple $roles + $resources to have $type access
     * 
     * @access  public
     * @param   mixed   $roles
     * @param   mixed   $resources
     * @param   string  $type
     * @return  bool
     * @throws  \Fuel_Exception
     */
    public function allow($roles, $resources, $type = 'view') 
    {
        if (!in_array($type, static::$types)) 
        {
            return false;
        }

        if (!is_array($roles)) 
        {
            $roles = array($roles);
        }

        if (!is_array($resources)) 
        {
            $resources = array($resources);
        }

        foreach ($roles as $role) 
        {
            $role = \Inflector::friendly_title($role, '-', true);

            if (!in_array($role, $this->roles)) 
            {
                throw new \Fuel_Exception("Role {$role} does not exist.");

                continue;
            }

            foreach ($resources as $resource) 
            {
                $resource = \Inflector::friendly_title($resource, '-', true);

                if (!in_array($resource, $this->resources)) 
                {
                    throw new \Fuel_Exception("Resource {$resource} does not exist.");

                    continue;
                }

                $id = $role . '/' . $resource;

                $this->acl[$id] = $type;
            }
        }

        return true;
    }

    /**
     * Shorthand function to deny access for single or multiple $roles and $resouces
     * 
     * @access  public
     * @param   mixed   $roles
     * @param   mixed   $resources
     * @return  bool
     */
    public function deny($roles, $resources) 
    {
        return $this->allow($roles, $resources, 'deny');
    }

}