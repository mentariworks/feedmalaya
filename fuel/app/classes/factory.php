<?php

class Factory {

    protected static $initiated = false;
    
    public static function _init()
    {
        if (false !== static::$initiated)
        {
            return;
        }

        \Config::load('app', 'app');

        try 
        {
            static::load_config();
        }
        catch (\Fuel_Exception $e)
        {
            \Log::error($e->getMessage());
        }

        static::$initiated = true;
    }

    public static function load_config()
    {
        $options = \Model_Option::query()->where('active', '=', 1)->get();
        
        foreach ($options as $option)
        {
            \Config::set($option->name, $option->value);
        }
    }

}