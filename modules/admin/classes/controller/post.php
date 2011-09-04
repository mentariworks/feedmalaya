<?php

namespace Admin;

class Controller_Post extends \Hybrid\Controller_Hybrid {
    
    public function action_new() {
        $request = \Request::factory('admin/post/link/new')->execute();
        $this->response->body = $request;
    }    

}