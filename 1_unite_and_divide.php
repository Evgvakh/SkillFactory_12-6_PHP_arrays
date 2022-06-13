<?php
//Разбиение и объединение ФИО


function getFullnameFromParts($surname, $name, $patronomyc)
{
    return $fullName = $surname." ".$name." ".$patronomyc;
}


function getPartsFromFullname($str) 
{    
    $nameArray = explode(' ', $str);
    $indexArray = ['surname', 'name', 'patronomyc'];
    return $uniteAray = array_combine($indexArray, $nameArray);
} 