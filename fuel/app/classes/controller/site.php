<?php

class Controller_Site extends \Hybrid\Controller_Template {
    
    public $template = 'frontend.default';

    public function action_index()
    {
        $this->response(array(
            'content' => '',
        ), 200);
    }
    
}