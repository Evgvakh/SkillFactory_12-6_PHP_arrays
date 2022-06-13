<?php
//Идеальный подбор пары


$example_persons_array = [
    [
        'fullname' => 'Иванов Иван Иванович',
        'job' => 'tester',
    ],
    [
        'fullname' => 'Степанова Наталья Степановна',
        'job' => 'frontend-developer',
    ],
    [
        'fullname' => 'Пащенко Владимир Александрович',
        'job' => 'analyst',
    ],
    [
        'fullname' => 'Громов Александр Иванович',
        'job' => 'fullstack-developer',
    ],
    [
        'fullname' => 'Славин Семён Сергеевич',
        'job' => 'analyst',
    ],
    [
        'fullname' => 'Цой Владимир Антонович',
        'job' => 'frontend-developer',
    ],
    [
        'fullname' => 'Быстрая Юлия Сергеевна',
        'job' => 'PR-manager',
    ],
    [
        'fullname' => 'Шматко Антонина Сергеевна',
        'job' => 'HR-manager',
    ],
    [
        'fullname' => 'аль-Хорезми Мухаммад ибн-Муса',
        'job' => 'analyst',
    ],
    [
        'fullname' => 'Бардо Жаклин Фёдоровна',
        'job' => 'android-developer',
    ],
    [
        'fullname' => 'Шварцнегер Арнольд Густавович',
        'job' => 'babysitter',
    ],
];
//
function getFullnameFromParts($surname, $name, $patronomyc)
{
    return $fullName = $surname." ".$name." ".$patronomyc;
};
//Функция создания массива из ФИО
function getPartsFromFullname($str) 
{    
    $nameArray = explode(' ', $str);
    $indexArray = ['surname', 'name', 'patronomyc'];
    return $uniteAray = array_combine($indexArray, $nameArray);
};

function getShortName($str) 
{    
    $nameArray = explode(' ', $str);
    $indexArray = ['surname', 'name', 'patronomyc'];
    $uniteAray = array_combine($indexArray, $nameArray);
    return $shortenedName = $uniteAray['name']." ".mb_substr($uniteAray['patronomyc'], 0, 1).".";
} 

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
        //$gender = "Мужской пол";
        //echo $gender;
        return "Мужской пол";
    } else if ($genderCounter == 0)
    {
        //$gender = "Неопределенный пол";
        //echo $gender;
        return "Неопределенный пол";
    } else
    {
        //$gender = "Женский пол";
        //echo $gender;
        return "Женский пол";
    };       
}
//Функция подбора партнера
function getPerfectPartner ($surname, $name, $patronomyc, $arr) 
{
    //Генерация первого пратнера
    $partner1 = mb_convert_case(getFullnameFromParts($surname, $name, $patronomyc), MB_CASE_TITLE_SIMPLE);
	$partner1gender = getGenderFromName($partner1);
	$partner1short = getShortName($partner1);
	//Генерация второго партнера
	$randomPartner = array_rand($arr, 1);
	$partner2 = $arr[$randomPartner]['fullname'];
	$partner2gender = getGenderFromName ($partner2);
	$partner2short = getShortName($partner2);
	//Проверка совместимости
    if ($partner1gender === $partner2gender) {
    echo "Партнеры несовместимы";} else {
    $randomPercent = rand(5000, 10000)/100;
	echo "$partner1short + $partner2short = 
♡ Идеально на $randomPercent% ♡";}
};

/*Вопрос для ментора: возможно ли сделать точно так как указано в задании: "проверяем с помощью getGenderFromName,
что выбранное из Массива ФИО - противоположного пола, если нет, то возвращаемся к шагу 4, если да - возвращаем информацию."?
Подскажите, пожалуйста, в комментарии после проверки задания как это можно реализовать
Спасибо!!!*/

