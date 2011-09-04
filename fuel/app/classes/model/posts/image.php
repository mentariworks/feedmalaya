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
 
class Model_Posts_Image extends Orm\Model {

    protected static $_properties = array(
        'id',
        'post_id',
        'path',
        'caption',
        'updated_at',
    );

    protected static $_belongs_to = array(
        'posts' => array('model_to' => 'Model_Post'),
    );

    protected static $_observers = array(
        '\\Observer_UpdatedAt' => array('before_save'),
    );
}

/* End of file posts/image.php */