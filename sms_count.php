<?php

$balance = file_get_contents("http://api.greenweb.com.bd/g_api.php?token=26a7280482e3d86e5ceb1ae5ffacd67d&balance");

$rate = file_get_contents("http://api.greenweb.com.bd/g_api.php?token=26a7280482e3d86e5ceb1ae5ffacd67d&rate");

$sms = round($balance / $rate);

echo $sms;

?>