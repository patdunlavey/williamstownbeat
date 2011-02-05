<?php /* Smarty version 2.6.26, created on 2010-07-19 00:01:38
         compiled from /home/wbeat/public_html/piwik/plugins/VisitsSummary/templates/index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'translate', '/home/wbeat/public_html/piwik/plugins/VisitsSummary/templates/index.tpl', 4, false),)), $this); ?>
<script type="text/javascript" src="plugins/CoreHome/templates/sparkline.js"></script>

<a name="evolutionGraph" graphId="VisitsSummarygetEvolutionGraph"></a>
<h2><?php echo ((is_array($_tmp='VisitsSummary_EvolutionOverLastPeriods')) ? $this->_run_mod_handler('translate', true, $_tmp, $this->_tpl_vars['periodsNames'][$this->_tpl_vars['period']]['plural']) : smarty_modifier_translate($_tmp, $this->_tpl_vars['periodsNames'][$this->_tpl_vars['period']]['plural'])); ?>
</h2>
<?php echo $this->_tpl_vars['graphEvolutionVisitsSummary']; ?>


<h2><?php echo ((is_array($_tmp='VisitsSummary_Report')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
</h2>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "VisitsSummary/templates/sparklines.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<br /><br /><br />
<p style='color:lightgrey; size:0.8em;'>
<?php echo ((is_array($_tmp='VisitsSummary_GenerateTime')) ? $this->_run_mod_handler('translate', true, $_tmp, $this->_tpl_vars['totalTimeGeneration'], $this->_tpl_vars['totalNumberOfQueries']) : smarty_modifier_translate($_tmp, $this->_tpl_vars['totalTimeGeneration'], $this->_tpl_vars['totalNumberOfQueries'])); ?>

<?php if ($this->_tpl_vars['totalNumberOfQueries'] != 0): ?>, <?php echo ((is_array($_tmp='VisitsSummary_GenerateQueries')) ? $this->_run_mod_handler('translate', true, $_tmp, $this->_tpl_vars['totalNumberOfQueries']) : smarty_modifier_translate($_tmp, $this->_tpl_vars['totalNumberOfQueries'])); ?>
<?php endif; ?>
</p>