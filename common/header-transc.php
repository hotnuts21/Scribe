<!DOCTYPE html>
<html lang="<?php echo get_html_lang(); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php if ( $description = option('description')): ?>
    <meta name="description" content="<?php echo $description; ?>" />
    <?php endif; ?>
    <?php
    if (isset($title)) {
        $titleParts[] = strip_formatting($title);
    }
    $titleParts[] = option('site_title');
    ?>
    <title><?php echo implode(' &middot; ', $titleParts); ?></title>

    <!-- Plugin Stuff -->
    <?php fire_plugin_hook('public_head', array('view'=>$this)); ?>

    <!-- Stylesheets -->
    <!-- Le styles -->
    <?php
    queue_css_file(array(
        'bootstrap',
        'font-awesome',
        'style-transcribe',
    ));
    echo head_css();
    ?>

    <!-- JavaScripts -->
    <?php
    queue_js_file('bootstrap.min');
    echo head_js();
    ?>
</head>

<?php
    echo body_tag(array('id' => @$bodyid, 'class' => @$bodyclass));
    require_once getcwd().'/plugins/Scripto/libraries/Scripto.php';
    $scripto = ScriptoPlugin::getScripto();
?>

    <div class="container-fluid">
      <!--header area -->
      <header id="header" role="banner">

        <div class="row-fluid">
          <div class="span10"> Logo</div>
          <div class="span2">

            <div id="sublinks" class="masthead clearfix">

                <ul class="nav nav-pills pull-right">

                    <?php if ($scripto->isLoggedIn()): ?>
                    <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><strong><?php echo $scripto->getUserName(); ?></strong><b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo WEB_ROOT; ?>/scripto">Your Contributions</a></li>
                            <li><a href="<?php echo WEB_ROOT; ?>/scripto/watchlist">Your Watchlist</a></li>
                            <li><a href="<?php echo WEB_ROOT; ?>/scripto/recent-changes">Recent Changes</a></li>
                            <li><a href="<?php echo WEB_ROOT; ?>/scripto/logout">Logout</a></li>
                        </ul>
                    </li>

                    <?php else: ?>

                    <li>
                    <a href="<?php echo WEB_ROOT; ?>/scripto/login">Sign in or register</a>
                    </li>

                    <?php endif; ?>
                </ul>
            </div>
          </div>
        </div>

      </header><!-- end header -->
        <!-- start of main page structure -->

        <div class="row-fluid">

            <?php fire_plugin_hook('public_content_top', array('view'=>$this)); ?>
