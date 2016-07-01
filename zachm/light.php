<?php
 //przykładowy bezpośredni link do obrazka (czas w UTC)
 //http://pl.sat24.com/image?type=visual&region=pl&timestamp=201607011605

 $prefix = 'http://pl.sat24.com/image?type=visual&region=pl&timestamp=';
 $numberOfImages = 5;

 $currentTime = time();
 $currentTime = $currentTime - ( $currentTime % (5*60) ) - 5*60;

 // ostatnie $numberOfImages obrazków (co 15 minut)
 for ($i = 0; $i < $numberOfImages; $i++) {

   date_default_timezone_set('Europe/Warsaw');
   echo '<br>Stan z ' . date('Y-m-d H:i',$currentTime-$i*900) . ':</br>'. "\r\n";
   date_default_timezone_set('UTC');
   $datestring = date('YmdHi',$currentTime-$i*900);
   echo "<img src='" . $prefix . $datestring . "' alt='" . $datestring . "' align='middle'/>";
   echo '<p/>' . "\r\n";
 }

?>