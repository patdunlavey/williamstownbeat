<?php /* Smarty version 2.6.26, created on 2010-07-19 00:04:57
         compiled from CoreHome/templates/datatable_actions_subdatable.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'translate', 'CoreHome/templates/datatable_actions_subdatable.tpl', 6, false),)), $this); ?>
<tr id="<?php echo $this->_tpl_vars['properties']['uniqueId']; ?>
"></tr>
<?php if (isset ( $this->_tpl_vars['arrayDataTable']['result'] ) && $this->_tpl_vars['arrayDataTable']['result'] == 'error'): ?>
	<?php echo $this->_tpl_vars['arrayDataTable']['message']; ?>
 
<?php else: ?>
	<?php if (count ( $this->_tpl_vars['arrayDataTable'] ) == 0): ?>
	<tr><td colspan="<?php echo $this->_tpl_vars['nbColumns']; ?>
"><?php echo ((is_array($_tmp='CoreHome_CategoryNoData')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
</td></tr>
	<?php else: ?>
		<?php $_from = $this->_tpl_vars['arrayDataTable']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['row']):
?>
		<tr <?php if ($this->_tpl_vars['row']['idsubdatatable']): ?>class="subActionsDataTable" id="<?php echo $this->_tpl_vars['row']['idsubdatatable']; ?>
"<?php else: ?>class="actionsDataTable"<?php endif; ?>>
			<?php $_from = $this->_tpl_vars['dataTableColumns']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['column']):
?>
			<td>
			<?php if (! $this->_tpl_vars['row']['idsubdatatable'] && $this->_tpl_vars['column'] == 'label' && isset ( $this->_tpl_vars['row']['metadata']['url'] )): ?><span class="urlLink"><?php echo $this->_tpl_vars['row']['metadata']['url']; ?>
</span><?php endif; ?>
			<?php if (isset ( $this->_tpl_vars['row']['columns'][$this->_tpl_vars['column']] )): ?><?php echo $this->_tpl_vars['row']['columns'][$this->_tpl_vars['column']]; ?>
<?php else: ?><?php echo $this->_tpl_vars['defaultWhenColumnValueNotDefined']; ?>
<?php endif; ?>
			</td>
			<?php endforeach; endif; unset($_from); ?>
		</tr>
		<?php endforeach; endif; unset($_from); ?>
	<?php endif; ?>		
<?php endif; ?>