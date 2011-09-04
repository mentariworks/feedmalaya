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

namespace FeedMalaya;

class Config {
    /**
     * Set Environment
     */
    const ENVIRONMENT = \Fuel::PRODUCTION;

    /**
     * Enable PHP Quick Profiler
     */
    const PROFILING   = false;

    /**
     * Database configuration
     */
    public static $database = array(
        'type'       => 'mysql',
        'connection' => array(
            'hostname'   => 'localhost',
            'database'   => 'feedmalaya_dev',
            'username'   => 'root',
            'password'   => '',
            'persistent' => false,
        ),
        'table_prefix' => '',
        'charset'      => 'utf8',
        'caching'      => true,
        'profiling'    => false,
    );

}