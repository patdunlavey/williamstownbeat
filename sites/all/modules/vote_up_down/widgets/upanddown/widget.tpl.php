<?php
// $Id: widget.tpl.php,v 1.1.2.1 2010/07/24 23:23:54 marvil07 Exp $

/**
 * @file
 * widget.tpl.php
 *
 * UpAndDown widget theme for Vote Up/Down
 */
?>
<div class="vud-widget vud-widget-upanddown" id="<?php print $id; ?>">
  <div class="up-score clear-block">
    <?php if ($show_links): ?>
      <a href="<?php print $link_up; ?>" rel="nofollow" class="<?php print "$link_class_up $class_up"; ?>" title="<?php print t('Vote up!'); ?>"></a>
    <?php endif; ?>
    <span class="up-current-score"><?php print $up_points; ?></span>
  </div>

  <div class="down-score clear-block">
    <?php if ($show_links): ?>
      <a href="<?php print $link_down; ?>" rel="nofollow" class="<?php print "$link_class_down $class_down"; ?>" title="<?php print t('Vote down!'); ?>"></a>
    <?php endif; ?>
    <span class="down-current-score"><?php print $down_points; ?></span>
  </div>
</div>
