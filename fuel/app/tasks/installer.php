<?php

namespace Fuel\Tasks;

class Installer {

    public static function run()
    {
        \Migrate::latest();
        \Cli::write("Migrate to the latest version: " . \Config::get('migrations.version'), 'green');

        // setup options table

        # 1: set site name
        if ($site_name = \Cli::prompt("Set site name")) 
        {
            \Option::set('app.site_name', $site_name);
        }


        $users = \Model_User::query()->get();

        if (!empty($users))
        {
            throw new \Fuel_Exception("Please make sure the user table is empty before running this script.");
        }
        else 
        {
            static::user_installation();
        }

    }
    
    protected static function user_installation()
    {
        # 1: Set salt
        \Option::set('app.salt', \Str::random('alnum', 50));

        $datetime = \Date::time()->format('mysql');
        # 1: add roles
        $roles = array (
            array('name' => 'Reader', 'active' => 1),
            array('name' => 'Contributor', 'active' => 1),
            array('name' => 'Editor', 'active' => 1),
            array('name' => 'Administrator', 'active' => 1),
        );

        foreach ($roles as $role)
        {
            \DB::insert('roles')->set($role)->execute();
        }

        if ($username = \Cli::prompt("Set default username"))
        {
            if ($email = \Cli::prompt("Set default e-mail address"))
            {
                $user = \Model_User::factory();

                $user->user_name = $username;
                $user->full_name = 'Administrator';
                $user->email     = $email;
                $user->status    = 'verified';
                $user->save();

                $auth           = \Model_Users_Auth::factory();
                $auth->user_id  = $user->id;
                $auth->password = \Hybrid\Auth::add_salt('123');
                $auth->save();

                $role          = \Model_Users_Role::factory();
                $role->user_id = $user->id;
                $role->role_id = 4;
                $role->save();

                $meta             = \Model_Users_Metum::factory();
                $meta->user_id    = $user->id;
                $meta->first_name = '';
                $meta->last_name  = '';
                $meta->save();
            }
        }
    }
}