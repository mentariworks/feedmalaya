<?php

class Option {
    
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
    }
}