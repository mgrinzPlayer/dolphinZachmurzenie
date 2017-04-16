<?php
 //$currentTime = time();
 //*
 $curl = curl_init();
 curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
 curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 5);
 curl_setopt($curl, CURLOPT_URL, "http://www.timeanddate.com/scripts/ts.php");
 $timeFromOtherSite = curl_exec($curl);
 curl_close($curl);

 if ($timeFromOtherSite) {
   preg_match('/([\.\w]*)\s/',$timeFromOtherSite,$currentTime);
   $currentTime = intval($currentTime[1]);
 }
 else {
   $currentTime = '{failed}';
 }

 print('<br>Time from timeanddate: ' . $currentTime);
 print('<br>Time from local server: ' . time());


?>