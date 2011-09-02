<?php

class Model_Option extends Orm\Model {

    protected static $_properties = array(
        'id',
        'name',
        'value',
        'active',
        'created_at',
        'updated_at',
    );

    protected static $_observers = array(
        '\\Observer_CreatedAt' => array('before_insert'),
        '\\Observer_UpdatedAt' => array('before_save'),
    );

}

/* End of file option.php */