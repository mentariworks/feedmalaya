<?php
return array(
    '_root_'  => 'welcome/index',  // The default route
    '_404_'   => 'welcome/404',    // The main 404 route

    'page/:number'          => 'site/index',

    'p/:short_uri'          => 'site/post',
    'post/:id/:long_uri'    => 'site/post',
    'post/:id'              => 'site/post',
    
    /**
     * This is an example of a BASIC named route (used in reverse routing).
     * The translated route MUST come first, and the 'name' element must come
     * after it.
     */
    // 'foo/bar' => array('welcome/foo', 'name' => 'foo'),
);