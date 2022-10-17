<?php

require_once 'app/view/sluginator.php';

$query = "set names utf8";
$DB->query($query);



$post = $Request->getPostParam();

$title = $post['title'];
$slug = sluginator($title);
$date = $post['date'];
$longitude = $post['longitude'];
$latitude = $post['latitude'];
$country = $post['country'];

$row = $DB->getCountryByName($country);
foreach ($row as $dow){
    $country_id = $dow['country_id'];
}



$add_to_sql = '';
$val = '';
if (!empty($longitude)){                            //проверка на пустоту в широте
    $add_to_sql = $add_to_sql .'longitude,';
    $val = $val.$longitude.',';
}
if (!empty($latitude)){                             //проверка на пустоту в долготе
    $add_to_sql = $add_to_sql . 'latitude,';
    $val = $val.$latitude.',';
}
$sql = "insert into conference (title, slug, date,".$add_to_sql."country_id)
values ('$title', '$slug', '$date',".$val."$country_id)";              //конструктор sql-запроса


$DB->execute($sql);

?>

