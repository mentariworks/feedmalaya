<?php $user = \Hybrid\Auth::instance()->get(); ?>
<div class="sidebar">
    <h3><?php echo $user->full_name; ?></h3>
</div>

<div class="content">
    <div class="page-header">
        <h1><?php echo $title; ?></h1>
    </div>
    <form id="change-password" method="post" action="<?php echo \Uri::current(); ?>">
        <div class="clearfix" id="field-current_password">
            <label>Current Password</label>
            <div class="input">
                <?php echo \Form::password('current_password', '', array('class' => 'xlarge')); ?>
            </div>
        </div>
        <div class="clearfix" id="field-new_password">
            <label>New Password</label>
            <div class="input">
                <?php echo \Form::password('new_password', '', array('class' => 'xlarge')); ?>
            </div>
        </div>
        <div class="clearfix" id="field-confirm_password">
            <label>Confirm New Password</label>
            <div class="input">
                <?php echo \Form::password('confirm_password', '', array('class' => 'xlarge')); ?>
            </div>
        </div>
        <div class="actions">
            <button class="btn primary" type="submit">Post</button>
        </div>
    </form>
</div>

<script type="text/javascript">
jQuery(function($) {
    $('#change-password').submit(function(e) {
        e.preventDefault();
        Local.request("POST <?php echo \Uri::create('admin/account/password.json'); ?>", this);

        return false;
    });
});
</script>