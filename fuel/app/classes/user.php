<?php

class User {
    
    /**
     * Validate username format
     *
     * @static
     * @access  public
     * @param   string  $name
     * @return  bool
     * @throws  \Fuel_Exception
     */
    public static function check_username($name)
    {
        if (empty($name))
        {
            throw new \Fuel_Exception("Username can't be empty");
        }

        $name = strval($name);

        // check length of username
        if (2 > strlen(trim($name)))
        {
            throw new \Fuel_Exception("Username should consist of 2 or more character");
        }

        if (preg_match('/^([A-Za-z0-9\_]*)$/', $name, $matches))
        {
            return true;
        }
        else 
        {
            throw new \Fuel_Exception("Username should only consist alphanumeric");
        }

        return true;
    }

    /**
     * Validate e-mail address
     *
     * @static
     * @access  public
     * @param   string  $address
     * @return  bool
     * @throws  \Fuel_Exception
     */
    public static function check_email($address)
    {
        if (false == filter_var($address, FILTER_VALIDATE_EMAIL))
        {
            throw new \Fuel_Exception("Invalid e-mail address");
        }

        return true;
    }
}