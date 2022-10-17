<?php
require_once 'header.php';

require_once "app/view/sluginator.php";


require_once 'app/model/Database.php';       //подключение бд

$DB = new model\Database();

require_once 'app/view/alert.php';

?>

    <div class="container">
        <form action="" method="post">
            <div class="form-group">
                <label>Название конференции:</label>
                <input type="text" class="form-control" name="title" value="<?php
                htmlspecialchars($_POST['title'], ENT_QUOTES);
                ?>">
                <small id="emailHelp" class="form-text text-muted">От 2 до 255 символов</small>
            </div>
            <div class="form-group date ">
                <label class="form-check-label" for="exampleCheck1">Дата конференции</label><br/>
                <input type="date"  name="date" id="davaToday" formmethod="post">
            </div>


            <div id="formap">
                <div id="map"></div>
            </div>
            <br/>
            <select class="form-control" size="0" name="country">
                <?php
                $res = $DB->getCountries();
                foreach ($res as $country){
                    echo "<option>".$country['name_country']."</option>";
                }

                ?>

            </select>
            <br/>
            <div id="latLng">
                <input type="hidden" id="latitude" name="latitude" v-bind:value="latitude" />
                <input type="hidden" id="longitude" name="longitude" v-bind:value="longitude" />
            </div>

            <a href="/" class="btn btn-primary" tabindex="-1" role="button" aria-disabled="true">Назад</a>

            <input type="submit" value="Сохранить" class="btn btn-primary">
        </form>




    </div>
    <script src="../src/activeMap.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDJNJv5qPmlb7rwvToGcE-njYYySbCJyts&callback=initMap" async defer></script>


<?php
require_once 'footer.php';

?>