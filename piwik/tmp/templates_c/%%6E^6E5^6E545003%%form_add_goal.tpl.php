<?php /* Smarty version 2.6.26, created on 2010-07-19 00:02:57
         compiled from Goals/templates/form_add_goal.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'translate', 'Goals/templates/form_add_goal.tpl', 6, false),array('modifier', 'money', 'Goals/templates/form_add_goal.tpl', 57, false),)), $this); ?>
<span id='GoalForm' style="display:none;">
<form>
<table class="tableForm tableFormGoals">
	<tbody>
		<tr>
            <td><?php echo ((is_array($_tmp='Goals_GoalName')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
 </td>
			<td><input type="text" name="name" value="" id="goal_name" /></td>
		</tr>
		<tr>
			<td style='width:240px;'><?php echo ((is_array($_tmp='Goals_GoalIsTriggered')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>

				<select name="trigger_type">
					<option value="visitors"><?php echo ((is_array($_tmp='Goals_WhenVisitors')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
</option>
					<option value="manually"><?php echo ((is_array($_tmp='Goals_Manually')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
</option>
				</select>
			</td>
			<td>
				<input type="radio" id="match_attribute_url" value="url" name="match_attribute" />
                <label for="match_attribute_url"><?php echo ((is_array($_tmp='Goals_VisitUrl')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
</label>
				<br />
				<input type="radio" id="match_attribute_file" value="file" name="match_attribute" />
				<label for="match_attribute_file"><?php echo ((is_array($_tmp='Goals_Download')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
</label>
				<br />
				<input type="radio" id="match_attribute_external_website" value="external_website" name="match_attribute" />
				<label for="match_attribute_external_website"><?php echo ((is_array($_tmp='Goals_ClickOutlink')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
</label>
			</td>
			</tr>
	</tbody>
	<tbody id="match_attribute_section">
		<tr>
			<td><?php echo ((is_array($_tmp='Goals_WhereThe')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
 <span id="match_attribute_name"></span></td>
			<td>
				<select name="pattern_type">
                    <option value="contains"><?php echo ((is_array($_tmp='Goals_Contains')) ? $this->_run_mod_handler('translate', true, $_tmp, "") : smarty_modifier_translate($_tmp, "")); ?>
</option>
                    <option value="exact"><?php echo ((is_array($_tmp='Goals_IsExactly')) ? $this->_run_mod_handler('translate', true, $_tmp, "") : smarty_modifier_translate($_tmp, "")); ?>
</option>
                    <option value="regex"><?php echo ((is_array($_tmp='Goals_MatchesExpression')) ? $this->_run_mod_handler('translate', true, $_tmp, "") : smarty_modifier_translate($_tmp, "")); ?>
</option>
				</select>
			
				<input type="text" name="pattern" value="" />
				<br />
				<div id="examples_pattern" class="goalInlineHelp"></div>
				<br />
				<span style="float:right">
				<?php echo ((is_array($_tmp='Goals_Optional')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
 <input type="checkbox" id="case_sensitive" />
                <label for="case_sensitive"><?php echo ((is_array($_tmp='Goals_CaseSensitive')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
</label>
				</span>
			</td>
		</tr>
	</tbody>
	<tbody id="manual_trigger_section" style="display:none">
		<tr><td colspan="2">
				<?php echo ((is_array($_tmp='Goals_WhereVisitedPageManuallyCallsJavascriptTrackerLearnMore')) ? $this->_run_mod_handler('translate', true, $_tmp, "<a target='_blank' href='misc/redirectToUrl.php?url=http://piwik.org/docs/javascript-tracking/'>", "</a>") : smarty_modifier_translate($_tmp, "<a target='_blank' href='misc/redirectToUrl.php?url=http://piwik.org/docs/javascript-tracking/'>", "</a>")); ?>

		</td></tr>
	</tbody>
	<tbody>
		<tr>
            <td>(optional) <?php echo ((is_array($_tmp='Goals_DefaultRevenue')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
</td>
			<td><?php echo ((is_array($_tmp='<input type="text" name="revenue" size="1" value="0" />')) ? $this->_run_mod_handler('money', true, $_tmp, $this->_tpl_vars['idSite']) : smarty_modifier_money($_tmp, $this->_tpl_vars['idSite'])); ?>

            <div class="goalInlineHelp"> <?php echo ((is_array($_tmp='Goals_DefaultRevenueHelp')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
 </div>
			</td>
		</tr>
		<tr>
		<tr>
			<td colspan="2" style="border:0">
				<input type="hidden" name="methodGoalAPI" value="" />	
				<input type="hidden" name="goalIdUpdate" value="" />
				<center>
	            <input type="submit" value="" name="submit" id="goal_submit" class="submit" />
	            </center>
			</td>
		</tr>
	</tbody>
</table>
</form>
</span>