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

class Factory {

    protected static $initiated = false;
    
    /**
     * Initiate this during first call.
     *
     * @static
     * @access  public
     */
    public static function _init()
    {
        if (false !== static::$initiated)
        {
            return;
        }

        \Config::load('app', 'app');

        try 
        {
            \Option::init();
        }
        catch (\Fuel_Exception $e)
        {
            \Log::error($e->getMessage());
        }

        \Event::register('load_acl', '\\Factory::load_acl');

        static::$initiated = true;
    }

    public static function load_acl()
    {
        $acl   = \Hybrid\Acl::factory();
        
        $roles = \Model_Role::query()
                    ->where('active', '=', 1)->get();

        foreach ($roles as $role) 
        {
            $acl->add_roles(\Inflector::friendly_title($role->name, '-', true));
        }

        $acl->add_roles('guest');

        $acl->add_resources(array(
            'admin/dashboard',
            'admin/post',
            'admin/user',
            'admin/account',
        ));

        $acl->allow('administrator', array('admin/dashboard', 'admin/post', 'admin/user'), 'all');
        $acl->allow('editor', array('admin/dashboard', 'admin/post'), 'all');
        $acl->allow(array('administrator', 'editor', 'contributor', 'follower'), array('admin/account'), 'all');
        
        return true;
    }

}