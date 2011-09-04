<?php

/**
 * FeedMalaya 
 * Share everything, a great combination of Forrst, Tumblr and Google Reader
 *
 * @package    FeedMalaya
 * @version    2.0
 * @author     FeedMalaya Development Team
 * @license    GPLv2 License (or later)
 * @link       http://github.com/mentariworks/feedmalaya
 */

class Option {

    protected static $initiated = false;

    /**
     * Load option.
     *
     * @static 
     * @access  public
     */
    public static function init()
    {
        if (true === static::$initiated)
        {
            return ;
        }

        $options = \Model_Option::query()
            ->where('active', '=', 1)
            ->get();
        
        foreach ($options as $option)
        {
            \Config::set($option->name, $option->value);
        }

        static::$initiated = true;
    }
    
    /**
     * Update option.
     *
     * @static
     * @access  public
     * @param   string  $name
     * @param   string  $value
     * @return  bool
     */
    public static function set($name, $value)
    {
        $option         = \Model_Option::find_by_name($name);
            
        if (is_null($option))
        {
            $option       = \Model_Option::factory();
            $option->name = $name;
        }

        $option->value  = $value;
        $option->active = 1;
        $option->save();

        \Config::set($name, $value);

        return true;
    }
}