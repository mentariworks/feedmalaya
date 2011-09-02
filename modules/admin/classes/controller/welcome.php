<?php

namespace Admin;

class Controller_Welcome extends \Hybrid\Controller_Hybrid {
    
    public function action_index()
    {
        if ($this->user->id < 1)
        {
            \Response::redirect('/login?redirect_to=/admin/welcome', 'refresh');
        }
        
        $this->response(array(
            'content' => 'hello world',
        ), 200);
    }

}