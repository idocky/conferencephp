<?php
require_once 'header.php';

require_once "app/view/sluginator.php";


require_once 'app/model/Database.php';       //подключение бд

$DB = new model\Database();

require_once 'app/controller/Request.php';   //подключение реквеста

$Request = new controller\Request();

if($_POST){
    require_once './app/controller/update.php';

}


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
    $name_country = $DB->getCountryByID($conf['country_id']);
}

?>
    <div class="forData" lng-attr="<?=$longitude ?>" lat-attr="<?=$latitude ?>"></div>
    <div class="container">
        <form action="/edit/<?php echo $slug ?>" method="post">
            <div class="form-group">
                <label>Название конференции:</label>
                <input type="text" class="form-control" name="title" value="<?php echo $title ?>">
                <small id="emailHelp" class="form-text text-muted">От 2 до 255 символов</small>
            </div>
            <div class="form-group date ">
                <label class="form-check-label" for="exampleCheck1">Дата конференции</label><br/>
                <input type="date"  name="date" id="davaToday" formmethod="post" value="<?php echo date("Y-m-d", strtotime($date)); ?>">
            </div>


            <div id="formap">
                <div id="map"></div>
            </div>
            <br/>
            <select class="form-control" size="0" name="country">
                <?php
                $res = $DB->getCountries();


                foreach ($res as $country){

                    if ($country['name_country'] == $name_country[0]['name_country']){
                        echo "<option selected>".$country['name_country']."</option>";
                    }
                    else{
                        echo "<option>".$country['name_country']."</option>";
                    }

                }

                ?>

            </select>
            <br/>
            <div id="latLng">
                <input type="hidden" id="latitude" name="latitude" v-bind:value="latitude" />
                <input type="hidden" id="longitude" name="longitude" v-bind:value="longitude" />
                <input type="hidden" id="old_slug" name="old_slug" value="<?php echo $slug ?>" />
            </div>

            <a href="/" class="btn btn-primary" tabindex="-1" role="button" aria-disabled="true">Назад</a>

            <input type="submit" value="Сохранить" class="btn btn-primary">
        </form><br/>
        <form action="/" method="post">
            <input name="<?php echo $slug ?>" class="btn btn-danger" tabindex="-1"type="submit" value="Удалить" />

        </form><br/>



    </div>
    <script src="../src/activeForEdit.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDJNJToGcE-njYYySbCJyts&callback=initMap" async defer></script>
<?php
require_once 'footer.php';

?>
