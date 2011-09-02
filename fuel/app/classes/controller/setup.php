<?php

class Controller_Setup extends \Controller {
    
    /**
     * Should not be accessible
     *
     * @access  public
     * @return  void
     * @throws  \Request404Exception
     */
    public function action_index($step = null)
    {
        $this->action_install($step);
    }

    /**
     * Installation, consist of 3 step
     *
     * @access  public
     * @param   int     $step
     * @return  void
     * @throws  \Request404Exception
     */
    public function action_install($step = null)
    {
        $body = null;

        if (!is_numeric($step))
        {
            $step = 1;
        }
        
        $title  = "";

        switch ($step)
        {
            case 1 :
                $body = $this->step_1();
            break;

            case 2 :
                $this->check_status();
                $body = $this->step_2();
            break;

            case 3 :
                $body = $this->step_3();
            break; 

            default :
                throw new \Request404Exception();
            break;
        }
        
        $this->response->body = \View::factory('install/template', $body);
    }

    /**
     * Check database if user table already presented
     *
     * @final
     * @access  protected
     */
    protected final function check_status()
    {
        $user = \Model_User::find('all');

        if (!empty($user))
        {
            throw new \Request404Exception();
        }

        return true;
    }

    /**
     * Step 1: Setup Database (Run migration script)
     *
     * @access  protected
     * @return  array
     */
    protected function step_1()
    {
        $title  = "Step 1: Setup Database";
        $errors = array();

        try 
        {
            \Migrate::latest();
        }
        catch (\Database_Exception $e) 
        {
            array_push($errors, $e->getMessage());
        }

        $options = \Model_Option::query()->where('active', '=', 1)->get();

        if (!empty($options))
        {
            array_push($errors, "Setup already done, we can't reinstall without clearing the database");
        }
        
        return array(
            'title' => $title,
            'content' => \View::factory('install/step-1', array(
                'title'   => $title,
                'next'    => \Uri::create('setup/install/2'),
            )),
            'prev'    => null,
            'errors'  => $errors,
        );
    }

    /**
     * Step 2: Setup Administrator Account
     *
     * @access  protected
     * @return  array
     */
    protected function step_2()
    {
        $title  = "Step 2: Setup Administrator Account";
        $errors = array();

        $site_name = \Input::post('site_name', null);

        if (!is_null($site_name))
        {
            try
            {
                \Option::set('app.site_name', $site_name);
            }
            catch (\Fuel_Exception $e)
            {
                array_push($errors, $e->getMessage());
            }
        }
        else
        {
            array_push($errors, "Invalid site name");
        }

        if (empty($errors))
        {
            \Option::set('app.salt', \Str::random('alnum', 50));
        }
        
        return array(
            'title' => $title,
            'content' => \View::factory('install/step-2', array(
                'title'   => $title,
                'next'    => \Uri::create('setup/install/3'),
            )),
            'prev'    => \Uri::create('setup/install/1'),    
            'errors'  => $errors,
        );
    }

    /**
     * Step 3: Add user
     *
     * @access  protected
     * @return  array
     */
    protected function step_3()
    {
        $title  = "Step 3: Done";
        $errors = array();

        $username = \Input::post('username', null);
        $email    = \Input::post('email', null);
        $password = \Input::post('password', '');

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

        if (empty($errors))
        {
            $user = \Model_User::factory();

            $user->user_name  = $username;
            $user->full_name  = 'Administrator';
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

        return array(
            'title' => $title,
            'content' => \View::factory('install/step-3', array(
                'title'   => $title,
                'next'    => \Uri::create('/'),
            )),
            'prev'    => \Uri::create('setup/install/2'),
            'errors'  => $errors,
        );

    }

}