<?php

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