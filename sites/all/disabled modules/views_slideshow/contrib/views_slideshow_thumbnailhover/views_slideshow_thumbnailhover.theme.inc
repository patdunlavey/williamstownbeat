<?php
// $Id: views_slideshow_thumbnailhover.theme.inc,v 1.1.2.1.2.29 2010/04/17 04:36:24 redndahead Exp $

/**
 * @file
 * Theme & preprocess functions for the Views Slideshow: ThumbnailHover module.
 */

/**
 * Implements template_preprocess_hook_THEMENAME().
 */
function template_preprocess_views_slideshow_thumbnailhover(&$vars) {
  $options = $vars['options'];
  $id = $vars['id'];
  $view = $vars['view'];
  $rows = $vars['rows'];

  $settings = array_merge(
    array(
      'num_divs' => sizeof($vars['rows']),
      'teasers_last' => ($options['thumbnailhover']['teasers_last']) ? 'true' : 'false',
      'id_prefix' => '#views_slideshow_thumbnailhover_main_',
      'div_prefix' => '#views_slideshow_thumbnailhover_div_',
      'id' => $vars['id'],
    ),
    $options['views_slideshow_thumbnailhover']
  );

  drupal_add_js(array('viewsSlideshowThumbnailHover' => array(
    "#views_slideshow_thumbnailhover_main_$id" => $settings)), 'setting');

  // Add the hoverIntent plugin.
  if ($settings['pager_event'] == 'hoverIntent') {
    if (module_exists('jq')) {
      $loaded_plugins = jq_plugins();
      if (!empty($loaded_plugins['hoverIntent'])) {
        jq_add('hoverIntent');
      }
    }
    if (module_exists('hoverintent')) {
      hoverintent_add();
    }
  }

  $teaser = ($options['views_slideshow_thumbnailhover']['hover_breakout'] == 'teaser') ? TRUE : FALSE;
  $hidden_elements = theme('views_slideshow_thumbnailhover_no_display_section', $view, $rows, $id, $options, $teaser);
  $vars['slideshow'] = theme('views_slideshow_main_section', $id, $hidden_elements, 'views_slideshow_thumbnailhover');

  $thumbnailhover = $vars['options']['views_slideshow_thumbnailhover'];

  if ($thumbnailhover['controls'] == 1) {
    $vars['controls_top'] = theme('views_slideshow_thumbnailhover_controls', $id, $view, $options);
  }
  elseif ($thumbnailhover['controls'] == 2) {
    $vars['controls_bottom'] = theme('views_slideshow_thumbnailhover_controls', $id, $view, $options);
  }

  if (!$thumbnailhover['teasers_last']) {
    $vars['breakout_top'] = theme('views_slideshow_thumbnailhover_breakout_teasers', $view, $rows, $id, $options);
  }
  else {
    $vars['breakout_bottom'] = theme('views_slideshow_thumbnailhover_breakout_teasers', $view, $rows, $id, $options);
  }

  if ($thumbnailhover['image_count'] == 1) {
    $vars['image_count_top'] = theme('views_slideshow_thumbnailhover_image_count', $id, $view, $options);
  }
  elseif ($thumbnailhover['image_count'] == 2) {
    $vars['image_count_bottom'] = theme('views_slideshow_thumbnailhover_image_count', $id, $view, $options);
  }
}

/**
 * Add the the HTML for the hidden slideshow elements.
 *
 * @ingroup themeable
 */
