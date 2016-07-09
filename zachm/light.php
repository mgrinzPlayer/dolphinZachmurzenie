<?php
 $zachmLocation = './light.php';
 $zachmLanguage = 'pl'; // domyślnie j.pol.
 require_once( 'prepareSat24Images.php' );

 echo <<<EOD
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Zachmurzenie - wersja light</title>
  </head>
  <body>
    $ustawienia
    <div>
    $sat24Images
    <br><a href='.'>Powrót</a>
    </div>
  </body>
</html>
EOD;

?>