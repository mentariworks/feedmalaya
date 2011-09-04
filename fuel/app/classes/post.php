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

class Post {
    
    /**
     * Get post title.
     *
     * @static
     * @access  public
     * @param   \Model_Post     $post
     * @return  string
     */
    public static function title(\Model_Post $post)
    {
        $relations = \Inflector::pluralize($post->type);

        return $post->{$relations}->title;

    }

    /**
     * Get post content.
     *
     * @static
     * @access  public
     * @param   \Model_Post     $post
     * @return  string
     */
    public static function content(\Model_Post $post)
    {
        $relations = \Inflector::pluralize($post->type);
        $content   = '';

        if (isset($post->{$relations}->content))
        {
            $content = $post->{$relations}->content;
        }

        return \Hybrid\Parser::factory('markdown')->parse($content);
    }

    /**
     * Generate post excerpt.
     *
     * @static
     * @access  public
     * @param   \Model_Post     $post
     * @param   int             $limit
     * @param   bool            $is_html
     * @return  string
     */
    public static function excerpt(\Model_Post $post, $limit = 150, $is_html = true)
    {
        $content = static::content($post);

        if (false == $is_html)
        {
            $content = strip_tags($content);
        }

        return \Str::truncate($content, $limit, '...');
    }

    /**
     * Generate post URL.
     *
     * @static
     * @access  public
     * @param   \Model_Post     $post
     * @param   bool            $short_id
     * @return  void
     */
    public static function uri(\Model_Post $post, $short_id = false)
    {
        $uri = 'p/' . $post->short_id;

        if (false === $short_id)
        {
            $uri = 'post/' . $post->id . '/' . $post->slug;
        }

        return \Uri::create($uri);

    }
    
}