<?php
require_once 'header.php';


require_once 'app/model/Database.php';       //подключение бд

$DB = new model\Database();

require_once 'app/controller/Request.php';   //подключение реквеста

$Request = new controller\Request();

if (count($Request->getPostParam())>0){     //проверка на то или переданы пост параметры, тоесть была нажата кнопка удалить
    $DB->deleteConference(key($Request->getPostParam()));
}
?>

<div class="container back">
    <ul class="list-group">
        <form action="/" method="post">
            <?php
            $res = $DB->getConferences();
            foreach ($res as $conf){
                echo '<a class="nav-link text-dark" href="/conference/'.$conf['slug'].'">';
                echo '<li class="list-group-item d-flex justify-content-between align-items-center">';
                echo $conf["title"];
                echo '<br/>'.date("d.m.Y", strtotime($conf['date']));;
                echo '<input name="'.$conf['slug'].'" class="btn btn-danger" tabindex="-1"type="submit" value="Удалить" />';
                echo '</li>';
                echo '</a>';
            }

            ?>
        </form>

    </ul>

</div>



<?php require_once 'footer.php'; ?>