function theme_views_slideshow_thumbnailhover_no_display_section($view, $rows, $id, $options, $teaser = TRUE) {
  // Add the slideshow elements.
  $attributes['id'] = "views_slideshow_thumbnailhover_teaser_section_$id";
  $attributes['class'] = 'views_slideshow_thumbnailhover_teaser_section views_slideshow_teaser_section';
  $attributes = drupal_attributes($attributes);

  $output = "<div$attributes>";
  foreach ($view->result as $count => $node) {
    if ($view->display_handler->uses_fields()) {
      $rendered = '';
      foreach ($options['views_slideshow_thumbnailhover']['main_fields'] as $field => $use) {
        if (is_object($view->field[$field])) {
          $rendered_field = $view->field[$field]->theme($node);
          
          // If the field is excluded then don't display it.
          // It must be rendered first though so that Custom Text can use it.
          if (!$view->field[$field]->options['exclude']) {
            if (($use !== 0) && !empty($rendered_field)) {
              $rendered .= '<div class="views-field-'. views_css_safe($view->field[$field]->field) .'">';
              if ($view->field[$field]->label()) {
                $rendered .= '<label class="view-label-'. views_css_safe($view->field[$field]->field) . '">';
                $rendered .= $view->field[$field]->label() . ':';
                $rendered .= '</label>';
              }
              $rendered .= '<div class="views-content-'. views_css_safe($view->field[$field]->field) .'">';
              $rendered .=  $rendered_field;
              $rendered .= '</div>';
              $rendered .= '</div>';
            }
          }
        }
      }
    }
    else {
      $rendered = node_view(node_load($node->nid), $teaser, FALSE, FALSE);
    }
    $output .= theme('views_slideshow_thumbnailhover_no_display_teaser', $rendered, $id, $count);
  }
  $output .= "</div>";
  return $output;
}

/**
 * Views Slideshow: active element.
 *
 * @ingroup themeable
 */
function theme_views_slideshow_thumbnailhover_no_display_teaser($item, $id, $count) {
  $current = $count + 1;

  $classes = array(
    'views_slideshow_thumbnailhover_slide',
    "views_slideshow_slide views-row-$current",
  );

  if ($count) {
    $classes[] = 'views_slideshow_thumbnailhover_hidden';
  }
  $classes[] = ($count % 2) ? 'views-row-even' : 'views-row-odd';

  $attributes['id'] = "views_slideshow_thumbnailhover_div_${id}_${count}";
  $attributes['class'] = implode(' ', $classes);
  $attributes = drupal_attributes($attributes);

  return "<div$attributes>$item</div>";
}

/**
 * Views Slideshow: pager in the form of node teasers.
 *
 * @ingroup themeable
 */
function theme_views_slideshow_thumbnailhover_breakout_teasers($view, $items, $id, $options) {
  $attributes['id'] = "views_slideshow_thumbnailhover_breakout_teasers_$id";
  $attributes['class'] = 'views_slideshow_thumbnailhover_breakout_teasers clear-block';
  $attributes = drupal_attributes($attributes);

  $output = "<div$attributes>";
  if ('title' == $options['views_slideshow_thumbnailhover']['hover_breakout']) {
    foreach ($view->result as $count => $node) {
      $node = node_load($node->nid); // TODO, this loads too much, but on node row we dont access the fields separately.
      $output .= theme('views_slideshow_thumbnailhover_breakout_teaser', $node->title, $id, $count);
    }
  }
  elseif ($view->display_handler->uses_fields()) {
    foreach ($view->result as $count => $node) {
      $rendered_fields = '';
      foreach ($options['views_slideshow_thumbnailhover']['breakout_fields'] as $field => $use) {
        if (is_object($view->field[$field])) {
          $rendered_field = $view->field[$field]->theme($node);
          
          // If the field is excluded then don't display it.
          // It must be rendered first though so that Custom Text can use it.
          if (!$view->field[$field]->options['exclude']) {
            if (($use !== 0) && !empty($rendered_field)) {
              $rendered_fields .= '<div class="views-field-'. views_css_safe($view->field[$field]->field) .'">';
              if ($view->field[$field]->label()) {
                $rendered_fields .= '<label class="view-label-'. views_css_safe($view->field[$field]->field) . '">';
                $rendered_fields .= $view->field[$field]->label() . ':';
                $rendered_fields .= '</label>';
              }
              $rendered_fields .= '<div class="views-content-'. views_css_safe($view->field[$field]->field) .'">';
              $rendered_fields .=  $rendered_field;
              $rendered_fields .= '</div>';
              $rendered_fields .= '</div>';
            }
          }
        }
      }
      $output .= theme('views_slideshow_thumbnailhover_breakout_teaser', $rendered_fields, $id, $count);
    }
  }
  else {
    foreach ($items as $count => $item) {
      $output .= theme('views_slideshow_thumbnailhover_breakout_teaser', $item, $id, $count);
    }
  }
  $output .= "</div>\n";

  return $output;
}

