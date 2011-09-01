<?php

class Model_Role extends Orm\Model {

	protected static $_properties = array(
		'id',
        'name',
        'active',
	);

    protected static $_has_many = array(
        'users' => array('model_to' => 'Model_Users_Role'),
    );

}

/* End of file role.php */