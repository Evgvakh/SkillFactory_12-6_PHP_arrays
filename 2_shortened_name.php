<?php
//Сокращение ФИО


function getShortName($str) 
{    
    $nameArray = explode(' ', $str);
    $indexArray = ['surname', 'name', 'patronomyc'];
    $uniteAray = array_combine($indexArray, $nameArray);
    return $shortenedName = $uniteAray['name']." ".mb_substr($uniteAray['patronomyc'], 0, 1).".";
} 


