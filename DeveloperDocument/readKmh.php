<?php
$lastkmh=0;
$Apostash=0;
$currentkmh=0;
$count=0;
$myarray=[12,18,22,29,32,36,38];

foreach($myarray as $value){
$count++;
$lastkmh=$currentkmh;
$currentkmh=$value;
$Apostash=$currentkmh-$lastkmh;
if($count>1){
print ($Apostash.'<br>');
}
}
?>