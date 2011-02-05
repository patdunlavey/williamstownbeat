<?php
/**
 * Argument handler to accept a user id. Filter by the nid of the subscribed taxonomy terms.
 */
class advanced_notifications_views_handler_argument_node_notifications_nid_tid extends views_handler_argument_user_uid {
  function query() {
    $this->ensure_my_table();
    
    $where = "$this->table_alias.$this->real_field IN (SELECT tn.nid FROM {term_node} tn 
    LEFT JOIN {notifications_fields} nf ON tn.tid = nf.value AND nf.field = 'tid'
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
      $this->query->add_where($group, "$where $operator ($placeholders))", $this->value);
    }
    else {
      $operator = empty($this->options['not']) ? '=' : '!=';
      $this->query->add_where($group, "$where $operator %d)", $this->argument);
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

