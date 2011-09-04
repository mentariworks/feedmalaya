<div class="hero-unit">
    <h2>Welcome to FeedMalaya</h2>
    <p>Share everything, a great combination of Forrst, Tumblr and Google Reader</p>
</div>

<div class="row">
<?php 

$posts = \Model_Post::latest(6);
$count = 0;
foreach ($posts as $post) : 

    if ($count === 3) : 
        $count = 0; ?>
        </div><div class="row">
    <?php endif; ?>
    <div class="span<?php echo ($count > 0 ? '6' : '5'); ?>">
        <?php 

        switch ($post->type) : 
             case 'text' :
             case 'link' : ?>
            <div class="page-header">
                <h3>
                    <?php echo \Hybrid\Html::anchor(\Post::uri($post), \Post::title($post)); ?>
                    <small><?php echo \Str::ucfirst($post->type); ?></small>
                </h3>
            </div>
            
            <p><?php echo \Post::excerpt($post); ?></p>
            <p><?php echo \Hybrid\Html::anchor(\Post::uri($post), 'View Detail &raquo;', array('class' => 'btn')); ?></p>

        <?php 
            break;

            case 'video' :
        endswitch; ?>
    </div>
<?php 

    $count++;
endforeach; ?>

</div>