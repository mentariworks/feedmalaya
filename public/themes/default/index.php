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

    <?php echo \Asset::css('bootstrap-1.1.1.css'); ?>
</head>
<body>
    <div class="topbar">
        <div class="fill">
            <div class="container">
                <h3><a href="#"><?php echo \Config::get('app.site_name'); ?></a></h3>
                <ul>
                    <li><a href="#">Home</a></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="container">
        <?php echo $content; ?>
    </div>

</body>
</html>