<?php 
$array = array(3,5,9,10,'k',99,173,"e");
foreach ($array as $number){
  if (is_numeric($number)) {
echo("$number is a number". "<br>");
  }
}