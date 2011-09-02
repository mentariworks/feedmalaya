<!DOCTYPE html>
<html lang="en">
<?php

$title = (isset($title) ? $title : '');
?>
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

        <!-- Main hero unit for a primary marketing message or call to action -->
        <div class="hero-unit">
            <h1>Hello, world!</h1>
            <p>Vestibulum id ligula porta felis euismod semper. Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit.</p>
            <p><a class="btn primary large">Login &raquo;</a> or <a class="btn secondary large">Sign up &raquo;</a></p>
        </div>
    </div>

</body>
</html>