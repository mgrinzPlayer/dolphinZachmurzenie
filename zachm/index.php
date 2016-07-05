<?php
 require_once( '../inc/header.inc.php' );
 require_once( BX_DIRECTORY_PATH_INC . 'design.inc.php' );
 require_once( BX_DIRECTORY_PATH_INC . 'profiles.inc.php' );
 $zachmLocation = './zachm';
 require_once( 'prepareSat24Images.php' );

 $_page['header'] = "Zachmurzenie";
 $_page['header_text'] =  "Aktualne zachmurzenie nad Polską";
 $_ni = $_page['name_index'];

 $customCode  = $ustawienia; // ustawienia
 $customCode .= "<div class='bx-def-bh-margin'>"; // dodaj marginesy
 $customCode .= $sat24Images;
 $customCode .= "<br><a href='./zachm/light.php'>Wersja light</a>"; // link do wersji light
 $customCode .= "</div>";

 $_page_cont[$_ni]['page_main_code'] = $customCode;

 PageCode();
?>