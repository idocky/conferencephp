<?php
require_once 'header.php';


require_once 'app/model/Database.php';       //подключение бд

$DB = new model\Database();

//$conf = $DB->getConferences();

require_once 'app/controller/Request.php';   //подключение реквеста

$Request = new controller\Request();



$conference = $DB->getConfBySlug(explode('/', $Request->getPath())[1]);

foreach ($conference as $conf){
    $title = $conf['title'];
    $date = $conf['date'];
    $slug = $conf['slug'];
    $latitude = ''; $longitude = '';
    if ($conf['longitude']){
        $longitude = $conf['longitude'];
    }
    if ($conf['latitude']){
        $latitude = $conf['latitude'];
    }
    $country = $DB->getCountryByID($conf['country_id']);

}

?>

<div class="container">
    <h1><?php echo $title; ?></h1>
    <h5><?php echo date("d.m.Y", strtotime($date)); ?></h5>
    <h3><?php print_r($country[0]['name_country']); ?></h3>
    <?php
        if ($longitude and $latitude){
            echo '<div id = map></div>';
        }
      ?>
    <br/>
    <form action="/" method="post">
        <input name="<?php echo $slug ?>" class="btn btn-danger" tabindex="-1"type="submit" value="Удалить" />

    </form><br/>
    <a href="/edit/<?php echo $slug  ?>" class="btn btn-primary" tabindex="-1" role="button" aria-disabled="true">Редактировать</a>
    <div class="forData" lng-attr="<?=$longitude ?>" lat-attr="<?=$latitude ?>"></div>

</div>
<script src="../src/disabledMap.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDJNJv5qPmlb7rwvToGcE-njYYySbCJyts&callback=initMap" async defer></script>

<?php require_once 'footer.php'; ?>
