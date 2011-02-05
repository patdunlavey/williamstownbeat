<?php
// $Id$

/**
 * @file
 * Advanced Views integration for Notifications.
 * 
 */


/**
 * Implementation of hook_views_handlers().
 */
function advanced_notifications_views_views_handlers() {
  return array(
    'info' => array(
      'path' => drupal_get_path('module', 'advanced_notifications_views') .'/handlers',
    ),
    'handlers' => array(
      // filter handlers
      'advanced_notifications_views_handler_filter_node_notifications_nid_tid' => array(
        'parent' => 'views_handler_filter_user_current',
      ),
      'advanced_notifications_views_handler_filter_node_notifications_nid_type' => array(
        'parent' => 'views_handler_filter_user_current',
      ),
      'advanced_notifications_views_handler_filter_node_notifications_nid_type_og' => array(
        'parent' => 'views_handler_filter_user_current',
      ),
      // argument handlers
      'advanced_notifications_views_handler_argument_node_notifications_nid_tid' => array(
        'parent' => 'views_handler_argument_user_uid',
      ),
      'advanced_notifications_views_handler_argument_node_notifications_nid_type' => array(
        'parent' => 'views_handler_argument_user_uid',
      ),
      'advanced_notifications_views_handler_argument_node_notifications_nid_type_og' => array(
        'parent' => 'views_handler_argument_user_uid',
      ),
    ),
  );
}

/**
 * Implementation of hook_views_data().
 */
function advanced_notifications_views_views_data_alter(&$data) {

  if (module_exists('taxonomy')) {
    // Filter by the nid of the subscribed taxonomy terms
    $data['node']['notifications_nid_tid'] = array(
      'group' => t('Notifications'),
      'title' => t('Subscribed Tags'),
      // Information for accepting a uid as an argument
      'argument' => array(
        'real field' => 'nid',
        'handler' => 'advanced_notifications_views_handler_argument_node_notifications_nid_tid',
        'parent' => 'views_handler_argument_user_uid', // make sure parent is included
        'name field' => 'title', // the field to display in the summary.
        'numeric' => TRUE,
        'validate type' => 'nid',
        'help' => t("The node ID of the user's taxonomy terms subscriptions."), // The help that appears on the UI,
      ),
      // Information for accepting the current user as a filter
      'filter' => array(
        'real field' => 'nid',
        'handler' => 'advanced_notifications_views_handler_filter_node_notifications_nid_tid',
        'help' => t("The node ID of the currently logged in user's taxonomy terms subscriptions."), // The help that appears on the UI,
      ),
    );
  }
  
  // Filter by the nid of the subscribed content types
  $data['node']['notifications_nid_type'] = array(
    'group' => t('Notifications'),
    'title' => t('Subscribed Content Types'),
    // Information for accepting a uid as an argument
    'argument' => array(
      'real field' => 'type',
      'handler' => 'advanced_notifications_views_handler_argument_node_notifications_nid_type',
      'parent' => 'views_handler_argument_user_uid', // make sure parent is included
      'name field' => 'title', // the field to display in the summary.
      'numeric' => TRUE,
      'validate type' => 'nid',
      'help' => t("The node ID of the user's content types subscriptions."), // The help that appears on the UI,
    ),
    // Information for accepting the current user as a filter
    'filter' => array(
      'real field' => 'type',
      'handler' => 'advanced_notifications_views_handler_filter_node_notifications_nid_type',
      'help' => t("The node ID of the currently logged in user's content types subscriptions."), // The help that appears on the UI,
    ),
  );
  
  if (module_exists('og')) {
    // Filter by the nid of the subscribed content types in organic groups
    $data['node']['notifications_nid_type_og'] = array(
      'group' => t('Notifications'),
      'title' => t('Subscribed Types in OG'),
      // Information for accepting a uid as an argument
      'argument' => array(
        'handler' => 'advanced_notifications_views_handler_argument_node_notifications_nid_type_og',
        'parent' => 'views_handler_argument_user_uid', // make sure parent is included
        'name field' => 'title', // the field to display in the summary.
        'numeric' => TRUE,
        'validate type' => 'nid',
        'help' => t("The node ID of the user's content types in organic groups subscriptions."), // The help that appears on the UI,
      ),
      // Information for accepting the current user as a filter
      'filter' => array(
        'handler' => 'advanced_notifications_views_handler_filter_node_notifications_nid_type_og',
        'help' => t("The node ID of the currently logged in user's content types in organic groups subscriptions."), // The help that appears on the UI,
      ),
    );
  }
}