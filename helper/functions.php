<?php

function strRandom(){
    $str_random = '';
    $str = '1234567890QWERTYUIOPASDFGHJKZXCVBNMqwertyuiopasdfghjklzxcvbnm';
    for($i = 1; $i<=50; $i++){
        // $start = rand(0,strlen($str)-1);
        // $str_random .= substr($str,$start,1);
        $rand =  rand(0,strlen($str)-1);
        $str_random .= $str[$rand];
    }
    return $str_random;
}

?>



