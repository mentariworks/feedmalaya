<?php 

foreach ($posts as $archive) :
    $data = array(
        'title' => \Post::title($archive),
        'content' => \Post::content($archive),
        'post' => $archive
    );
    echo $template->partial('post/' . $archive->type, $data);
endforeach; 

echo $pagination; ?>
