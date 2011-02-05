<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML+RDFa 1.0//EN" "http://www.w3.org/MarkUp/DTD/xhtml-rdfa-1.dtd">
<html 
     xmlns="http://www.w3.org/1999/xhtml" 
     xmlns:dc="http://purl.org/dc/elements/1.1/" 
     xmlns:ctag="http://commontag.org/ns#" 
     lang="en" 
     dir="ltr"
     version="XHTML+RDFa 1.0" >

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title><?php print t("Ancient Browser Detected"); ?></title>
  <link type="text/css" rel="stylesheet" media="all" href="<?php print $blockie_module_path; ?>/block_ie6.css" />
</head>

<body>

<div align="center">
  <div id="message">
  <?php print t("It seems like you are using an archaic version of Internet Explorer. Web community 
  is increasingly ceasing support for this browser due to its many flaws and incompatability
  with the modern Web standards."); ?> 
  
  <p><?php print t("This website does not support the outdated version of the Internet Explorer."); ?>
  
  <p><?php print t("Please download:"); ?>
  <ul>
    <li><a href="http://www.apple.com/safari/download/"><?php print t("Apple Safari"); ?></a></li>
    <li><a href="http://www.google.com/chrome"><?php print t("Google's Chrome"); ?></a></li>
    <li><a href="http://firefox.com"><?php print t("Mozzila Firefox"); ?></a></li>
    <li><a href="http://www.opera.com/"><?php print t("Opera"); ?></a></li>
    <li><?php print t("or a newer version of "); ?><a href="http://www.microsoft.com/windows/internet-explorer/default.aspx"><?php print t("Internet Explorer"); ?></a></li>
  </ul>
  
  <?php print t("We apologize for the inconvenience."); ?>
  </div>

</div>


</body>
</html>
