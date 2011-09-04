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