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

class Model_Post extends Orm\Model {

    protected static $_properties = array(
        'id',
        'user_id',
        'short_id',
        'slug',
        'type',
        'status',
        'created_at',
        'published_at',
    );

    protected static $_belongs_to = array(
        'users' => array('model_to' => 'Model_User'),
    );

    protected static $_has_one = array(
        'texts' => array('model_to' => 'Model_Posts_Text'),
        'links' => array('model_to' => 'Model_Posts_Link'),
    );

    protected static $_observers = array(
        '\\Observer_CreatedAt' => array('before_insert'),
    );

    public static function latest($limit = 30)
    {
        return static::query()
            ->related('users')
            ->where('status', 'IN', array('publish'))
            ->where('published_at', '<=', \Date::time()->format('mysql'))
            ->order_by(array('published_at' => 'DESC'))
            ->limit($limit)
            ->get();
    }
}

/* End of file post.php */