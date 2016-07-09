<?php
 require_once( '../inc/header.inc.php' );
 require_once( BX_DIRECTORY_PATH_INC . 'design.inc.php' );
 require_once( BX_DIRECTORY_PATH_INC . 'profiles.inc.php' );

 $zachmLanguage = getCurrentLangName(); // język ustawiony przez portalowicza
 if ($zachmLanguage == 'pl') {
   $_page['header'] = "Zachmurzenie";
   $_page['header_text'] = "Aktualne zachmurzenie nad Polską";
   $zachmLinkText = 'Wersja light';
 } else {
   $_page['header'] = "Clouds";
   $_page['header_text'] = "Actual clouds in Poland";
   $zachmLinkText = 'Light version';
 }

 $_ni = $_page['name_index'];

 $zachmLocation = './zachm';
 require_once( 'prepareSat24Images.php' );

 $customCode  = $ustawienia; // ustawienia
 $customCode .= "<div class='bx-def-bh-margin'>"; // dodaj marginesy
 $customCode .= $sat24Images;
 $customCode .= "<br><a href='./zachm/light.php?zachmlang=" . $zachmLanguage . "'>" . $zachmLinkText . "</a>"; // link do wersji light
 $customCode .= "</div>";

 $_page_cont[$_ni]['page_main_code'] = $customCode;

 PageCode();
?>