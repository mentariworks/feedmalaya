<?php

class Model_Users_Auth extends Orm\Model {
	
    protected static $_properties = array(
		'id',
        'user_id',
        'password',
    );

    protected static $_belongs_to = array(
        'users'  => array('model_to' => 'Model_User'),
    );

}

/* End of file users/auth.php */