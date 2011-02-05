<?php /* Smarty version 2.6.26, created on 2010-07-02 13:16:06
         compiled from /home/wbeat/public_html/piwik/plugins/CoreAdminHome/templates/generalSettings.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'loadJavascriptTranslations', '/home/wbeat/public_html/piwik/plugins/CoreAdminHome/templates/generalSettings.tpl', 4, false),array('function', 'ajaxErrorDiv', '/home/wbeat/public_html/piwik/plugins/CoreAdminHome/templates/generalSettings.tpl', 9, false),array('function', 'ajaxLoadingDiv', '/home/wbeat/public_html/piwik/plugins/CoreAdminHome/templates/generalSettings.tpl', 10, false),array('modifier', 'translate', '/home/wbeat/public_html/piwik/plugins/CoreAdminHome/templates/generalSettings.tpl', 7, false),array('modifier', 'inlineHelp', '/home/wbeat/public_html/piwik/plugins/CoreAdminHome/templates/generalSettings.tpl', 31, false),)), $this); ?>
<?php $this->assign('showSitesSelection', false); ?>
<?php $this->assign('showPeriodSelection', false); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "CoreAdminHome/templates/header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php echo smarty_function_loadJavascriptTranslations(array('plugins' => 'UsersManager'), $this);?>

<script type="text/javascript" src="plugins/CoreAdminHome/templates/generalSettings.js"></script>

<h2><?php echo ((is_array($_tmp='General_GeneralSettings')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
</h2>

<?php echo smarty_function_ajaxErrorDiv(array('id' => 'ajaxError'), $this);?>

<?php echo smarty_function_ajaxLoadingDiv(array('id' => 'ajaxLoading'), $this);?>

<table class="adminTable adminTableNoBorder" style='width:900px;'>
<tr>
	<td style='width:400px'><?php echo ((is_array($_tmp='General_AllowPiwikArchivingToTriggerBrowser')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
</td>
	<td style='width:220px'>
	<fieldset>
		<label><input type="radio" value="1" name="enableBrowserTriggerArchiving"<?php if ($this->_tpl_vars['enableBrowserTriggerArchiving'] == 1): ?> checked="checked"<?php endif; ?> /> 
			<?php echo ((is_array($_tmp='General_Yes')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
 <br />
			<span class="form-description"><?php echo ((is_array($_tmp='General_Default')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
</span>
		</label><br /><br />
		
		<label><input type="radio" value="0" name="enableBrowserTriggerArchiving"<?php if ($this->_tpl_vars['enableBrowserTriggerArchiving'] == 0): ?> checked="checked"<?php endif; ?> /> 
			<?php echo ((is_array($_tmp='General_No')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
 <br />
			<span class="form-description"><?php echo ((is_array($_tmp='General_ArchivingTriggerDescription')) ? $this->_run_mod_handler('translate', true, $_tmp, "<a href='misc/redirectToUrl.php?url=http://piwik.org/docs/setup-auto-archiving/' target='_blank'>", "</a>") : smarty_modifier_translate($_tmp, "<a href='misc/redirectToUrl.php?url=http://piwik.org/docs/setup-auto-archiving/' target='_blank'>", "</a>")); ?>
</span>
		</label> 
	</fieldset>
	<td>
	<?php ob_start(); ?>
		<?php echo ((is_array($_tmp='General_ArchivingInlineHelp')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
<br /> 
		<?php echo ((is_array($_tmp='General_SeeTheOfficialDocumentationForMoreInformation')) ? $this->_run_mod_handler('translate', true, $_tmp, "<a href='misc/redirectToUrl.php?url=http://piwik.org/docs/setup-auto-archiving/' target='_blank'>", "</a>") : smarty_modifier_translate($_tmp, "<a href='misc/redirectToUrl.php?url=http://piwik.org/docs/setup-auto-archiving/' target='_blank'>", "</a>")); ?>

	<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('browserArchivingHelp', ob_get_contents());ob_end_clean(); ?>
	<?php echo ((is_array($_tmp=$this->_tpl_vars['browserArchivingHelp'])) ? $this->_run_mod_handler('inlineHelp', true, $_tmp) : smarty_modifier_inlineHelp($_tmp)); ?>
	</td>
	</td>
</tr>
<tr>
	<td><label for="todayArchiveTTL"><?php echo ((is_array($_tmp='General_ReportsForTodayWillBeProcessedAtMostEvery')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
</label></td>
	<td>
		<?php echo ((is_array($_tmp='General_NSeconds')) ? $this->_run_mod_handler('translate', true, $_tmp, "<input size='3' value='".($this->_tpl_vars['todayArchiveTimeToLive'])."' id='todayArchiveTimeToLive' />") : smarty_modifier_translate($_tmp, "<input size='3' value='".($this->_tpl_vars['todayArchiveTimeToLive'])."' id='todayArchiveTimeToLive' />")); ?>
 
	</td>
	<td width='450px'>
	<?php ob_start(); ?>
		<?php echo ((is_array($_tmp='General_SmallTrafficYouCanLeaveDefault')) ? $this->_run_mod_handler('translate', true, $_tmp, 10) : smarty_modifier_translate($_tmp, 10)); ?>
<br /> 
		<?php echo ((is_array($_tmp='General_MediumToHighTrafficItIsRecommendedTo')) ? $this->_run_mod_handler('translate', true, $_tmp, 1800, 3600) : smarty_modifier_translate($_tmp, 1800, 3600)); ?>

	<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('archiveTodayTTLHelp', ob_get_contents());ob_end_clean(); ?>
	<?php echo ((is_array($_tmp=$this->_tpl_vars['archiveTodayTTLHelp'])) ? $this->_run_mod_handler('inlineHelp', true, $_tmp) : smarty_modifier_inlineHelp($_tmp)); ?>
	</td>
	</td>
</tr>

</table>
<input type="submit" value="<?php echo ((is_array($_tmp='General_Save')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
" id="generalSettingsSubmit" class="submit" />
<br /><br />


<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "CoreAdminHome/templates/footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>