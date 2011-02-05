<?php
/**
 * Filter by the nid of the subscribed content types in organic groups.
 */
class advanced_notifications_views_handler_filter_node_notifications_nid_type_og extends views_handler_filter_user_current {
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

    if (empty($this->value)) {
      $where_type .= '<> ***CURRENT_USER***)';
      $where_og .= '<> ***CURRENT_USER***)';
      if ($this->accept_null) {
        $where_type = "($where_type OR $this->table_alias.type IS NULL)";
        $where_og = "($where_og OR $this->table_alias.nid IS NULL)";
      }
    }
    else {
      $where_type .= '= ***CURRENT_USER***)';
      $where_og .= '= ***CURRENT_USER***)';
    }
    $where = "$where_type AND $where_og";
    
    foreach ($this->query->where as $where_group_id => $where_group) {
      if ($this->options['group'] == $where_group['type']) {
        $group = $where_group_id;
      }
    }
    if (!isset($group)) {
      $group = $this->query->set_where_group($this->options['group'], NULL, 'where');
    }
    
    $this->query->add_where($group, $where);    
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
