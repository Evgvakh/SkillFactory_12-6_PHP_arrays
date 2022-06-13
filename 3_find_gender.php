<?php
//Функция определения пола по ФИО



//Функция создания массива из ФИО
function getPartsFromFullname($str) 
{    
    $nameArray = explode(' ', $str);
    $indexArray = ['surname', 'name', 'patronomyc'];
    return $uniteAray = array_combine($indexArray, $nameArray);
};

// Функция определения пола
function getGenderFromName ($str) 
{
    $name = getPartsFromFullname($str);
    $genderCounter = 0;
    $gender="";

    //Определения значение счетчика
    if (mb_substr($name['patronomyc'], -3, 3) == 'вна')
    {
        $genderCounter -= 1;
    }

    if (mb_substr($name['name'], -1, 1) == 'а') 
    {
        $genderCounter -= 1;
    }

    if (mb_substr($name['surname'], -2, 2) == 'ва') 
    {    
        $genderCounter -= 1;
    }

    if (mb_substr($name['patronomyc'], -2, 2) == 'ич') 
    {
        $genderCounter += 1;
    }

    if (mb_substr($name['name'], -1, 1) === ('й'||'н')) 
    {
        $genderCounter += 1;        
    }

    if (mb_substr($name['surname'], -1, 1) == 'в') 
    {
        $genderCounter += 1;
    }
    
    // Вывод пола на печать
    if ($genderCounter > 0)
    {
        $gender = "Мужской пол";
        echo $gender;
        //return "Мужской пол";
    } else if ($genderCounter == 0)
    {
        $gender = "Неопределенный пол";
        echo $gender;
        //return "Неопределенный пол";
    } else
    {
        $gender = "Женский пол";
        echo $gender;
        //return "Женский пол";
    };       
}

