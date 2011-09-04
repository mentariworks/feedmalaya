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

class Controller_Welcome extends \Hybrid\Controller_Hybrid {
    
    /**
     * The dashboard action.
     *
     * @access  public
     * @return  void
     */
    public function action_index()
    {
        if ($this->user->id < 1)
        {
            // If user is not logged in, force them to login first
            \Response::redirect('/login?redirect_to=/admin/welcome', 'refresh');
        }

        $posts = \Model_Post::query()
                    ->where('status', 'NOT IN', array('delete'));

        \Config::load('pagination', 'pagination');

        \Hybrid\Pagination::set_config(array(
            'pagination_url' => \Uri::create('admin/welcome/index/'),
            'total_items'    => $posts->count(),
            'per_page'       => 30,
            'uri_segment'    => 4,
            'template'       => \Config::get('pagination.template'),
        ));

        $data = array(
            'posts'      => $posts->limit(\Hybrid\Pagination::$per_page)
                                ->offset(\Hybrid\Pagination::$offset)
                                ->order_by(array('created_at' => 'DESC'))
                                ->get(),
            'pagination' => \Hybrid\Pagination::create_links(),
        );
        
        return $this->response(array(
            'title'   => 'Dashboard',
            'content' => \View::factory('welcome/index', $data, false),
        ), 200);
    }

    /**
     * The default 404 for admin module.
     * 
     * @access  public
     * @return  void
     */
    public function action_404()
    {
        $messages      = array('Aw, crap!', 'Bloody Hell!', 'Uh Oh!', 'Nope, not here.', 'Huh?');
        $data['title'] = $messages[array_rand($messages)];
        $data['uri']   = \Uri::main();

        return $this->response(array(
            'title'   => $data['title'],
            'content' => \View::factory('welcome/404', $data),
        ), 404);
    }

}