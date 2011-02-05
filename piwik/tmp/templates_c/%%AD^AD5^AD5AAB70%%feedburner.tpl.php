<?php /* Smarty version 2.6.26, created on 2010-07-02 13:14:15
         compiled from /home/wbeat/public_html/piwik/plugins/ExampleFeedburner/templates/feedburner.tpl */ ?>

<script type="text/javascript">
	var idSite = <?php echo $this->_tpl_vars['idSite']; ?>
;
<?php echo '
	$(document).ready(function(){ 
	function getName()
	{
		return $("#feedburnerName").val();
	}
	$("#feedburnerSubmit").click( function(){
		var feedburnerName = getName();
		$.get(\'?module=ExampleFeedburner&action=saveFeedburnerName&idSite=\'+idSite+\'&name=\'+feedburnerName);
		piwik.dashboardObject.reloadEnclosingWidget($(this));
	});
});
</script>
<style>
.metric { font-weight:bold;text-align:left; }
.feedburner td { padding:0px 3px; } 
</style>
'; ?>


<?php if (! is_array ( $this->_tpl_vars['fbStats'] )): ?>
	<?php echo $this->_tpl_vars['fbStats']; ?>

<?php else: ?>
<table class='feedburner' align="center" cellpadding="2" style='text-align:center'>
	<tr>
		<td></td>
		<td style="text-decoration:underline;">Previous</td>
		<td style="text-decoration:underline;">Yesterday</td>
		<td></td>
	</tr>
	<tr>
		<td class='metric'>Circulation</td>
		<td><?php echo $this->_tpl_vars['fbStats'][0][0]; ?>
</td>
		<td><?php echo $this->_tpl_vars['fbStats'][0][1]; ?>
</td>
		<td><?php echo $this->_tpl_vars['fbStats'][0][2]; ?>
</td>
	</tr>
	<tr>
		<td class='metric'>Hits</td>
		<td><?php echo $this->_tpl_vars['fbStats'][1][0]; ?>
</td>
		<td><?php echo $this->_tpl_vars['fbStats'][1][1]; ?>
</td>
		<td><?php echo $this->_tpl_vars['fbStats'][1][2]; ?>
</td>
	</tr>
	<tr>
		<td class='metric'>Reach</td>
		<td><?php echo $this->_tpl_vars['fbStats'][2][0]; ?>
</td>
		<td><?php echo $this->_tpl_vars['fbStats'][2][1]; ?>
</td>
		<td><?php echo $this->_tpl_vars['fbStats'][2][2]; ?>
</td>
	</tr>
</table>
<?php endif; ?>

<center>
<input id="feedburnerName" type="text" value="<?php echo $this->_tpl_vars['feedburnerFeedName']; ?>
" />
<input id="feedburnerSubmit" type="submit" value="ok" />
</center>