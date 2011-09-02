<?php

return array(
    'template' => array(
        'wrapper_start'  => '<div class="pagination"><ul>',
        'wrapper_end'    => '</ul></div>',
        'page_start'     => '<li>',
        'page_end'       => ' </li>',
        'previous_start' => '<li class="prev"> ',
        'previous_end'   => ' </li>',
        'previous_mark'  => '&laquo; ',
        'next_start'     => '<li class="next"> ',
        'next_end'       => ' </li>',
        'next_mark'      => ' &raquo;',
        'active_start'   => '<li class="active"><a href="#">',
        'active_end'     => '</a></li>',

        'disabled' => array(
            'previous_start' => '<li class="prev disabled"><a href="#">',
            'previous_end'   => '</a></li>',
            'next_start'     => '<li class="next disabled"><a href="#">',
            'next_end'       => '</a></li>',
        ),
    ),
);