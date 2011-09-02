<?php

class Controller_Credential extends \Hybrid\Controller_Hybrid {

    public $template = 'frontend.default';
    
    public function action_login()
    {
        if (true === \Hybrid\Auth_User::instance()->is_logged())
        {
            \Response::redirect('/');    
        }

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
        $username = \Hybrid\Input::post('username');
        $password = \Hybrid\Input::post('password');

        try {
            \Hybrid\Auth_User::instance()->login($username, $password);

            $this->response(array(
                'success'  => true,
                'redirect' => \Uri::create('/'),
            ), 200);
        }
        catch (\Fuel_Exception $e)
        {
            $this->response(array(
                'text' => $e->getMessage(),
            ), 400);
        }
    }

    public function post_register()
    {
        
    }

    public function post_logout()
    {
        
    }
}