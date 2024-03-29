<div class="row">
    <div class="span5 columns">
        <h2>Login</h2>
        <p>You can either login using your username and password combination, Twitter OAuth or Facebook Connect.</p>
    </div>

    <div class="span11 columns">
    <form id="login" method="post" action="<?php echo \Uri::current(); ?>">
        <?php echo \Form::hidden('redirect_to', \Hybrid\Input::get('redirect_to')); ?>
        <fieldset>
            <div class="clearfix">
                <label>Username</label>
                <div class="input">
                    <?php echo \Form::input('username', '', array('class' => 'xlarge')); ?>
                </div>
            </div>

            <div class="clearfix">
                <label>Password</label>
                <div class="input">
                    <?php echo \Form::password('password', '', array('class' => 'xlarge')); ?>
                </div>
            </div>

            <div class="actions">
                <button class="btn primary" type="submit">Login</button>
            </div>
        </fieldset>
    </form>
    </div>
</div>

<script type="text/javascript">
jQuery(function($) {
    $('#login').submit(function(e) {
        e.preventDefault();

        Local.request('POST <?php echo \Uri::create("credential/login.json"); ?>', this);

        return false;
    });
});
</script>