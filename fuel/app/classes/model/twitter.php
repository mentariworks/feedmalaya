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
 
class Model_Twitter extends Orm\Model {
	
    protected static $_properties = array(
		'id',
        'twitter_name',
        'full_name',
        'profile_image',
	);

    protected static $_has_one = array(
        'users'     => array('model_to' => 'Model_Users_Twitter'),
    );

}

/* End of file twitter.php */