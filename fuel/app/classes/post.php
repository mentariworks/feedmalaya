<?php

class Post {
    
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