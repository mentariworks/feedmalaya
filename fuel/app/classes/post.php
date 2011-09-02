<?php

class Post {
    
    public static function latest($limit = 10)
    {
        return \Model_Post::query()
            ->related('users')
            ->where('status', 'IN', array('publish'))
            ->where('published_at', '<=', \Date::time()->format('mysql'))
            ->order_by(array('published_at' => 'DESC'))
            ->limit($limit)
            ->get();
    }

    public static function title(\Model_Post $post)
    {
        $relations = \Inflector::pluralize($post->type);

        return $post->{$relations}->title;

    }

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

    public static function excerpt(\Model_Post $post, $limit = 150, $is_html = true)
    {
        $content = static::content($post);

        if (false == $is_html)
        {
            $content = strip_tags($content);
        }

        return \Str::truncate($content, $limit, '...');
    }

    public static function uri(\Model_Post $post, $short_uri = false)
    {
        $uri = 'p/' . $post->short_uri;

        if (false === $short_uri)
        {
            $uri = 'post/' . $post->id . '/' . $post->long_uri;
        }

        return \Uri::create($uri);

    }
    
}