<?php

/** @file
 * Admin functionality
 */

/**
 * Menu callback; Delete a superslot
 *
 */
function google_admanager_admin_superslot_delete($name) {
  $superslots = variable_get('google_admanager_superslots', array());
  if (! isset($superslots[$name])) {
    drupal_set_message(t('Superslot %name not found.', array('%name' => $name)));
    $output = '';
  }
  else {
    $output = drupal_get_form('google_admanager_admin_superslot_confirm_delete', $name);
  }

  return $output;
}

/**
 * Form builder; Builds the confirmation form for deleting a superslot.
 */
function google_admanager_admin_superslot_confirm_delete(&$form_state, $name) {
  $form = array();
  $form['#superslot'] = $name;
  return confirm_form($form, t('Are you sure you want to delete the superslot %name?', array('%name' => $name)), 'admin/settings/google_admanager/superslot');
}

/**
 * Process google_admanager_admin_superslot_confirm_delete form submissions.
 */
function google_admanager_admin_superslot_confirm_delete_submit($form, &$form_state) {
  $superslots = variable_get('google_admanager_superslots', array());
  unset($superslots[$form['#superslot']]);
  variable_set('google_admanager_superslots', $superslots);

  drupal_set_message(t('Superslot %name has been deleted.', array('%name' => $form['#superslot'])));
  $form_state['redirect'] = 'admin/settings/google_admanager/superslot';
}

/**
 * Implementation of hook_admin_settings() for configuring the module.
 */
function google_admanager_admin_settings_form() {
  $form = array();

  $form['google_admanager_account'] = array(
    '#type' => 'textfield',
    '#title' => t('DFP Property Code'),
    '#default_value' => variable_get('google_admanager_account', 'ca-pub-'),
    '#size' => 30,
    '#maxlength' => 40,
    '#required' => TRUE,
    '#description' => t('See detailed instruction in README.txt'),
  );
  $form['google_admanager_ad_slots'] = array(
    '#type' => 'textarea',
    '#title' => t('Ad slots'),
    '#default_value' => variable_get('google_admanager_ad_slots', ''),
    '#description' => t('Enter one Ad Slot name per line.'),
  );
  $form['google_admanager_noblock'] = array(
    '#type' => 'checkbox',
    '#title' => t('Don\'t create blocks'),
    '#default_value' => variable_get('google_admanager_noblock', FALSE),
    '#description' => t('This option allow you to use only superslot. Handful when you have dozens of ad slots or more. <strong>Switch on/off this option may reset blocks positions.</strong>'),
  );
  $form['google_admanager_lazy'] = array(
    '#type' => 'checkbox',
    '#title' => t('Lazy loading'),
    '#default_value' => variable_get('google_admanager_lazy', FALSE),
    '#description' => t('(Experimental) Insert DFP code before &lt;/body&gt; instead of in header (not work with inline ad). Read more in README.txt'),
  );
  $form['google_admanager_autodetect'] = array(
    '#type' => 'checkbox',
    '#title' => t('Autodetect ad slot size'),
    '#default_value' => variable_get('google_admanager_autodetect', FALSE),
    '#description' => t('Auto detect ad slot size if name is in format <em>foo_??x??_bar</em> (e.g. <em>homepage_728x90_1</em>). Useful in lazy loading.'),
  );
  $form['google_admanager_nodetype_attributes'] = array(
    '#type' => 'checkbox',
    '#title' => t('Expose node type as atttribute'),
    '#default_value' => variable_get('google_admanager_nodetype_attributes', FALSE),
    '#description' => t('This option allows you to target whole content types as an attribute within Google Ad Manager'),
  );
  if (module_exists('taxonomy')) {
    // Get an array of vocabularies
    $vocabs = taxonomy_get_vocabularies();

    // Build the form item defaults
    $vocab_form_item = array(
      '#title' => t('Expose vocabularies as attributes'),
      '#description' => t('Enabling a vocabulary will allow you to target terms within the vocabulary from Google Ad Manager'),
    );

    // If vocabs are empty, insert a prompt form item
    if (empty($vocabs)) {
      $form['google_admanager_vocab_attributes'] = array(
        '#type' => 'item',
        '#value' => '<span class="error">'. t('You must have at least 1 vocabulary for this feature to work.') .'</span>',
      ) + $vocab_form_item;
    }
    else {
      // Build a list of vocabularies as "vid => name" pairs
      $options = array();
      foreach ($vocabs as $v) {
        $options[$v->vid] = $v->name;
      }

      // Create a form item of checkboxes
      $form['google_admanager_vocab_attributes'] = array(
        '#type' => 'checkboxes',
        '#default_value' => variable_get('google_admanager_vocab_attributes', array()),
        '#options' => $options,
      ) + $vocab_form_item;
    }
  }
  return system_settings_form($form);
}

