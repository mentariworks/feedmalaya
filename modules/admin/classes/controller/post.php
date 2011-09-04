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

    public function delete_index()
    {
        $id = \Hybrid\Input::delete('id');

        $post = \Model_Post::find($id);

        if (is_null($post) or !is_numeric($id))
        {
            return $this->response(array(
                'text' => 'Invalid post',
            ), 401);
        }

        $post->status = 'delete';
        $post->save();

        return $this->response(array(
                'success'  => true,
                'text'     => "Post #{$id} deleted",
                'redirect' => \Uri::create('admin/welcome'),
            ), 200);
    }

}