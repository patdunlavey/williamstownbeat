<?php /* Smarty version 2.6.26, created on 2010-07-02 13:14:12
         compiled from /home/wbeat/public_html/piwik/plugins/CoreHome/templates/index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'ajaxLoadingDiv', '/home/wbeat/public_html/piwik/plugins/CoreHome/templates/index.tpl', 7, false),array('function', 'ajaxRequestErrorDiv', '/home/wbeat/public_html/piwik/plugins/CoreHome/templates/index.tpl', 8, false),)), $this); ?>
<?php $this->assign('showSitesSelection', true); ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "CoreHome/templates/header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php if (isset ( $this->_tpl_vars['menu'] ) && $this->_tpl_vars['menu']): ?><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "CoreHome/templates/menu.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php endif; ?>
<div style="clear:both;"></div>
<?php echo smarty_function_ajaxLoadingDiv(array(), $this);?>

<?php echo smarty_function_ajaxRequestErrorDiv(array(), $this);?>


<div id="content">
<?php if ($this->_tpl_vars['content']): ?><?php echo $this->_tpl_vars['content']; ?>
<?php endif; ?>
</div>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "CoreHome/templates/piwik_tag.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</body>
</html>