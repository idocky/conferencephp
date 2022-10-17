<?php

//подключение реквеста

require_once 'app/controller/Request.php';

$Request = new controller\Request();


require_once 'app/view/sluginator.php';


$errors = [];

if(!empty($post = $Request->getPostParam())) {
    if (empty($post['title'])) {
        $errors[] = 'title empty';
        echo '
            <div class="alert alert-danger" role="alert">
                Введите название конференции!
            </div>
        ';
    }
    if (strlen($post['title']) == 1 || strlen($post['title']) > 255) {
        $errors[] = 'wrong title';
        echo '
            <div class="alert alert-danger" role="alert">
                Название конференции либо сильно маленькое, либо большое!
            </div>
        ';
    }


    if (empty($errors)) {
        $title = $post['title'];
        $sql = "select slug from conference where slug = '" . sluginator($title) . "'";
        $slug = $DB->query($sql);

        if ($slug != NULL) {
            echo '
            <div class="alert alert-danger" role="alert">
                Статья с таким названием уже существует - придумайте другое!
            </div>
        ';
            $errors[] = 'wrong slug';
        } else {

            require_once 'app/controller/post.php';
            echo '
            <div class="alert alert-success" role="alert">
                Конференция успешно создана!
            </div>
        ';
        }

    }


}

?>