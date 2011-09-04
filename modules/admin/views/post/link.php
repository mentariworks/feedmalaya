<?php 
$path   = \Uri::create('admin/post/link/edit.json');
$mode   = 'edit';

// configure for new post 
if (null == $post->id)
{
    $post->status   = 'publish';
    $post->type     = 'link';
    $path           = \Uri::create('admin/post/link/new.json');
    $mode           = 'new';
} ?>

<div class="page-header">
    <h1>
        <?php echo $title; ?>
        <small>Posted by <?php echo \Hybrid\Auth::instance()->get('full_name'); ?></small>
    </h1>
</div>

<form id="post-link" method="post" action="<?php echo \Uri::current(); ?>">
    <?php echo \Form::hidden('id', $post->id); ?>
    <div class="sidebar">
        
    </div>
    <div class="content">
        <div class="clearfix" id="field-title">
            <label>Title</label>
            <div class="input">
                <?php echo \Form::input('title', $link->title, array('class' => 'xlarge')); ?>
            </div>
        </div>

        <div class="clearfix" id="field-url">
            <label>URL</label>
            <div class="input">
                <?php echo \Form::input('url', $link->url, array('class' => 'xlarge')); ?>
            </div>
        </div>

        <div class="clearfix" id="field-content">
            <label>Description</label>
            <div class="input">
                <?php echo \Form::textarea('content', $link->content, array('class' => 'xxlarge')); ?>
                <span class="help-block">Optional</span>
            </div>
        </div>

        <div class="clearfix">
            <label><small>Post Status</small></label>
            <div class="input">
                <?php echo \Form::select(array(
                        'name'    => 'status',
                        'value'   => $post->status,
                        'options' => array(
                            'draft'   => 'Draft',
                            'publish' => 'Publish'
                        ),
                    )); ?>
            </div>
        </div>

        <div class="actions">
            <button class="btn primary" type="submit">Post</button>
        </div>
    </div>
</form>

<script type="text/javascript">
jQuery(function($) {
    $('#post-link').submit(function(e) {
        e.preventDefault();
        Local.request("POST <?php echo $path; ?>", this);

        return false;
    });
});
</script>