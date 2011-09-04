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

        static::$initiated = true;
    }

    /**
     * Generate next short_id.
     *
     * @static
     * @access  public
     * @param   string  $n
     * @param   int     $pos
     * @return  string
     */
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