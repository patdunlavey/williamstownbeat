<?php
// $Id: views-view-field.tpl.php,v 1.1 2008/05/16 22:22:32 merlinofchaos Exp $
 /**
  * This template is used to print a single field in a view. It is not
  * actually used in default Views, as this is registered as a theme
  * function which has better performance. For single overrides, the
  * template is perfectly okay.
  *
  * Variables available:
  * - $view: The view object
  * - $field: The field handler object that can process the input
  * - $row: The raw SQL result that can be used
  * - $output: The processed output that will normally be used.
  *
  * When fetching output from the $row, this construct should be used:
  * $data = $row->{$field->field_alias}
  *
  * The above will guarantee that you'll always get the correct data,
  * regardless of any changes in the aliasing that might happen if
  * the view is modified.
  */
?>
<?php 
$groups = og_get_node_groups(node_load($row->nid));
if(isset($groups)){
  print '<div class="views-field-field-channel-bullets">';
  $count=0;
  
  
foreach($groups as $gid => $group_title) {
$fid = db_result(db_query('select field_channel_bullet_fid from {content_type_channel} where nid = %d',$gid));
if($fid) {
$filepath = "/sites/default/files/channel/".$gid."/bullet/";
$filepath .= db_result(db_query('select filename from {files} where fid = %d',$fid));
$output = '<div class = "views-field-field-channel-bullet-fid ';
$output .= $count++ == 0 ? 'first-bullet': '' ;
$output .= '"><a href="/node/'.$gid.'" title="'.$group_title.'">';
$output .= theme('imagecache', '16x16', $filepath, '', '', '');
$output .= '</a>';
$output .= '</div>';
print($output); 
}
}
  print '</div>';
}


?>