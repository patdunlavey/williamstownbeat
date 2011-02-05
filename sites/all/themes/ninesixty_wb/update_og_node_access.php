<?php
// first set og_access_post
$og_public = $node->og_private ? 0 : 1;
$sql = "update {og_access_post} ap left join {og_ancestry} an on (ap.nid = an.nid) set ap.og_public = %s WHERE an.`group_nid` = %s ";
db_query($sql, array($og_public, $node->nid));
//dpm($sql);


  // get the nodes and update their grants, this applies the og_public setting
$sql = "select an.nid as nid from {og_access_post} ap left join {og_ancestry} an on (ap.nid = an.nid) WHERE an.`group_nid` = %s ";      
$result = db_query($sql,array($node->nid));
while ($node = db_fetch_object($result)) {
  $loaded_node = node_load($node->nid, NULL, TRUE);
  // To preserve database integrity, only aquire grants if the node
  // loads successfully.
  if (!empty($loaded_node)) {
    node_access_acquire_grants($loaded_node);
  }
}
