<?php /* Smarty version 2.6.26, created on 2010-07-02 13:14:14
         compiled from /home/wbeat/public_html/piwik/plugins/Feedback/templates/index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'translate', '/home/wbeat/public_html/piwik/plugins/Feedback/templates/index.tpl', 29, false),)), $this); ?>
<?php echo '
<script type="text/javascript">
$(function() {
	$(\'#feedback-contact\').click(function() {
		$(\'#feedback-faq\').hide();
		$(\'#feedback-form\').show();
		return false;
	});

	$(\'#feedback-home\').click(function() {
		$(\'#feedback-form\').hide();
		$(\'#feedback-faq\').show();
		return false;
	});

	$(\'#feedback-form-submit\').click(function() {
		var feedback = $(\'#feedback-form form\');
		$(\'#feedback-form\').hide();
		$.post(feedback.attr(\'action\'), feedback.serialize(), function (data) {
			$(\'#feedback-sent\').show().html(data);
		});
		return false;
	});
});
</script>
'; ?>


  <div id="feedback-faq">
    <p><strong><?php echo ((is_array($_tmp='Feedback_DoYouHaveBugReportOrFeatureRequest')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
</strong></p>
    <p>» <?php echo ((is_array($_tmp='Feedback_ViewAnswersToFAQ')) ? $this->_run_mod_handler('translate', true, $_tmp, "<a target='_blank' href='misc/redirectToUrl.php?url=http://piwik.org/faq/'>", "</a>") : smarty_modifier_translate($_tmp, "<a target='_blank' href='misc/redirectToUrl.php?url=http://piwik.org/faq/'>", "</a>")); ?>
.</p>
    <ul>
      <li><?php echo ((is_array($_tmp='Feedback_WhyAreMyVisitsNoTracked')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
</li>
      <li><?php echo ((is_array($_tmp='Feedback_HowToExclude')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
</li>
      <li><?php echo ((is_array($_tmp='Feedback_WhyWrongCountry')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
</li>
      <li><?php echo ((is_array($_tmp='Feedback_HowToAnonymizeIP')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
</li>
    </ul>
    <p>» <?php echo ((is_array($_tmp='Feedback_VisitTheForums')) ? $this->_run_mod_handler('translate', true, $_tmp, "<a target='_blank' href='misc/redirectToUrl.php?url=http://forum.piwik.org/'>", "</a>") : smarty_modifier_translate($_tmp, "<a target='_blank' href='misc/redirectToUrl.php?url=http://forum.piwik.org/'>", "</a>")); ?>
.</p>
    <p>» <?php echo ((is_array($_tmp='Feedback_LearnWaysToParticipate')) ? $this->_run_mod_handler('translate', true, $_tmp, "<a target='_blank' href='misc/redirectToUrl.php?url=http://piwik.org/contribute/'>", "</a>") : smarty_modifier_translate($_tmp, "<a target='_blank' href='misc/redirectToUrl.php?url=http://piwik.org/contribute/'>", "</a>")); ?>
.</p>
    <br />
    <p><strong><?php echo ((is_array($_tmp='Feedback_SpecialRequest')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
</strong></p>
    <p>»  <a target='_blank' href="#" id="feedback-contact"><?php echo ((is_array($_tmp='Feedback_ContactThePiwikTeam')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
</a></p>
  </div>
  <div id="feedback-form" style="display:none;">
    <form method="post" action="index.php?module=Feedback&action=sendFeedback">
      <p><strong><?php echo ((is_array($_tmp='Feedback_IWantTo')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
</strong>
        <select name="category">
          <option value="share"><?php echo ((is_array($_tmp='Feedback_CategoryShareStory')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
</option>
          <option value="sponsor"><?php echo ((is_array($_tmp='Feedback_CategorySponsor')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
</option>
          <option value="hire"><?php echo ((is_array($_tmp='Feedback_CategoryHire')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
</option>
          <option value="security"><?php echo ((is_array($_tmp='Feedback_CategorySecurity')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
</option>
        </select>
      </p>
      <p><strong><?php echo ((is_array($_tmp='Feedback_MyEmailAddress')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
</strong><br />
        <input type="text" name="email" size="59" />
        <input type="hidden" name="nonce" value="<?php echo $this->_tpl_vars['nonce']; ?>
" /></p>
      <p><strong><?php echo ((is_array($_tmp='Feedback_MyMessage')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
</strong> <?php echo ((is_array($_tmp='Feedback_DetailsPlease')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
<br />
        <textarea name="body" cols="57" rows="10"></textarea></p>
      <p><input id="feedback-form-submit" type="submit" value="<?php echo ((is_array($_tmp='Feedback_SendFeedback')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
" /></p>
      <p><a href="#" id="feedback-home"><img src="plugins/Feedback/images/go-previous.png" border="0" title="<?php echo ((is_array($_tmp='General_Previous')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
" alt="[<?php echo ((is_array($_tmp='General_Previous')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
]" /></a></p>
    </form>
  </div>
  <div id="feedback-sent" style="display:none;">
  </div>