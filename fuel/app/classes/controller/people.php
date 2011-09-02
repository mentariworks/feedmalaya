<?php

class Controller_People extends \Hybrid\Controller_Template {
    
    public $template = 'frontend.default';

    public function action_index()
    {
        if ($this->user->id < 1)
        {
            throw new \Request404Exception();
        }
    }

    public function action_me()
    {
        return $this->action_index();
    }
}