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

/**
 * The Welcome Controller.
 * 
 * @package  app
 * @extends  \Hybrid\Controller_Template
 */

class Controller_Welcome extends \Hybrid\Controller_Template {
    
    public $template = 'frontend.default';

    /**
     * The index action.
     * 
     * @access  public
     * @return  void
     */
    public function action_index()
    {
        if (null !== $p = \Hybrid\Input::get('p', null))
        {
            $response = \Request::factory('p/' . $p)->execute();
            return $this->response->body = $response;
        }

        $this->response(array(
            'content' => $this->template->partial('static/welcome'),
        ), 200);
    }

    /**
     * The archive action.
     *
     * @access  public
     * @return  void
     * @throws  \Request404Exception
     */
    public function action_archive()
    {
        $title   = '';
        $channel = $this->param('channel');
        $year    = $this->param('year');
        $month   = $this->param('month');
        $day     = $this->param('day');

        $segment    = null;
        $prefix_uri = null;

        $query  = \Model_Post::query()
            ->where('status', 'IN', array('publish'));

        switch (true)
        {
            case false !== $channel :
                $title      = \Str::ucfirst($channel) ." Channel";
                $prefix_uri = \Uri::create('channel/' . $channel . '/page/');
                $segment    = 4;

                $query->where('type', '=', $channel);
            break;

            case false !== $day and false !== $month and false !== $year :
                $year  = intval($year);
                $month = intval($month);
                $day   = intval($day);
                $start = \Date::factory(mktime(0, 0, 0, $month, $day, $year))->format('mysql');
                $end   = \Date::factory(mktime(0, 0, 0, $month, ($day + 1), $year))->format('mysql');
                
                $title      = "Archive for " . \Date::factory(mktime(0, 0, 0, $month, $day, $year))->format('%B %d, %Y');
                $prefix_uri = \Uri::create('archive/' . \Date::factory(mktime(0, 0, 0, $month, $day, $year))->format('%Y/%m/%d') . '/page');
                $segment    = 6;
                
                $query->where('published_at', 'BETWEEN', array($start, $end));
            break;
            
            case false !== $month and false !== $year :
                $year  = intval($year);
                $month = intval($month);
                $start = \Date::factory(mktime(0, 0, 0, $month, 1, $year))->format('mysql');
                $end   = \Date::factory(mktime(0, 0, 0, ($month + 1), 1, $year))->format('mysql');

                $title      = "Archive for " . \Date::factory(mktime(0, 0, 0, $month, 1, $year))->format('%B %Y');
                $prefix_uri = \Uri::create('archive/' . \Date::factory(mktime(0, 0, 0, $month, $day, $year))->format('%Y/%m') . '/page');
                $segment    = 5;

                $query->where('published_at', 'BETWEEN', array($start, $end));
            break;

            case false !== $year :
                $year  = intval($year);
                $month = intval($month);
                $start = \Date::factory(mktime(0, 0, 0, 1, 1, $year))->format('mysql');
                $end   = \Date::factory(mktime(0, 0, 0, 1, 1, ($year + 1)))->format('mysql');
                
                $title      = "Archive for " . \Date::factory(mktime(0, 0, 0, 1, 1, $year))->format('%Y');
                $prefix_uri = \Uri::create('archive/' . \Date::factory(mktime(0, 0, 0, $month, $day, $year))->format('%Y') . '/page');
                $segment    = 4;

                $query->where('published_at', 'BETWEEN', array($start, $end));
            break;

            default :
                $title      = "Archive";
                $prefix_uri = \Uri::create('archive/page');
                $segment    = 3;
            break;
        }

        if ($query->count() < 1)
        {
            throw new \Request404Exception();
        }

        \Config::load('pagination', 'pagination');

        $config = array(
            'pagination_url' => $prefix_uri,
            'total_items'    => $query->count(),
            'per_page'       => 1,
            'uri_segment'    => $segment,
        );

        \Hybrid\Pagination::set_config($config);

        $query->limit(\Hybrid\Pagination::$per_page)
                ->offset(\Hybrid\Pagination::$offset);

        $data = array(
            'posts'      => $query->get(),
            'pagination' => \Hybrid\Pagination::create_links(),
        );

        $this->response(array(
            'title'   => $title,
            'content' => $this->template->partial('static/archive', $data),
        ), 200);
    }

    /**
     * The 404 action for the application.
     * 
     * @access  public
     * @return  void
     */
    public function action_404()
    {
        $messages      = array('Aw, crap!', 'Bloody Hell!', 'Uh Oh!', 'Nope, not here.', 'Huh?');
        $data['title'] = $messages[array_rand($messages)];
        $data['uri']   = \Uri::main();

        // Set a HTTP 404 output header
        $this->response(array(
            'title'   => $data['title'],
            'content' => $this->template->partial('404', $data),
        ), 404);
    }

}