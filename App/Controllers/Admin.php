<?php

namespace App\Controllers;

use App\Views\View;
use App\Components\Identity;
use App\Exceptions\E404;
use App\Models\Tasks;

class Admin extends Controller
{
    protected $view;
    protected $identity;

    public function __construct()
    {
        $this->view = new View();
        $this->identity = new Identity();
    }

    public function action($action)
    {
        $methodName = 'action' . $action;

        if ('actionLogin' !== $methodName) {
        	$this->beforeAction();
        }   

        if (method_exists($this, $methodName)) {
            return $this->$methodName();
        } else {
            throw new E404('Страница не найдена');
        }
    }

    protected function beforeAction()
    {
    	$user = $this->identity->getUser();
    	if (empty($user)) {    		
    		$this->redirect('/admin/login');
    	}
    }

    public function actionLogin()
    {
        if (!empty($_POST['login']) && !empty($_POST['password'])) {
            $password = strip_tags($_POST['password']);
            $login = strip_tags($_POST['login']);
            
            try {
                $date = new \stdClass();
                $date->login = $login;
                $date->password = $password;
                
                $this->identity->authenticate($date);
            } catch (\App\Exceptions\Identity $e) {
                $this->view->errors = $e->getMessage();                
            }
        }

        if (!empty($this->identity->getUser())) {
            $this->redirect('/admin');
        }

        $this->view->display(__DIR__ . '/../templates/login.php');
    }

    public function actionLogout()
    {
        $this->identity->logout();
        $this->redirect('/');
    }

    public function actionIndex()
    {
        $this->view->tasks = \App\Models\Tasks::findAll();
        $this->view->display(__DIR__ . '/../templates/all.php');
    }

    public function actionChange()
    {
        if (!empty($_GET['id'])) {
            $id = $_GET['id'];
        } else {
            $this->redirect('/admin');
            exit;
        }

        $this->view->task = \App\Models\Tasks::findById($id);

        if (false === $this->view->task) {
            throw new E404('Страница не найдена');
        }

        $this->view->display(__DIR__ . '/../templates/edit.php');
    }

    public function actionSave()
    {
        $arrStatus = [
            'true' => 1,
            'false' => 0,
        ];

        if (!empty($_POST['text']) && !empty($_POST['status']) && !empty($_POST['id'])) {
            $id = strip_tags($_POST['id']);
            $text = strip_tags($_POST['text']);
            $status = strip_tags($_POST['status']);

            $status = $arrStatus[$status];   

            $tasks = new Tasks();
            $tasks->text = $text;
            $tasks->id = $id;
            $tasks->status = $status;
            if ($tasks->save()) {
                $this->redirect('/admin/change/?id=' . $id);
            }
        }
    }
}