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

/**
 * The Profile Controller.
 * 
 * @package  app
 * @extends  \Hybrid\Controller_Template
 */

class Controller_People extends \Hybrid\Controller_Template {
    
    public $template = 'frontend.default';

    /**
     * The user profile action.
     *
     * @access  public
     * @param   string  $username   A string of registered username
     * @return  void
     * @throws  \Request404Exception
     */
    public function action_index($username = null)
    {
        if ($this->user->id < 1)
        {
            throw new \Request404Exception();
        }

        
    }

    /**
     * Own profile action.
     * 
     * @access  public
     * @return  self::action_index
     */
    public function action_me()
    {
        return $this->action_index($this->user->user_name);
    }
    
}