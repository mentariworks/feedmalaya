<?php

class Controller_Credential extends \Hybrid\Controller_Hybrid {

    public $template = 'frontend.default';
    
    public function action_login()
    {
        $this->response(array(
            'title'   => 'Login',
            'content' => $this->template->partial('static/login'),
        ), 200);
    }

    public function action_register()
    {
        
    }

    public function action_logout()
    {
        \Hybrid\Auth::logout();
    }

    public function post_login()
    {
        
    }

    public function post_register()
    {
        
    }

    public function post_logout()
    {
        
    }
}