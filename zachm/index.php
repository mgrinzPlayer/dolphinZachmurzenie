<?php
 //przykładowy bezpośredni link do obrazka (czas w UTC)
 //http://pl.sat24.com/image?type=visual&region=pl&timestamp=201607011605

 require_once( '../inc/header.inc.php' );
 require_once( BX_DIRECTORY_PATH_INC . 'design.inc.php' );
 require_once( BX_DIRECTORY_PATH_INC . 'profiles.inc.php' );

 $_page['header'] = "Zachmurzenie";
 $_page['header_text'] =  "Aktualne zachmurzenie nad Polską";
 $_ni = $_page['name_index'];


 $prefix = 'http://pl.sat24.com/image?type=visual&region=pl&timestamp=';
 $numberOfImages = 5;

 $currentTime = time();
 $currentTime = $currentTime - ( $currentTime % (5*60) ) - 5*60;

 $customCode = "<div class='bx-def-bh-margin'>"; // domyślne marginesy

 // ostatnie $numberOfImages obrazków (co 15 minut)
 for ($i = 0; $i < $numberOfImages; $i++) {
   date_default_timezone_set('Europe/Warsaw');
   $customCode .= '<br>Stan z ' . date('Y-m-d H:i',$currentTime-$i*900) . ':</br>'. "\r\n";
   date_default_timezone_set('UTC');
   $datestring = date('YmdHi',$currentTime-$i*900);
   $customCode .= "<img src='" . $prefix . $datestring . "' alt='" . $datestring . "' align='middle'/>";
   $customCode .= '<p/>' . "\r\n";
 }

 $customCode .= "<br/><br/> <a href='./zachm/light.php'>Wersja light</a>"; // link do wersji light
 $customCode .= "</div>";


 $_page_cont[$_ni]['page_main_code'] = $customCode;
 PageCode();

?>