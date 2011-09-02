<div class="row">
    <div class="span5 columns">
        <h2>Login</h2>
        <p>You can either login using your username and password combination, Twitter OAuth or Facebook Connect.</p>
    </div>

    <div class="span11 columns">
    <form id="login" method="post" action="<?php echo \Uri::current(); ?>">
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