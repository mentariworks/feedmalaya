<div class="hero-unit">
    <h2>Welcome to FeedMalaya</h2>
    <p>Share everything, a great combination of Forrst, Tumblr and Google Reader</p>
</div>

<div class="row">
<?php 

$posts = \Post::latest(3);
$count = 0;
foreach ($posts as $post) : ?>
    <div class="span<?php echo ($count > 0 ? '6' : '5'); ?>">
        <?php 

        switch ($post->type) : 
             case 'text' :
             case 'link' : ?>
            <div class="page-header">
                <h3>
                    <?php echo \Hybrid\Html::anchor(\Post::uri($post, true), \Post::title($post)); ?>
                    <small><?php echo \Str::ucfirst($post->type); ?></small>
                </h3>
            </div>
            
            <?php echo \Post::excerpt($post); ?>
        <?php 
            break;

            case 'video' :
        endswitch; ?>
    </div>
<?php 

    $count++;
endforeach; ?>

</div>