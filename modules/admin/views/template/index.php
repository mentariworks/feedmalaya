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

    <?php echo \Asset::css(array('bootstrap-1.1.1.css', 'bootstrap/screen.css')); ?>
    <?php echo \Asset::js(array('jquery.1.6.2.min.js', 'local.js', 'bootstrap/alert.js', 'bootstrap/dropdown.js')); ?>
</head>
<body>
    <div id="topbar" class="topbar">
        <div class="fill">
            <div class="container-fluid">
                <h3><?php echo \Hybrid\Html::anchor('/admin', 'Dashboard'); ?></h3>
                <ul class="nav">
                    <li><?php echo \Hybrid\Html::anchor('/admin', 'Home'); ?></li>
                    <li class="menu">
                        <?php echo \Hybrid\Html::anchor('#', 'New Post', array('class' => 'menu')); ?>
                        <ul class="menu-dropdown">
                            <li><?php echo \Hybrid\Html::anchor('admin/post/text', 'Text'); ?></li>
                        </ul>
                    </li>
                </ul>

                <ul class="nav secondary-nav">
                    <li><?php echo \Hybrid\Html::anchor('/', 'Back to website'); ?></li>
                </ul>
            </div>
        </div>
    </div>

    <div id="content" class="container-fluid after-topbar">
        <?php echo $content; ?>

        <footer>
            <p>FeedMalaya</p>
        </footer>
    </div>

    <script type="text/javascript">
    jQuery(function($) {
        Local.initiate();
        $('#topbar').dropdown();
    });
    </script>
</body>
</html>