/**
 * Implementation of hook_admin_settings_form_validate().
 */
function google_admanager_admin_settings_form_validate($form, &$form_state) {
  if (!preg_match('/^ca-pub-\d+$/', $form_state['values']['google_admanager_account'])) {
    form_set_error('google_admanager_account', t('A valid DFP Property Code is case sensitive and formatted like ca-pub-nnnnnnnnnnnnnnnn.'));
  }
}

/**
 * Implementation of hook_admin_settings_form_submit().
 */
function google_admanager_admin_settings_form_submit($form, &$form_state) {
  $ad_slots = _google_admanager_get_ad_slots();
  $result = db_query("SELECT bid, delta FROM {blocks} WHERE module = 'google_admanager'");
  while ($block = db_fetch_object($result)) {
    //remove the block when it is not in the list anymore
    if (!isset($ad_slots[$block->delta]) && substr($block->delta, 0, 10) !== 'superslot:') {
      db_query("DELETE FROM {blocks} WHERE bid = %d", $block->bid);
    }
  }

  // Remove orphan ad slots in superslots
  $superslots = variable_get('google_admanager_superslots', array());
  $ad_slot_names = array_values($ad_slots);
  foreach ($superslots as $name => $slots) {
    foreach ($slots as $ad_slot => $php) {
      if (! in_array($ad_slot, $ad_slot_names)) {
        unset($superslots[$name][$ad_slot]);
      }
    }
  }
  variable_set('google_admanager_superslots', $superslots);
}

/**
 * Form to manage (add/remove) superslot
 */
function google_admanager_admin_superslot_form() {
  $form = array();
  $superslots = variable_get('google_admanager_superslots', array());
  $superslot_list = array();

  foreach ($superslots as $name => $slots) {
    $superslot_list[] = '<li>'. l($name, 'admin/build/block/configure/google_admanager/superslot:'. $name) .' ['. l('Delete', 'admin/settings/google_admanager/superslot/delete/'. $name) .']</li>';
  }

  $form['google_admanager_superslot'] = array(
    '#value' => t('A superslot is a block containing many slots, each slot has its own visibility criteria'),
  );

  $form['google_admanager_superslot_current'] = array(
    '#type' => 'fieldset',
    '#title' => t('Current superslot(s)'),
  );
  $form['google_admanager_superslot_current']['list'] = array(
    '#value' => '<ul>'. implode('', $superslot_list) .'</ul>',
  );

  $form['google_admanager_superslot_new'] = array(
    '#type' => 'fieldset',
    '#title' => t('Create new superslot'),
  );
  $form['google_admanager_superslot_new']['google_admanager_superslot_name'] = array(
    '#type' => 'textfield',
    '#title' => t('Superslot name'),
    '#description' => t('Enter a unique name (only alphanumeric and underscore, 1-20 characters)'),
    '#size' => 30,
  );
  $form['google_admanager_superslot_new']['google_admanager_superslot_create'] = array(
    '#type' => 'submit',
    '#value' => t('Create'),
  );

  return $form;
}

/**
 * Validator for google_admanager_admin_superslot_form
 */
