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
        'updated_at',
    );

	protected static $_observers = array(
		'Observer_CreatedAt' => array('before_insert'),
		'Observer_UpdatedAt' => array('before_save'),
	);
}

/* End of file post.php */