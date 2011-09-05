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

    /**
     * Generate next short_id.
     *
     * @static
     * @access  public
     * @param   string  $n
     * @param   int     $pos
     * @return  string
     */
    public static function inc($n, $pos = 0)
    {
        static $set = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789-_';
        static $setmax = 63;

        if (strlen($n) == 0)
        {
            // no string
            return $set[0];
        }

        $nindex = strlen($n) - 1 - $pos;
        if ($nindex < 0)
        {
            // add a new digit to the front of the number
            return $set[0] . $n;
        }

        $char = $n[$nindex];
        $setindex = strpos($set, $char);

        if ($setindex == $setmax)
        {
            $n[$nindex] = $set[0];
            return static::inc($n, $pos+1);
        }
        else
        {
            $n[$nindex] = $set[$setindex + 1];
            return $n;
        }
    }
    
}