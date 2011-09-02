<?php

namespace Admin;

class Controller_Welcome extends \Hybrid\Controller_Hybrid {
    
    public function action_index()
    {
        if ($this->user->id < 1)
        {
            \Response::redirect('/login?redirect_to=/admin/welcome', 'refresh');
        }

        $posts = \Model_Post::query()
                ->where('status', 'NOT IN', array('delete'));

        \Config::load('pagination', 'pagination');

        $config = array(
            'pagination_url' => \Uri::create('admin/welcome/index/'),
            'total_items'    => $posts->count(),
            'per_page'       => 30,
            'uri_segment'    => 4,
            'template'       => \Config::get('pagination.template'),
        );

        \Hybrid\Pagination::set_config($config);

        $data = array(
            'posts' => $posts->limit(\Hybrid\Pagination::$per_page)
                ->offset(\Hybrid\Pagination::$offset)
                ->order_by(array('created_at' => 'DESC'))
                ->get(),
            'pagination' => \Hybrid\Pagination::create_links(),
        );
        
        $this->response(array(
            'content' => \View::factory('welcome/index', $data, false),
        ), 200);
    }

    public function action_404()
    {
        $messages      = array('Aw, crap!', 'Bloody Hell!', 'Uh Oh!', 'Nope, not here.', 'Huh?');
        $data['title'] = $messages[array_rand($messages)];
        $data['uri']   = \Uri::main();

        $this->response(array(
            'title'   => $data['title'],
            'content' => \View::factory('welcome/404', $data),
        ), 404);
    }

}