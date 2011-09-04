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
 
class Model_User extends Orm\Model {
	
    protected static $_properties = array(
        'id',
        'user_name',
        'full_name',
        'email',
        'status',
    );

    protected static $_has_one = array(
        'auths'     => array('model_to' => 'Model_Users_Auth'),
        'facebooks' => array('model_to' => 'Model_Users_Facebook'),
        'meta'      => array('model_to' => 'Model_Users_Metum'),
        'twitters'  => array('model_to' => 'Model_Users_Twitter'), 
    );

    protected static $_has_many = array(
        'roles'     => array('model_to' => 'Model_Users_Role'),
    );

}

/* End of file user.php */