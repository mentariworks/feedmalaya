
<div class="row post post-text">
    <div class="page-header">
        <h1>
            <?php echo $title; ?>
            <small>
                Shared by <author><?php echo $post->users->full_name; ?>, posted <?php echo \Date::time_ago(strtotime($post->created_at)); ?></author>
            </small>
        </h1>
    </div>
    <div class="post-meta">
    </div>
    <div class="post-text-content">
        <?php echo \Hybrid\Parser::factory('markdown')->parse($content); ?>
    </div>
</div>