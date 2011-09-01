<?php

class Model_Users_Metum extends Orm\Model {

    protected static $_properties = array(
        'id',
        'user_id',
        'first_name',
        'last_name',
        'create_at',
        'updated_at',
    );

    protected static $_belongs_to = array(
        'users' => array('model_to' => 'Model_User'),
    );

	protected static $_observers = array(
		'Observer_CreatedAt' => array('before_insert'),
		'Observer_UpdatedAt' => array('before_save'),
	);

}

/* End of file users/metum.php */