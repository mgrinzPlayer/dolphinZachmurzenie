<?php
 //przykładowy bezpośredni link do obrazka (czas w UTC)
 //http://pl.sat24.com/image?type=visual&region=pl&timestamp=201607011605
 //http://pl.sat24.com/image/zoom?type=visual&region=EU&x=1950&y=880&timestamp=201607041410 półn.-zach
 //http://pl.sat24.com/image/zoom?type=visual&region=EU&x=2280&y=880&timestamp=201607041410 półn.-wsch
 //http://pl.sat24.com/image/zoom?type=visual&region=EU&x=1950&y=1140&timestamp=201607041410 połudn.-zach
 //http://pl.sat24.com/image/zoom?type=visual&region=EU&x=2280&y=1140&timestamp=201607041410 połudn.-wsch

 $numberOfImages = 5;

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
   $currentTime = time(); // fall-back
 }
 //*/

 $currentTime = $currentTime - ( $currentTime % (5*60) ) - 5*60;


 $interval = ( isset($_GET['interval']) ) ? (int) $_GET['interval'] : 3;
 if ( $interval <= 0 ) { $interval = 3;}

 $optionsInterval = "<option value='3'>…</option>";
 for ($i = 1; $i <= 6; $i++) {
   $optionsInterval .= "<option value='" . $i . "'" . ( $interval==$i ? " selected='selected'" : "" ) . ">" .
                  $i*5 . "</option>\r\n";
 }


 $region = ( isset($_GET['region']) ) ? (int) $_GET['region'] : 0;
 if ( $region < 0 ) { $region = 0;}

 $regions = array('Cała Polska','Półn.-Zach.','Półn.-Wsch.',
                  'Połudn.-Zach.','Połudn.-Wsch.','Centrum');


 $optionsRegion = '';
 foreach ($regions as $key => $value) {
   $optionsRegion .= "<option value='" . $key . "'" . ( $region==$key ? " selected='selected'" : "" ) . ">" .
                  $value . "</option>\r\n";
 }


 $regionsZoomOffsets = array('','x=1950&y=880','x=2280&y=880','x=1950&y=1140','x=2280&y=1140','x=2115&y=1010');
 if ($region == 0 ) {
   $prefix = 'http://pl.sat24.com/image?type=visual&region=pl&timestamp=';
 }
 else {
   $prefix = 'http://pl.sat24.com/image/zoom?type=visual&region=EU&' . $regionsZoomOffsets[$region] . '&timestamp=';
 }




 // ostatnie $numberOfImages obrazków
 $sat24Images = '<p>Zachmurzenie co: ' . $interval*5 . ' minut</p>';
 for ($i = 0; $i < $numberOfImages; $i++) {
   date_default_timezone_set('Europe/Warsaw');
   $sat24Images .= "<p>Stan z " . date('Y-m-d H:i',$currentTime-$i*$interval*5*60) . ":<br>\r\n";
   date_default_timezone_set('UTC');
   $datestring = date('YmdHi',$currentTime-$i*$interval*5*60);
   $sat24Images .= "<img src='" . $prefix . $datestring . "' alt='" . $datestring . "'/>";
   $sat24Images .= "</p>\r\n";
 }

 $ustawienia = <<<EOD
<div style="width:100%;color:#666;">
  <div style="margin:10px 20px 0px 20px;">
    <div style="float:left">
      <div style="display:inline-block;vertical-align:middle">
        <div style="position:relative;
                    display:inline-block;
                    float:none;
                    vertical-align:middle;
                    height:38px;
                    padding:0px;
                    border:none;
                    background-color:transparent">
          <span style="line-height:38px;">Region:</span>&nbsp;
          <select style="vertical-align:middle;height:38px;border-radius:6px;"
            onchange="window.location='$zachmLocation?region=' + this.value + '&amp;interval=$interval'">
            $optionsRegion
          </select>
        </div>
      </div>
    </div>

    <div style="float:right;">
      <div style="display:inline-block;vertical-align:middle">
        <div style="position:relative;
                    display:inline-block;
                    float:none;
                    vertical-align:middle;
                    height:38px;
                    padding:0px;
                    border:none;
                    background-color:transparent">
          <span style="line-height:38px;">Odstęp w minutach:</span>
          <select style="vertical-align:middle;height:38px;border-radius:6px;"
            onchange="window.location='$zachmLocation?region=$region&amp;interval=' + this.value">
            $optionsInterval
          </select>
        </div>
      </div>
    </div>
  </div>
</div>
<br>
<br>
<br>
EOD;

?>