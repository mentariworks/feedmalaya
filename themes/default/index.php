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

    <?php echo \Asset::css(array('bootstrap-1.1.1.css', 'screen.css')); ?>
</head>
<body>
    <div class="topbar">
        <div class="fill">
            <div class="container">
                <h3><?php echo \Hybrid\Html::anchor('/', \Config::get('app.site_name')); ?></h3>
                <ul>
                    <li><?php echo \Hybrid\Html::anchor('/', 'Home'); ?></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="container after-topbar">
        <?php echo $content; ?>
    </div>

</body>
</html>