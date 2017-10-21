<?php

namespace App\Controllers;

use App\Exceptions\Core;
use App\Exceptions\Db;
use App\Exceptions\E404;
use App\Exceptions\MultiException;
use App\Views\View;

class Task extends Controller
{
    protected $view;

    public function __construct()
    {
        $this->view = new View();
    }

    protected function beforeAction()
    {

    }

    protected function actionIndex()
    {
        $this->view->tasks = \App\Models\Tasks::findAll();
        $this->view->display(__DIR__ . '/../templates/index.php');
    }

    protected function actionOne()
    {
        $id = (int)$_GET['id'];
        $res = $this->view->task = \App\Models\Tasks::findById($id);
        if (false == $res) {
            throw new E404('Страница не найдена');
        }
        $this->view->display(__DIR__ . '/../templates/one.php');
    }

    protected function actionAdd()
    {
        $this->view->display(__DIR__ . '/../templates/add.php');
    }

    protected function actionLoad()
    {
        if (isset($_FILES["image_upload"]["name"])) {
            
            $name = $_FILES["image_upload"]["name"];
            $size = $_FILES["image_upload"]["size"];
            $ext = end(explode(".", $name));
            $allowed_ext = array("png", "jpg", "jpeg");
            
            if (in_array($ext, $allowed_ext)) {
                
                if ($size < (3024*3024)) {

                    $new_image = '';
                    $new_name = md5(rand()) . '.' . $ext;
                    $path = 'App/layouts/upload/' . $new_name;
                    list($width, $height) = getimagesize($_FILES["image_upload"]["tmp_name"]);
                    
                    if ($ext == 'png') {
                        $new_image = imagecreatefrompng($_FILES["image_upload"]["tmp_name"]);
                    }
                    
                    if($ext == 'jpg' || $ext == 'jpeg') {  
                        $new_image = imagecreatefromjpeg($_FILES["image_upload"]["tmp_name"]);  
                    }

                    $new_width = 320;
                    $new_height = 240;
                    $tmp_image = imagecreatetruecolor($new_width, $new_height);
                    imagecopyresampled($tmp_image, $new_image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
                    imagejpeg($tmp_image, $path, 100);
                    imagedestroy($new_image);
                    imagedestroy($tmp_image);
                    echo '/' . $path; die;

                } 

            } 
        }
    }

    protected function actionCreate()
    {
        try {
            
            $task = new \App\Models\Tasks();
            $task->fill($_POST);

            if ($task->save()) {
                $this->redirect('/');
            }

        } catch (MultiException $e) {
            $this->view->errors = $e;
        }
        $this->view->display(__DIR__ . '/../templates/create.php');
    }

}