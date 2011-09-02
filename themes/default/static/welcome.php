<?php $user = \Hybrid\Auth_User::instance()->get(); ?>
<div class="hero-unit">
    <h1>Hello, <?php echo $user->user_name; ?></h1>
    <p>Some message...</p>
</div>