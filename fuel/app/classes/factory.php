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

    public static function inc($n, $pos = 0)
    {
        static $set = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789-_';
        static $setmax = 63;

        if (strlen($n) == 0)
        {
            // no string
            return $set[0];
        }

        $nindex = strlen($n) - 1 - $pos;
        if ($nindex < 0)
        {
            // add a new digit to the front of the number
            return $set[0] . $n;
        }

        $char = $n[$nindex];
        $setindex = strpos($set, $char);

        if ($setindex == $setmax)
        {
            $n[$nindex] = $set[0];
            return static::inc($n, $pos+1);
        }
        else
        {
            $n[$nindex] = $set[$setindex + 1];
            return $n;
        }
    }

}