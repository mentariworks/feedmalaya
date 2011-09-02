<?php
return array(
    '_root_'                  => 'welcome/index',       // The default route
    '_404_'                   => 'welcome/404',      // The main 404 route
    
    '(login|register|logout)' => 'credential/$1',

    'channel/:channel'        => 'welcome/archive',
    
    'page/:number'            => 'welcome/index',
    
    'people/(:segment)'       => 'people/index',
    'me'                      => 'people/me',

    'p/:short_uri'            => 'post/index',
    'post/:id/:long_uri'      => 'post/index',
    'post/:id'                => 'post/index',
    
    /**
     * This is an example of a BASIC named route (used in reverse routing).
     * The translated route MUST come first, and the 'name' element must come
     * after it.
     */
    // 'foo/bar' => array('welcome/foo', 'name' => 'foo'),
);