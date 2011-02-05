<?php /* Smarty version 2.6.26, created on 2010-07-02 13:14:12
         compiled from CoreHome/templates/header_message.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'translate', 'CoreHome/templates/header_message.tpl', 3, false),)), $this); ?>
<span id="header_message">
<?php if ($this->_tpl_vars['piwikUrl'] == 'http://piwik.org/demo/'): ?>
	<?php echo ((is_array($_tmp='General_YouAreCurrentlyViewingDemoOfPiwik')) ? $this->_run_mod_handler('translate', true, $_tmp, "<a target='_blank' href='http://piwik.org'>Piwik</a>", "<a href='http://piwik.org/'>", "</a>", "<a href='http://piwik.org'>piwik.org</a>") : smarty_modifier_translate($_tmp, "<a target='_blank' href='http://piwik.org'>Piwik</a>", "<a href='http://piwik.org/'>", "</a>", "<a href='http://piwik.org'>piwik.org</a>")); ?>

<?php elseif ($this->_tpl_vars['latest_version_available']): ?>
	<img src='themes/default/images/warning_small.png' alt='' style="vertical-align: middle;" /> 
	<?php if ($this->_tpl_vars['isSuperUser']): ?>
		<?php echo ((is_array($_tmp='General_PiwikXIsAvailablePleaseUpdateNow')) ? $this->_run_mod_handler('translate', true, $_tmp, $this->_tpl_vars['latest_version_available'], "<br /><a href='index.php?module=CoreUpdater&action=newVersionAvailable'>", "</a>", "<a href='misc/redirectToUrl.php?url=http://piwik.org/changelog/' target='_blank'>", "</a>") : smarty_modifier_translate($_tmp, $this->_tpl_vars['latest_version_available'], "<br /><a href='index.php?module=CoreUpdater&action=newVersionAvailable'>", "</a>", "<a href='misc/redirectToUrl.php?url=http://piwik.org/changelog/' target='_blank'>", "</a>")); ?>

	<?php else: ?>
		<?php echo ((is_array($_tmp='General_PiwikXIsAvailablePleaseNotifyPiwikAdmin')) ? $this->_run_mod_handler('translate', true, $_tmp, "<a href='misc/redirectToUrl.php?url=http://piwik.org/' target='_blank'>Piwik</a> <a href='misc/redirectToUrl.php?url=http://piwik.org/changelog/' target='_blank'>".($this->_tpl_vars['latest_version_available'])."</a>") : smarty_modifier_translate($_tmp, "<a href='misc/redirectToUrl.php?url=http://piwik.org/' target='_blank'>Piwik</a> <a href='misc/redirectToUrl.php?url=http://piwik.org/changelog/' target='_blank'>".($this->_tpl_vars['latest_version_available'])."</a>")); ?>

	<?php endif; ?>
<?php else: ?>
	<?php echo ((is_array($_tmp='General_PiwikIsACollaborativeProjectYouCanContribute')) ? $this->_run_mod_handler('translate', true, $_tmp, "<a href='misc/redirectToUrl.php?url=http://piwik.org'>", ($this->_tpl_vars['piwik_version'])."</a>", "<br />", "<a target='_blank' href='misc/redirectToUrl.php?url=http://piwik.org/contribute/'>", "</a>") : smarty_modifier_translate($_tmp, "<a href='misc/redirectToUrl.php?url=http://piwik.org'>", ($this->_tpl_vars['piwik_version'])."</a>", "<br />", "<a target='_blank' href='misc/redirectToUrl.php?url=http://piwik.org/contribute/'>", "</a>")); ?>

<?php endif; ?>
</span>