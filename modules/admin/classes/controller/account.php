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
 * The Welcome Controller.
 * 
 * @package  admin
 * @extends  \Hybrid\Controller_Hybrid
 */

class Controller_Account extends \Hybrid\Controller_Hybrid {
    
    public function action_index()
    {
        
    }

    public function action_password()
    {
        $data = array(
            'title' => "Change Your Password",
        );

        return $this->response(array(
            'title'   => $data['title'],
            'content' => \View::factory('account/password', $data),
            'user'    => $this->user,
        ), 200);
    }

    public function post_password()
    {
        $errors           = array();
        $current_password = \Hybrid\Input::post('current_password');
        $new_password     = \Hybrid\Input::post('new_password');
        $confirm_password = \Hybrid\Input::post('confirm_password');

        $auth = \Model_Users_Auth::query()
                ->where('user_id', '=', $this->user->id)
                ->get_one();

        if (is_null($auth))
        {
            return $this->response(array(), 404);
        }

        if ($auth->password !== \Hybrid\Auth::add_salt($current_password))
        {
            $errors['current_password'] = "Current password is not correct";
        }

        if (empty($new_password))
        {
            $errors['new_password'] = "New password can't be empty";
        }

        if ($new_password !== $confirm_password)
        {
            $errors['confirm_password'] = "Confirm password should be the same with new password";
        }

        if (!empty($errors))
        {
            return $this->response(array(
                'field_errors' => $errors,
            ), 400);
        }

        $auth->password = \Hybrid\Auth::add_salt($new_password);
        $auth->save();

        // re-login
        \Hybrid\Auth::instance()->login($this->user->user_name, $new_password);

        return $this->response(array(
            'success'  => true,
            'text'     => 'Password changed',
            'redirect' => \Uri::create('admin')
        ), 200);

    }

}