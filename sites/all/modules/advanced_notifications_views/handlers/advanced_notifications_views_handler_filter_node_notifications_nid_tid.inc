<?php
/**
 * Filter by the nid of the subscribed taxonomy terms.
 */
class advanced_notifications_views_handler_filter_node_notifications_nid_tid extends views_handler_filter_user_current {
  function query() {
    $this->ensure_my_table();
    $where = "$this->table_alias.$this->real_field IN (SELECT tn.nid FROM {term_node} tn 
    LEFT JOIN {notifications_fields} nf ON tn.tid = nf.value AND nf.field = 'tid'
    LEFT JOIN {notifications} nt ON nf.sid = nt.sid
    WHERE nt.uid ";
    
    $this->query->set_group_operator($this->options['group_operator']);

    if (empty($this->value)) {
      $where .= '<> ***CURRENT_USER***)';
      if ($this->accept_null) {
        $where = $where . " OR $this->table_alias.$this->real_field IS NULL";
      }
    }
    else {
      $where .= '= ***CURRENT_USER***)';
    }
    
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
