<?php

// Bootstrap the framework DO NOT edit this
require_once COREPATH.'bootstrap.php';


Autoloader::add_classes(array(
	// Add classes you want to override here
	// Example: 'View' => APPPATH.'classes/view.php',
));

// Register the autoloader
Autoloader::register();

if (false === Fuel::$is_cli)
{
    require_once DOCROOT.'config.php';
}
else
{
    require_once DOCROOT.'public/config.php';
}

// Initialize the framework with the config file.
Fuel::init(include(APPPATH.'config/config.php'));


/* End of file bootstrap.php */