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
        if (true === \Hybrid\Auth_User::instance()->is_logged())
        {
            \Response::redirect('/');    
        }

        $this->response(array(
            'title'   => 'Register',
            'content' => $this->template->partial('static/register'),
        ), 200);
    }

    public function action_logout()
    {
        \Hybrid\Auth::logout(true);

        \Response::redirect('/');
    }

    public function post_login()
    {
        $username    = \Hybrid\Input::post('username');
        $password    = \Hybrid\Input::post('password');
        $redirect_to = \Uri::create(\Hybrid\Input::post('redirect_to', '/welcome'));

        try {
            \Hybrid\Auth_User::instance()->login($username, $password);

            $this->response(array(
                'success'  => true,
                'redirect' => $redirect_to,
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
        $errors = array();

        $username = \Hybrid\Input::post('username', '');
        $email    = \Hybrid\Input::post('email', '');
        $password = \Hybrid\Input::post('password', '');

        try 
        {
            \User::check_username($username);
        }
        catch (\Fuel_Exception $e)
        {
            array_push($errors, $e->getMessage());
        }

        try 
        {
            \User::check_email($email);
        }
        catch (\Fuel_Exception $e)
        {
            array_push($errors, $e->getMessage());
        }

        $user = \Model_User::query()
            ->where('user_name', '=', $username)
            ->or_where('email', '=', $email)
            ->get_one();

        if (!is_null($user))
        {
            switch (true)
            {
                case $user->user_name == $username :
                    array_push($errors, "Username already exist");
                break;

                case $user->email == $email :
                    array_push($errors, "E-mail address already exist");
                break;
            }
        }

        if (!empty($errors))
        {
            return $this->response(array(
                'errors' => $errors
            ), 400);
        }
        else
        {
            $user = \Model_User::factory();

            $user->user_name  = $username;
            $user->full_name  = $username;
            $user->email      = $email;
            $user->status     = 'verified';
            $user->save();
            
            $auth             = \Model_Users_Auth::factory();
            $auth->user_id    = $user->id;
            $auth->password   = \Hybrid\Auth::add_salt($password);
            $auth->save();
            
            $role             = \Model_Users_Role::factory();
            $role->user_id    = $user->id;
            $role->role_id    = 4;
            $role->save();
            
            $meta             = \Model_Users_Metum::factory();
            $meta->user_id    = $user->id;
            $meta->first_name = '';
            $meta->last_name  = '';
            $meta->save();
        }

        $this->response(array(
            'success' => true,
            'text' => "User {$username} registered",
            'redirect' => \Uri::create('/')
        ), 200);
    }

    public function post_logout()
    {
        
    }
}