<?php


require_once 'app/view/sluginator.php';

require_once 'app/controller/Request.php';   //подключение реквеста


$Request = new controller\Request();

$query = "set names utf8";
$DB->query($query);



$post = $Request->getPostParam();

$title = $post['title'];
$slug = sluginator($title);
$old_slug = $post['old_slug'];
$date = $post['date'];
$longitude = $post['longitude'];
$latitude = $post['latitude'];
$country = $post['country'];

$row = $DB->getCountryByName($country);
foreach ($row as $dow){
    $country_id = $dow['country_id'];
}




if (!empty($longitude)){                            //проверка на пустоту в широте
    $add_to_sql = ', latitude = '.(float)$latitude.', longitude = '.(float)$longitude;

}

$sql = "update conference set title = '".$title."',slug = '".$slug."', date = '".$date."'".$add_to_sql.", country_id = ".$country_id." where slug = '".$old_slug."'";              //конструктор sql-запроса


$DB->execute($sql);

?>
