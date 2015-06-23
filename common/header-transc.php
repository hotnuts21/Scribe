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

  <header id="header" role="banner">
    <!--header area -->
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

    </header><!-- end header -->
    <!-- start of main page structure -->
    <div class="container-fluid">
      <div class="row-fluid top-buffer"><!--main row ends in footer unless page requires many rows -->

            <?php fire_plugin_hook('public_content_top', array('view'=>$this)); ?>
