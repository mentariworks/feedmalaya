<?php

class Model_Users_Facebook extends Orm\Model {
	
    protected static $_properties = array(
        'id',
        'user_id',
        'facebook_id',
    );

    protected static $_belongs_to = array(
        'facebooks' => array('model_to' => 'Model_Facebook'),
        'users'     => array('model_to' => 'Model_User'),
    );

}

/* End of file users/facebook.php */