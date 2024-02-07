<?php

$siteBasligi = "Harmony Otel";
$favicon = "img/icon.png";

function ikon(){
	global $favicon;
	$ikon = '<link rel="icon" href="'.$favicon.'" type="image/x-icon">';
	
	echo $ikon;	
}

?>