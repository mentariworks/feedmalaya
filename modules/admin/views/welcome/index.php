<?php $user = \Hybrid\Auth::instance()->get(); ?>
<div class="sidebar">
    <h3><?php echo $user->full_name; ?></h3>
</div>

<div class="content">
    <div class="page-header">
        <h1>Posts</h1>

        <table class="zebra-striped">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Type</th>
                    <th>Status</th>
                    <th>Published at</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                <?php 

                foreach($posts as $post) : 
                    $title = \Post::title($post);
                    $url   = \Post::uri($post, true); ?>
                    <tr>
                        <td>
                            <strong><?php echo $title; ?></strong>
                        </td>
                        <td><?php echo \Str::ucfirst($post->type); ?></td>
                        <td><?php echo \Str::ucfirst($post->status); ?></td>
                        <td><?php echo \Date::time_ago(strtotime($post->published_at)); ?></td>
                        <td>
                            <?php 

                            echo \Hybrid\Html::anchor(\Post::uri($post, true), "View", array('class' => 'btn small primary'));
                            echo '&nbsp;';
                            echo \Hybrid\Html::anchor('admin/post/' . $post->type . '/edit/' . $post->id, "Edit", array('class' => 'btn small'));
                            echo '&nbsp;';
                            echo \Hybrid\Html::anchor('admin/post/index.json?id=' . $post->id, "Delete", array('class' => 'btn small danger delete')); ?>
                            </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php echo $pagination; ?>
    </div>
</div>
<script type="text/javascript">
jQuery(function($) {
   $('a.delete').bind('click', function(e) {
       e.preventDefault();

       var href = this.href;

       Local.request('DELETE ' + href, this);
   }) 
});
</script>