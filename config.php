<?php

namespace FeedMalaya;

class Config {
    
    const ENVIRONMENT = \Fuel::DEVELOPMENT;

    public static $database = array(
        'type'          => 'mysql',
        'connection'    => array(
            'hostname'   => 'localhost',
            'database'   => 'kimy_dev',
            'username'   => 'root',
            'password'   => '',
            'persistent' => false,
        ),
        'table_prefix' => '',
        'charset'      => 'utf8',
        'caching'      => false,
        'profiling'    => true,
    );

}