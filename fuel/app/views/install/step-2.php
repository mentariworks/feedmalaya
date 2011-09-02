<p>Set default username for this application.</p>
<form action="<?php echo \Uri::create($next); ?>" method="post">
    <div class="clearfix">
        <label>Username</label>
        <div class="input">
            <?php echo \Form::input('username', 'administrator', array('class' => 'xlarge')); ?>
        </div>
    </div>
    <div class="clearfix">
        <label>E-mail Address</label>
        <div class="input">
            <?php echo \Form::input('email', '', array('class' => 'xlarge')); ?>
        </div>
    </div>
    <div class="clearfix">
        <label>Password</label>
        <div class="input">
            <?php echo \Form::password('password', '', array('class' => 'xlarge')); ?>
        </div>
    </div>
    <div class="actions">
        <button class="btn primary" type="submit">Next &raquo;</button>
    </div>
</form>