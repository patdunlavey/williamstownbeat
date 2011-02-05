<?php /* Smarty version 2.6.26, created on 2010-07-02 12:17:41
         compiled from Installation/templates/welcome.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'translate', 'Installation/templates/welcome.tpl', 1, false),array('function', 'url', 'Installation/templates/welcome.tpl', 27, false),)), $this); ?>
<h1><?php echo ((is_array($_tmp='Installation_Welcome')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
</h1>

<?php if ($this->_tpl_vars['newInstall']): ?>
<?php echo ((is_array($_tmp='Installation_WelcomeHelp')) ? $this->_run_mod_handler('translate', true, $_tmp, $this->_tpl_vars['totalNumberOfSteps']) : smarty_modifier_translate($_tmp, $this->_tpl_vars['totalNumberOfSteps'])); ?>

<?php else: ?>
<p><?php echo ((is_array($_tmp='Installation_ConfigurationHelp')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
</p>
<br />
<div class="error">
<?php echo $this->_tpl_vars['errorMessage']; ?>

</div>
<?php endif; ?>

<?php echo '
<script type="text/javascript">
<!--
$(function() {
if (document.location.protocol === \'https:\') {
	$(\'p.nextStep a\').attr(\'href\', $(\'p.nextStep a\').attr(\'href\') + \'&clientProtocol=https\');
}
});
//-->
</script>
'; ?>


<?php if (! $this->_tpl_vars['showNextStep']): ?>
<p class="nextStep">
	<a href="<?php echo smarty_function_url(array(), $this);?>
"><?php echo ((is_array($_tmp='General_Refresh')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
 &raquo;</a>
</p>
<?php endif; ?>