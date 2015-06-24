<!DOCTYPE html>
<html lang="<?php echo get_html_lang(); ?>">
<head>
    <meta charset="utf-8">
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

    <?php echo auto_discovery_link_tags(); ?>

    <!-- Plugin Stuff -->
    <?php fire_plugin_hook('public_head', array('view'=>$this)); ?>

    <!-- Stylesheets -->
    <!-- Le styles -->
    <?php
    queue_css_url('http://fonts.googleapis.com/css?family=Oxygen');
    queue_css_url('http://fonts.googleapis.com/css?family=Inconsolata');
    queue_css_file(array(
        'bootstrap',
        'font-awesome',
        'style',
    ));
    echo head_css();
    ?>

    <!-- JavaScripts -->
    <?php
    // jQuery is enabled by default in Omeka and in most themes.
    // queue_js_url('https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js');
    // queue_js_url('https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js');
    queue_js_file(array(
        'bootstrap.min',
        'jquery.bxSlider.min',
    ));
    echo head_js();
    ?>
</head>

<?php
    echo body_tag(array('id' => @$bodyid, 'class' => @$bodyclass));
    require_once getcwd().'/plugins/Scripto/libraries/Scripto.php';
    $scripto = ScriptoPlugin::getScripto();
?>

    <div id="wrap" class="container">

        <header id="header" role="banner">
          <div class="navbar navbar-static-top">
            <div class="navbar-inner">
                <a class="brand" href="../">Unlocking the Chartist</a>
                <div class="nav-collapse collapse" id="main-menu">
                  <?php
                  $mainNav = public_nav_main();
                  $mainNav->setUlClass('nav')->setUlId('main-menu-left');
                  echo $mainNav;
                  ?>

                  <ul class="nav pull-right" id="main-menu-right">
                        <?php if ($scripto->isLoggedIn()): ?>
                        <li class="dropdown">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $scripto->getUserName(); ?><b class="caret"></b></a>
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
                  </ul>
                </div>
            </div>
          </div>

            <div id="search-container">

                <?Php echo search_form(); ?>

            </div>
            <?php fire_plugin_hook('public_header', array('view'=>$this)); ?>
            </header>


        </header><!-- end header -->

        <article id="content">

            <?php fire_plugin_hook('public_content_top', array('view'=>$this)); ?>
