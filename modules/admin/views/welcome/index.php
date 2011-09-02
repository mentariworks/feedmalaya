<?php $user = \Hybrid\Auth::instance()->get(); ?>
<div class="sidebar">
    <h3><?php echo $user->full_name; ?></h3>
    <ul>
        <li><?php echo \Hybrid\Html::anchor('/admin/account', 'Edit Profile'); ?></li>
    </ul>
</div>

<div class="content">
    <div class="page-header">
        <h1>Latest Posts</h1>

        <table class="zebra-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Type</th>
                    <th>Status</th>
                    <th>Published</th>
                </tr>
            </thead>
            <tbody>
                <?php 

                foreach($posts as $post) : 
                    $title = \Post::title($post);
                    $url   = \Post::uri($post, true); ?>
                    <tr>
                        <td><?php echo $post->id; ?></td>
                        <td>
                            <strong><?php echo $title; ?></strong>
                            <p><?php echo \Post::excerpt($post, 50, false); ?></p>
                        </td>
                        <td><?php echo \Str::ucfirst($post->type); ?></td>
                        <td><?php echo \Str::ucfirst($post->status); ?></td>
                        <td><?php echo \Date::time_ago(strtotime($post->published_at)); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php echo $pagination; ?>
    </div>
</div>