<div class="node <?php print $node_classes; ?>" id="node-<?php print $node->nid; ?>"><div class="node-inner">

  <?php if ($page == 0): ?>
    <h2 class="title">
      <a href="<?php print $node_url; ?>"><?php print $title; ?></a>
    </h2>
  <?php endif; ?>

  <?php if ($unpublished): ?>
    <div class="unpublished"><?php print t('Unpublished'); ?></div>
  <?php endif; ?>

  <?php if ($picture) print $picture; ?>

  <?php if ($submitted): ?>
    <div class="submitted">
      <?php print $submitted; ?>
    </div>
  <?php endif; ?>

  <?php if (count($taxonomy)): ?>
    <div class="taxonomy"><?php print t(' in ') . $terms; ?></div>
  <?php endif; ?>

  <div class="content clear-block">
    <?php print $content; ?>
  </div>
  <script type="text/javascript"><!--
       instiadsPId="0EPwwfTGWkqCvIqaWQDW5VudzI";
       instiadsSite="http://greylocknews.instiads.com";
       instiadsWidth="240";
       instiadsHeight="95";
  //-->
  </script>
  <script type="text/javascript" src="http://static.instiads.com/javascript/ads/display.js"></script>

  <?php if ($links): ?>
    <div class="links">
      <?php print $links; ?>
    </div>
  <?php endif; ?>
</div></div> <!-- /node-inner, /node -->
