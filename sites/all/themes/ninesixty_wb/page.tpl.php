<?php
// $Id: page.tpl.php,v 1.1.2.2 2010/04/20 22:52:04 dvessel Exp $
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php print $language->language ?>" lang="<?php print $language->language ?>" dir="<?php print $language->dir ?>">

<head>
  <title><?php print $head_title; ?></title>
  <?php print $head; ?>
  <?php print $styles; ?>
  <?php print $scripts; ?>
</head>

<body class="<?php print $body_classes; ?> show-grid">
  <div id="page" class="container-16 clearfix">

    <div id="site-header" class="clearfix">
      <div id="branding" class="grid-9">
      <div id="logo-name" class="clearfix">
      <?php if ($linked_logo_img): ?>
        <span id="logo" class=""><?php print $linked_logo_img; ?></span>
      <?php endif; ?>
      <?php if ($linked_site_name): ?>
        <div id="site-name" class=""><?php print $linked_site_name; ?></div>
      <?php endif; ?>
      <?php // if ($site_slogan): ?>
        <div id="site-slogan" class="">
        <?php // print $site_slogan; ?>
        <a href="/cmi">A Citizen/Media Community Hub</a>
        </div>
      <?php // endif; ?>
      </div><!-- logo-name -->
      </div><!-- branding -->

<div id="header-right" class="grid-7 clearfix">
    <?php if ($search_box): ?>
      <div id="search-box" class="clearfix"><?php print $search_box; ?></div>
      <div class="clear"></div>
    <?php endif; ?>

    <?php if ($header_right): ?>
      <div id="header-right-links" class="clearfix">
        <?php print $header_right; ?>
      </div>
    <?php endif; ?>
</div><!-- header right -->
</div><!-- site header -->
    <?php if ($main_menu_links): ?>
      <div id="site-menu" class="grid-16 clearfix">
        <?php print $main_menu_links; ?>
      </div>
    <?php endif; ?>
        <?php if ($topbanner_image): ?>
      <div id="topbanner" class="grid-16 clearfix">
        <?php print $topbanner_image; ?>
        </div>
        <?php endif;?>

    <?php if ($mission): ?>
    <div id="site-subheader" class="prefix-1 suffix-1 clearfix">
      <div id="mission" class="<?php print ns('grid-14', $header, 7); ?>">
        <?php print $mission; ?>
      </div>
    </div>
    <?php endif; ?>
      <div id="breadcrumb" class="grid-16 clearfix">
      <?php print $breadcrumb; ?>
	</div>
    <div id="main" class="column <?php print ns('grid-16', $left, 4, $right, 3) . ' ' . ns('push-4', !$left, 4); /*print($left ? "" : " alpha");*/ ?>">
      <?php if ($title): ?>
        <h1 class="title" id="page-title"><?php print $title; ?></h1>
      <?php endif; ?>
      <?php if ($tabs): ?>
        <div class="tabs"><?php print $tabs; ?></div>
      <?php endif; ?>
      <?php print $messages; ?>
      <?php print $help; ?>

      <div id="main-content" class="region clearfix">
        <?php print $content; ?>
      </div>

      <?php print $feed_icons; ?>
    </div>

  <?php if ($left): ?>
    <div id="sidebar-left" class="column sidebar region grid-4 <?php print ns('pull-12', $right, 3); ?>">
      <?php print $left; ?>
    </div>
  <?php endif; ?>

  <?php if ($right): ?>
    <div id="sidebar-right" class="column sidebar region grid-3">
      <?php print $right; ?>
    </div>
  <?php endif; ?>


  <div id="footer" class="prefix-1 suffix-1 clear clearfix">
    <?php if ($footer): ?>
      <div id="footer-region" class="region grid-14 clearfix">
        <?php print $footer; ?>
      </div>
    <?php endif; ?>

    <?php if ($footer_message): ?>
      <div id="footer-message" class="grid-14">
        <?php print $footer_message; ?>
      </div>
    <?php endif; ?>
  </div>


  </div>
  <?php print $closure; ?>
</body>
</html>
