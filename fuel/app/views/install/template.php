<!DOCTYPE html>
<html lang="en">
<?php

$title   = (isset($title) ? $title : '');
$content = (isset($content) ? $content : ''); ?>
<head>
    <meta charset="utf-8">
    <?php echo \Hybrid\Html::title($title); ?>

    <!-- Le HTML5 shim, for IE6-8 support of HTML elements -->
    <!--[if lt IE 9]>
        script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <?php echo \Asset::css(array('bootstrap-1.1.1.css')); ?>
    <?php echo \Asset::js(array('jquery.1.6.2.min.js', 'local.js')); ?>
</head>
<body>
    <div class="topbar">
        <div class="fill">
            <div class="container">
                <h3><?php echo \Hybrid\Html::anchor('/', \Config::get('app.site_name')); ?></h3>
            </div>
        </div>
    </div>

    <div class="container" style="margin-top:60px">
        <div class="row">
    <div class="span16 columns">
        <?php echo \Hybrid\Html::h($title, 2); ?>

        <?php if (!empty($errors)) : ?>
            <h3>Errors</h3>
            <?php foreach($errors as $error) : ?>
                <div class="alert-message error">
                    <?php echo $error; ?>
                </div>
            <?php endforeach; ?>

            <p><?php echo \Hybrid\Html::anchor($prev, "&laquo; Back", array('class' => "btn danger")); ?></p>
        <?php else : ?>
            <?php echo $content; ?>
        <?php endif; ?>
    </div>
</div>

    </div>

</body>
</html>