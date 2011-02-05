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

/**
 * Here is a dpm of a classified row:
 * *
  id (String, 3 characters ) 510
*
  feeds_data_classifieds_import_feed_nid (String, 3 characters ) 180
*
  feeds_data_classifieds_import_timestamp (String, 10 characters ) 1273438955
*
  feeds_data_classifieds_import_guid (String, 53 characters ) http://westernmass.craigslist.org/mcy/173242025...
      o
        http://westernmass.craigslist.org/mcy/1732420256.html
*
  feeds_data_classifieds_import_url (String, 53 characters ) http://westernmass.craigslist.org/mcy/173242025...
      o
        http://westernmass.craigslist.org/mcy/1732420256.html
*
  feeds_data_classifieds_import_title (String, 59 characters ) 2002 Honda XR200R...GREAT TEEN BIKE (Williamsto...
      o
        2002 Honda XR200R...GREAT TEEN BIKE (Williamstown MA) $1250
*
  feeds_data_classifieds_import_description (String, 798 characters ) For sale or trade is an XR200R 2002. Bike is i...
      o
        For sale or trade is an XR200R 2002. Bike is in good condition, i have outgrown it and moved on to a bigger bike. the bike is valued by KBB at 1350, i am asking 1250 obo...if you would like to negotiate price that is fine. I am also interested in Trades for quad (4x4 or sport), jeep, or landscaping trailer and equiptment. <br> <br> The bike is excellent for teens(what i used it for), or experienced female riders, or shorter males...i am 6'2" and am just a little tall for it to be comfortable, the bike is great and any questions id be happy to talk about <br> <br> call or text any time however i work untill around 4...may be able to talk during work but no promises. 413-441-0317 <br> <br> Bike has new brakes too!...ridden maybe 5 hours since i changed them works great <br> <br>
*
  feeds_data_classifieds_import_timestamp_day (String, 8 characters ) 20100509


 */

//  $output = htmlspecialchars_decode($output);
  $output = strip_tags(htmlspecialchars_decode($output),'<a>'); 
//  dpm($output);
//  print strip_tags($output);    
//  print strip_tags($output,'<a>');    
  print $output;  