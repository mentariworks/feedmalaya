<?php

/**
 * The Welcome Controller.
 * 
 * @package  app
 * @extends  Controller
 */
class Controller_Welcome extends \Hybrid\Controller_Template {
    
    public $template = 'frontend.default';

    /**
     * The index action.
     * 
     * @access  public
     * @return  void
     */
    public function action_index()
    {
        if (null !== $p = \Hybrid\Input::get('p', null))
        {
            $response = \Request::factory('p/' . $p)->execute();
            return $this->response->body = $response;
        }

        $this->response(array(
            'content' => $this->template->partial('static/welcome'),
        ), 200);
    }

    /**
     * The 404 action for the application.
     * 
     * @access  public
     * @return  void
     */
    public function action_404()
    {
        $messages      = array('Aw, crap!', 'Bloody Hell!', 'Uh Oh!', 'Nope, not here.', 'Huh?');
        $data['title'] = $messages[array_rand($messages)];
        $data['uri']   = \Uri::main();

        // Set a HTTP 404 output header
        $this->response(array(
            'title'   => $data['title'],
            'content' => $this->template->partial('404', $data),
        ), 404);
    }
}

/* End of file welcome.php */