/**
 * Views Slideshow: breakout teaser.
 *
 * @ingroup themeable
 */
function theme_views_slideshow_thumbnailhover_breakout_teaser($item, $id, $count) {
  $current = $count + 1;
  $classes = array(
    'views_slideshow_thumbnailhover_div_breakout_teaser',
  );
  if (!$count) {
    $classes[] = 'views_slideshow_thumbnailhover_active_teaser';
  }
  $classes[] = ($count % 2) ? 'views-row-even' : 'views-row-odd';

  $attributes['class'] = implode(' ', $classes);
  $attributes['id'] = "views_slideshow_thumbnailhover_div_breakout_teaser_${id}_${count}";
  $attributes = drupal_attributes($attributes);

  return "<div$attributes>$item</div>\n";
}

/**
 * Views Slideshow: slideshow controls.
 *
 * @ingroup themeable
 */
function theme_views_slideshow_thumbnailhover_controls($id, $view, $options) {
  $classes = array(
    'views_slideshow_thumbnailhover_controls',
    'views_slideshow_controls',
  );

  $attributes['class'] = implode(' ', $classes);

  $attributes['id'] = "views_slideshow_thumbnailhover_controls_$id";
  $attributes = drupal_attributes($attributes);

  $output = "<div$attributes>";
  $output .= theme('views_slideshow_thumbnailhover_control_previous', $id, $view, $options);
  if ($options['views_slideshow_thumbnailhover']['timeout']) {
    $output .= theme('views_slideshow_thumbnailhover_control_pause', $id, $view, $options);
  }
  $output .= theme('views_slideshow_thumbnailhover_control_next', $id, $view, $options);
  $output .= "</div>\n";
  return $output;
}

/**
 * Views Slideshow: "previous" control.
 *
 * @ingroup themeable
 */
function theme_views_slideshow_thumbnailhover_control_previous($id, $view, $options) {
  return l(t('Previous'), '#', array('attributes' => array(
    'class' => 'views_slideshow_thumbnailhover_previous views_slideshow_previous',
    'id' => "views_slideshow_thumbnailhover_prev_$id",
  )));
}

/**
 * Views Slideshow: "pause" control.
 *
 * @ingroup themeable
 */
function theme_views_slideshow_thumbnailhover_control_pause($id, $view, $options) {
  return l(t('Pause'), '#', array('attributes' => array(
    'class' => 'views_slideshow_thumbnailhover_pause views_slideshow_pause',
    'id' => "views_slideshow_thumbnailhover_playpause_$id",
  )));
}

/**
 * Views Slideshow: "next" control.
 *
 * @ingroup themeable
 */
function theme_views_slideshow_thumbnailhover_control_next($id, $view, $options) {
  return l(t('Next'), '#', array('attributes' => array(
    'class' => 'views_slideshow_thumbnailhover_next views_slideshow_next',
    'id' => "views_slideshow_thumbnailhover_next_$id",
  )));
}

/**
 * Views Slideshow: image counter.
 *
 * @ingroup themeable
 */
function theme_views_slideshow_thumbnailhover_image_count($id, $view, $options) {
  $attributes['class'] = 'views_slideshow_thumbnailhover_image_count views_slideshow_image_count';
  $attributes['id'] = "views_slideshow_thumbnailhover_image_count_$id";
  $attributes = drupal_attributes($attributes);

  $counter = '<span class="num">1</span> ' . t('of') .' <span class="total">1</span>';

  return "<div$attributes>$counter</div>";
}
