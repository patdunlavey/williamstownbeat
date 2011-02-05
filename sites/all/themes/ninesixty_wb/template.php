<?php
// $Id: template.php,v 1.1.2.6 2010/04/25 05:16:47 dvessel Exp $


/**
 * Preprocessor for page.tpl.php template file.
 */
function ninesixty_wb_preprocess_page(&$vars, $hook) {
}

/**
 * Contextually adds 960 Grid System classes.
 *
 * The first parameter passed is the *default class*. All other parameters must
 * be set in pairs like so: "$variable, 3". The variable can be anything available
 * within a template file and the integer is the width set for the adjacent box
 * containing that variable.
 *
 *  class="<?php print ns('grid-16', $var_a, 6); ?>"
 *
 * If $var_a contains data, the next parameter (integer) will be subtracted from
 * the default class. See the README.txt file.
 */



function phptemplate_date_all_day_label() {
  return '<!-- ('. date_t('All day', 'datetime') .') -->';
}

function ninesixty_wb_breadcrumb($breadcrumb) {
  if (!empty($breadcrumb)) {
    if ($breadcrumb[1]=='<a href="/og">Groups</a>') {
      $breadcrumb[1]='<a href="/channels">Channels</a>';
    }
    return '<div class="breadcrumb">'. implode('/', $breadcrumb) .'</div>';
  }
}