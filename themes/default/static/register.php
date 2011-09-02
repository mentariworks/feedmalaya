<div class="row">
    <div class="span5 columns">
        <h2>Register</h2>
    </div>

    <div class="span11 columns">
    <form id="register" method="post" action="<?php echo \Uri::current(); ?>">
        <fieldset>
            <div class="clearfix">
                <label>Username</label>
                <div class="input">
                    <?php echo \Form::input('username', '', array('class' => 'xlarge')); ?>
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
                <button class="btn primary" type="submit">Register</button>
            </div>
        </fieldset>
    </form>
    </div>
</div>

<script type="text/javascript">
jQuery(function($) {
    $('#register').submit(function(e) {
        e.preventDefault();

        Local.request('POST <?php echo \Uri::create("credential/register.json"); ?>', this);

        return false;
    });
});
</script>