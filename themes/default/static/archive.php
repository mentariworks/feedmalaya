<?php 

foreach ($posts as $archive) :
    $data = array(
        'title' => \Post::title($archive),
        'content' => \Post::content($archive),
        'post' => $archive
    );
    $view = \Hybrid\View::factory('post/' . $archive->type, $data, false);
    $view->set_path(DOCROOT . 'themes/default/');
    echo $view->render();
endforeach; ?>