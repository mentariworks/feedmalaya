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
 
namespace Admin;

/**
 * The Post Controller.
 * 
 * @package  admin
 * @extends  \Hybrid\Controller_Hybrid
 */

class Controller_Post extends \Hybrid\Controller_Hybrid {
    
    /**
     * Create new post action.
     *
     * @access  public
     * @return  void
     */
    public function action_new() 
    {
        $request = \Request::factory('admin/post/link/new')->execute();
        return $this->response->body = $request;
    }

}