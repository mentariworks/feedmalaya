<?php

class Model_Post extends Orm\Model {

    protected static $_properties = array(
        'id',
        'user_id',
        'short_uri',
        'long_uri',
        'type',
        'status',
        'created_at',
        'published_at',
    );

    protected static $_belongs_to = array(
        'users' => array('model_to' => 'Model_User'),
    );

    protected static $_observers = array(
        '\\Observer_CreatedAt' => array('before_insert'),
    );
}

/* End of file post.php */