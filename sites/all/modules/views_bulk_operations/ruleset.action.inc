<?php
// $Id: ruleset.action.inc,v 1.1.2.5 2010/05/05 01:09:50 kratib Exp $

function views_bulk_operations_ruleset_action_info() {
  if (!module_exists('rules')) return array();
  $actions = array();
  foreach (rules_get_configured_items('rule_sets') as $ruleset_key => $ruleset) {
    if (count($ruleset['arguments']) == 1) { // For now, we only accept rulesets with one argument (taken to be the 'type')
      $arg = key($ruleset['arguments']);
      $actions["views_bulk_operations_ruleset_action_{$ruleset_key}"] = array(
        'type' => $ruleset['arguments'][$arg]['type'],
        'parameters' => array('ruleset' => $ruleset_key),
        'description' => $ruleset['label'],
        'configurable' => FALSE,
        'rules_ignore' => TRUE,
        'callback' => 'views_bulk_operations_ruleset_action_one',
      );
    }
    else if (!count($ruleset['arguments'])) { // No argument: system action
      $actions["views_bulk_operations_ruleset_action_{$ruleset_key}"] = array(
        'type' => 'system',
        'parameters' => array('ruleset' => $ruleset_key),
        'description' => $ruleset['label'],
        'configurable' => FALSE,
        'rules_ignore' => TRUE,
        'callback' => 'views_bulk_operations_ruleset_action_zero',
      );
    }
  }
  return $actions;
}

function views_bulk_operations_ruleset_action_one(&$object, $context) {
  rules_invoke_rule_set($context['ruleset'], $object);
}

function views_bulk_operations_ruleset_action_zero(&$object, $context) {
  rules_invoke_rule_set($context['ruleset']);
}

