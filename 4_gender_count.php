<?php
//Определение возрастно-полового состава


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

//Определяем гендерный состав в процентах
function getGenderDescription ($arr) 
{
    //Формируем массив с гендерными значениями
    foreach ($arr as $key => &$value) {
    $value = getGenderFromName ($arr[$key]['fullname']);
    };
    
    //Разбиваем на массивы по гендерным значениям
    $men = array_filter($arr, function($number) {
    return $number == 'Мужской пол';});

	$women = array_filter($arr, function($number) {
    return $number == 'Женский пол';});

	$other = array_filter($arr, function($number) {
    return $number == 'Неопределенный пол';});

    //Считаем процент по гендерному признаку
	$menPercent = round(count($men) / count($arr) * 100, 1);
	$womenPercent = round(count($women) / count($arr) * 100, 1);
	$otherPercent = round(count($other) / count($arr) * 100, 1);
	
    //Вывод результатов
	echo "Гендерный состав аудитории:
---------------------------
Мужчины - $menPercent%
Женщины - $womenPercent%
Не удалось определить - $otherPercent%;";
}
