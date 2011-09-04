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
 * The Post Controller.
 * 
 * @package  app
 * @extends  \Hybrid\Controller_Template
 */

class Controller_Post extends \Hybrid\Controller_Template {
    
    public $template = 'frontend.default';

    /**
     * View single post action.
     *
     * @access  public
     * @return  void
     */
    public function action_index()
    {
        $post = null;
        
        switch (true)
        {
            case false !== $this->param('short_id') :
                $post = \Model_Post::query()
                    ->where('short_id', '=', $this->param('short_id'))
                    ->get_one();
            break;
            
            case false !== $this->param('id') :
                $post = \Model_Post::find(intval($this->param('id')));

                if (!in_array($this->param('slug'), array(false, $post->slug)))
                {
                    throw new \Request404Exception();
                }
            break;

            default :
                throw new \Request404Exception();
            break;
        }

        if (is_null($post))
        {
            throw new \Request404Exception();
            return ;
        }

        $type = "type_" . $post->type;
        $body = null;

        if (method_exists($this, $type))
        {
            $body = $this->{$type}($post);
        }
        else
        {
            throw new \Request404Exception();   
        }


        $this->response($body, 200);
    }

    /**
     * Fetch text post.
     *
     * @access  protected
     * @param   \Model_Post $post
     * @return  array
     */
    protected function type_text(\Model_Post $post)
    {
        $text = \Model_Posts_Text::query()
            ->where('post_id', '=', $post->id)
            ->get_one();

        if (is_null($text))
        {
            throw new \Request404Exception();
            return ;
        }
        
        return array(
            'title'   => $text->title,
            'content' => $this->template->partial('post/text', array(
                'title'   => $text->title,
                'content' => $text->content,
                'datum'   => $text,
                'post'    => $post,
            )),
        );
    }

    /**
     * Fetch link post.
     *
     * @access  protected
     * @param   \Model_Post $post
     * @return  array
     */
    protected function type_link(\Model_Post $post)
    {
        $link = \Model_Posts_Link::query()
            ->where('post_id', '=', $post->id)
            ->get_one();

        if (is_null($link))
        {
            throw new \Request404Exception();
            return ;
        }

        \Response::redirect($link->url, 'refresh');
    }
}