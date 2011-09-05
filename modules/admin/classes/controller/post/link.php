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
 * The Post (Link) Controller.
 * 
 * @package  admin
 * @extends  Controller_Post
 */

class Controller_Post_Link extends Controller_Post {
    
    /**
     * Create new post action.
     * 
     * @access  public
     * @return  void
     */
    public function action_new()
    {
        $data = array(
            'title' => 'Post New Link',
            'post'  => \Model_Post::factory(),
            'link'  => \Model_Posts_Link::factory(),
        );
        
        return $this->response(array(
            'title'   => $data['title'],
            'content' => \View::factory('post/link', $data),
        ), 200);
    }

    public function action_edit($params = null)
    {
        $id   = $params[0];

        $data = array(
            'title' => 'Edit Link',
            'post'  => \Model_Post::find($id),
            'link'  => \Model_Posts_Link::query()->where('post_id', '=', $id)->get_one(),
        );

        return $this->response(array(
            'title'   => $data['title'],
            'content' => \View::factory('post/link', $data),
        ), 200);
    }

    public function post_new()
    {
        return $this->post_edit();
    }

    public function post_edit()
    {
        $errors = array();
        $id     = \Hybrid\Input::post('id', null);
        
        $post   = \Model_Post::find($id);

        if ((is_null($post) or !is_numeric($id)))
        {
            $post = \Model_Post::factory();
            $link = \Model_Posts_Link::factory();
            
            // find last short_id
            $last_short_id      = \Config::get('app.last_short_id', '');
            $post->short_id     = \Post::inc($last_short_id);
            $post->published_at = \Date::time()->format('mysql');

            \Option::set('app.last_short_id', $post->short_id);
        }
        else
        {
            $link = \Model_Posts_Link::query()->where('post_id', '=', $id)->get_one();
        }

        $title   = \Hybrid\Input::post('title', '');
        $content = \Hybrid\Input::post('content', '');
        $url     = \Hybrid\Input::post('url', '');
    
        if (empty($title))
        {
            $errors['title']    = "Please fill in the title";
        }

        if (empty($url))
        {
            $errors['url']      = "Please fill in the URL";
        }

        if (!empty($errors))
        {
            return $this->response(array(
                'field_errors' => $errors,
            ), 400);
        }
        
        $post->slug         = \Inflector::friendly_title($title, '-', true);
        $post->type         = 'link';
        $post->user_id      = $this->user->id;
        $post->status       = \Hybrid\Input::post('status');
        $post->save();

        $link->post_id      = $post->id;
        $link->title        = $title;
        $link->content      = $content;
        $link->url          = $url;
        $link->save();

        return $this->response(array(
            'success' => true,
            'redirect' => \Uri::create('admin/welcome'),
        ), 200);
    }
}