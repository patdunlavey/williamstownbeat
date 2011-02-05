<?php
/**
 * Argument handler to accept a user id. Filter by the nid of the subscribed content types in organic groups.
 */
class advanced_notifications_views_handler_argument_node_notifications_nid_type_og extends views_handler_argument_user_uid {
  function query() {
    $this->ensure_my_table();
    
    $where_type = "$this->table_alias.type IN (SELECT nf.value FROM {notifications_fields} nf
    LEFT JOIN {notifications} nt ON nf.sid = nt.sid
    WHERE nf.field = 'type' AND nt.uid ";
    $where_og = "$this->table_alias.nid IN (SELECT oga.nid FROM {og_ancestry} oga 
    LEFT JOIN {notifications_fields} nf ON oga.group_nid = nf.value AND nf.field = 'group'
    LEFT JOIN {notifications} nt ON nf.sid = nt.sid
    WHERE nt.uid ";
    
    $this->query->set_group_operator($this->options['group_operator']);
    
    foreach ($this->query->where as $where_group_id => $where_group) {
      if ($this->options['group'] == $where_group['type']) {
        $group = $where_group_id;
      }
    }
    if (!isset($group)) {
      $group = $this->query->set_where_group($this->options['group'], NULL, 'where');
    }

    if (!empty($this->options['break_phrase'])) {
      views_break_phrase($this->argument, $this);
    }
    else {
      $this->value = array($this->argument);
    }

    if (count($this->value) > 1) {
      $operator = empty($this->options['not']) ? 'IN' : 'NOT IN';
      $placeholders = implode(', ', array_fill(0, sizeof($this->value), '%d'));
      $where_type = "$where_type $operator ($placeholders))";
      $where_og = "$where_og $operator ($placeholders))";
      $where = "$where_type AND $where_og";
      $this->query->add_where($group, $where, $this->value, $this->value);
    }
    else {
      $operator = empty($this->options['not']) ? '=' : '!=';
      $where_type = "$where_type $operator %d)";
      $where_og = "$where_og $operator %d)";
      $where = "$where_type AND $where_og";
      $this->query->add_where($group, $where, $this->argument, $this->argument);
    }
  }
  
  function options_form(&$form, &$form_state) {
    parent::options_form($form, $form_state);
    $form['group'] = array(
      '#type' => 'radios',
      '#title' => t('Filter Operator'),
      '#options' => array('AND' => t('AND'), 'OR' => t('OR')),
      '#default_value' => $this->options['group'],
      '#description' => t('The operator to be used in groups of WHERE database clauses.'),
    );
    $form['group_operator'] = array(
      '#type' => 'radios',
      '#title' => t('Group Operator'),
      '#options' => array('AND' => t('AND'), 'OR' => t('OR')),
      '#default_value' => $this->options['group_operator'],
      '#description' => t('The operator to join the groups of WHERE database clauses.'),
    );
  }
}

