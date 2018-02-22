<?php
$test=2.0;
if(round($test)==$test){
echo $test;
}else{
    echo round($test)."/".explode('.', number_format($test, 1))[1]; // 3
}
