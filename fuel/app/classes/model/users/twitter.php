<?php

class Model_Users_Twitter extends Orm\Model {
	
    protected static $_properties = array(
		'id',
        'user_id',
        'twitter_id',
	);

    protected static $_belongs_to = array(
        'twitters'  => array('model_to' => 'Model_Twitter'),
        'users'     => array('model_to' => 'Model_User'),
    );

}

/* End of file users/twitter.php */