function google_admanager_admin_superslot_form_validate($form, &$form_state) {
  $superslots = variable_get('google_admanager_superslots', array());
  if (!preg_match('/^[a-zA-Z0-9_]{1,20}$/', $form_state['values']['google_admanager_superslot_name'])) {
    form_set_error('google_admanager_superslot_name', t('Superslot name can contain only alphanumeric and underscore, 1-20 characters.'));
  }
  if (isset($superslots[$form_state['values']['google_admanager_superslot_name']])) {
    form_set_error('google_admanager_superslot_name', t('Duplicate superslot name.'));
  }
}

/**
 * Submitter for google_admanager_admin_superslot_form
 */
function google_admanager_admin_superslot_form_submit($form, &$form_state) {
  $superslots = variable_get('google_admanager_superslots', array());
  $superslots[$form_state['values']['google_admanager_superslot_name']] = array();
  variable_set('google_admanager_superslots', $superslots);
}

/**
 * Callback for hook_block()
 */
function _google_admanager_block($op = 'list', $delta = 0, $edit = array()) {
  if ($op == 'list') {
    $blocks = array();
    if (! variable_get('google_admanager_noblock', FALSE)) {
      $ad_slots = _google_admanager_get_ad_slots();
      foreach ($ad_slots as $delta => $name) {
        $blocks[$delta] = array(
          'info' => 'GAM Ad slot: '. $name,
          'cache' => BLOCK_NO_CACHE,
        );
      }
    }

    $superslots = variable_get('google_admanager_superslots', array());
    foreach ($superslots as $name => $slots) {
      $blocks['superslot:'. $name] = array(
        'info' => 'GAM Superslot: '. $name,
        'cache' => BLOCK_NO_CACHE,
      );
    }
    return $blocks;
  }
  elseif ($op == 'configure') {
    // Reuse the 'use PHP for block visibility' from block.module
    if (!user_access('use PHP for block visibility') || substr($delta, 0, 10) !== 'superslot:') {
      return;
    }

    $superslots = variable_get('google_admanager_superslots', array());
    $name = substr($delta, 10);
    if (! isset($superslots[$name])) {
      return;
    }

    $form = array();
    $form['visibility'] = array(
      '#type' => 'fieldset',
      '#title' => t('Ad slots visibility'),
      '#description' => t('Use PHP code to define ad slot visibility. For example, to display an ad slot only to anonymous user, use <em>return empty($GLOBALS[\'user\']->uid);</em>. Or, to simple enable an ad slot, use <em>return TRUE;</em>'),
    );

    $ad_slots = array_values(_google_admanager_get_ad_slots());
    $ad_slots = array_combine($ad_slots, $ad_slots);
    $superslot = $superslots[$name];

    // Create 5 empty slots configuration
    // @TODO: It could be better to implement AHAH form
    $superslot += array('fake slot1' => '', 'fake slot2' => '', 'fake slot3' => '');
    $i = 1;
    foreach ($superslot as $ad_slot => $php) {
      $form['visibility']['superslot_'. $i .'_adslot'] = array(
        '#type' => 'select',
        '#title' => t('Ad slot'),
        '#default_value' => $ad_slot,
        '#options' => $ad_slots,
      );
      $form['visibility']['superslot_'. $i++ .'_php'] = array(
        '#type' => 'textfield',
        '#title' => t('PHP code for visibility condition'),
        '#default_value' => $php,
      );
    }

    return $form;
  }
  elseif ($op == 'save') {
    if (!user_access('use PHP for block visibility') || substr($delta, 0, 10) !== 'superslot:') {
      return;
    }

    // When save account settings, delete blocks which belongs to the ad slots that have been removed
    $superslot = array();
    foreach ($edit as $key => $value) {
      if (preg_match('/superslot_(\d+)_adslot/', $key)) {
        $php = $edit[str_replace('adslot', 'php', $key)];
        if (! empty($php)) {
          $superslot[$value] = $php;
        }
      }
    }
    $superslots = variable_get('google_admanager_superslots', array());
    $superslots[substr($delta, 10)] = $superslot;
    variable_set('google_admanager_superslots', $superslots);
  }
}
