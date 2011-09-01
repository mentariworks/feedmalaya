<?php

class Model_Facebook extends Orm\Model {

	protected static $_properties = array(
        'id',
        'facebook_name',
        'first_name',
        'last_name',
        'facebook_url',
    );

    protected static $_has_one = array(
        'users'     => array('model_to' => 'Model_Users_Facebook'),
    );
    
}

/* End of file facebook.php */