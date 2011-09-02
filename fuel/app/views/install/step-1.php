<p>Set default value for this application.</p>
<form action="<?php echo \Uri::create($next); ?>" method="post">
    <div class="clearfix">
        <label>Site Name</label>
        <div class="input">
            <?php echo \Form::input('site_name', \Config::get('app.site_name', ''), array('class' => 'xlarge')); ?>
        </div>
    </div>
    <div class="actions">
        <button class="btn primary" type="submit">Next &raquo;</button>
    </div>
</form>