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
 * @category    Controller_Hybrid
 * @abstract
 * @author      Mior Muhammad Zaki <crynobone@gmail.com>
 */
 
abstract class Controller_Hybrid extends \Fuel\Core\Controller {
    
    /**
     * Set whether the request is either rest or template
     * 
     * @access  protected
     * @var     bool
     */
    protected $is_rest_call         = true;

    /**
     * Rest format to be used
     * 
     * @access  protected
     * @var     string
     */
    protected $rest_format          = null;
    
    /**
     * Set the default content type using PHP Header
     * 
     * @access  protected
     * @var     bool
     */
    protected $set_content_type     = true;
    
    /**
     * Page template
     * 
     * @access  public
     * @var     string
     */
    public $template                = 'normal';
    
    /**
     * Auto render template
     * 
     * @access  public
     * @var     bool    
     */
    public $auto_render             = true;

    /**
     * Run ACL check and redirect user automatically if user doesn't have the privilege
     * 
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
                if ($this->is_rest_call === true)
                {
                    $this->response(array('text' => "You doesn't have privilege to do this action"), 401);
                    print $this->response->body;
                    exit();
                }
                else
                {
                    throw new \Request404Exception();
                }
            break;
        }
    }

    /**
     * This method will be called before we route to the destinated method
     * 
     * @access public
     */
    public function before() 
    {
        $this->is_rest_call = \Hybrid\Restful::is_rest_call();

        if (true === $this->is_rest_call)
        {
            \Fuel::$profiling = false;
        }

        $this->language     = \Hybrid\Factory::get_language();
        $this->user         = \Hybrid\Auth::instance('user')->get();

        \Event::trigger('controller_before');

        if (false === $this->is_rest_call)
        {   
            $this->prepare_template();
        }
        else 
        {
            $this->prepare_rest();
        }

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
        
        if (false === $this->is_rest_call)
        {
            $this->render_template();
        }
        else 
        {
            $this->render_rest();
        }

        return parent::after();
    }

    /**
     * Requests are not made to methods directly The request will be for an "object".
     * this simply maps the object and method to the correct Controller method.
     * 
     * @access  public
     * @param   Request $resource
     * @param   array   $arguments
     */
    public function router($resource, $arguments) 
    {
        $pattern = \Hybrid\Restful::$pattern;
        
        // Remove the extension from arguments too
        $resource = preg_replace($pattern, '', $resource);
        
        // If they call user, go to $this->post_user();
        $controller_method = strtolower(\Hybrid\Input::method()) . '_' . $resource;
        
        if (\method_exists($this, $controller_method) and true === $this->is_rest_call) 
        {
            call_user_func(array($this, $controller_method));
        }
        elseif (\method_exists($this, 'action_' . $resource)) 
        {
            if (true === $this->is_rest_call)
            {
                $this->response->status = 404;
                return;
            }

            call_user_func(array($this, 'action_' . $resource), $arguments);
        }
        else 
        {
            if (true === $this->is_rest_call)
            {
                $this->response->status = 404;
                return;
            }
            else
            {
                throw new \Request404Exception();
            }
        }
    }

    /**
     * Takes pure data and optionally a status code, then creates the response
     * 
     * @access  protected
     * @param   array   $data
     * @param   int     $http_code
     */
    protected function response($data = array(), $http_code = 200) 
    {
        if (true === $this->is_rest_call)
        {
            $rest = \Hybrid\Restful::factory($data, $http_code)
                        ->format($this->rest_format)
                        ->execute();
            
            $this->response->body($rest->body);
            $this->response->status = $rest->status;

            if (true === $this->set_content_type) 
            {
                // Set the correct format header
                $this->response->set_header('Content-Type', \Hybrid\Restful::content_type($rest->format));
            }
        }
        else 
        {
            $this->response->status = $http_code;
            
            $this->template->set($data);
        }
    }
    
    /**
     * Prepare template
     * 
     * @access  protected
     */
    protected function prepare_template()
    {
        if (true === $this->auto_render)
        {
            $this->template = \Hybrid\Template::factory($this->template);
        }
    }
    
    /**
     * Render the template
     * 
     * @access  protected
     */
    protected function render_template()
    {
        //we dont want to accidentally change our site_name
        $this->template->set(array('site_name' => \Config::get('app.site_name')));
        
        if (true === $this->auto_render)
        {
            $this->response->body($this->template->render());
        }
    }
    
    /**
     * Prepare Restful
     * 
     * @access  protected
     */
    protected function prepare_rest()
    {
        if (\Hybrid\Request::main() !== \Hybrid\Request::active()) 
        {
            $this->set_content_type = false;
        }

        \Hybrid\Restful::auth();
    }
    
    /**
     * Render Restful
     * 
     * @access  protected
     */
    protected function render_rest() {}
    
}