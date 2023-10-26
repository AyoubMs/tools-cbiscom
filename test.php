<?php
  $thisIp = $_SERVER['REMOTE_ADDR'];
  $pieces = explode("", $thisIp);
  echo $thisIp;

  if($thisIp != '196.206.228.238'  && $thisIp != '62.251.255.14'&& $thisIp != '41.137.41.170'&& $thisIp != '196.92.1.151'&& $thisIp != '41.137.41.234'){
	echo "adresse IP restreinte";
  }
